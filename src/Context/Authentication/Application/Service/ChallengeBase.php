<?php

/**
 * The file is part of the "webifycms/ext-user", WebifyCMS extension package.
 *
 * @see https://webifycms.com/extension/user
 *
 * @copyright Copyright (c) 2023 - Present WebifyCMS
 * @license https://webifycms.com/license
 * @author Mohammed Shifreen <mshifreen@gmail.com>
 */
declare(strict_types=1);

namespace Webify\User\Context\Authentication\Application\Service;

use Webify\Base\Domain\Contract\Authentication\{
	AuthenticatedUser,
	CredentialsInterface,
	StrategyInterface,
	UserCredentials,
	UserCredentialsLookupInterface,
};
use Webify\Base\Domain\Contract\Authentication\Service\{ChallengeBasedInterface, StrategyRegisterInterface};
use Webify\Base\Domain\ValueObject\DateTime;
use Webify\User\Context\Authentication\Domain\Entity\Session;
use Webify\User\Context\Authentication\Domain\Exception\{
	AuthenticationFailedException,
	ChallengeNotFoundException,
	InvalidChallengeSecretException,
};
use Webify\User\Context\Authentication\Domain\Guard\UserMustBeActive;
use Webify\User\Context\Authentication\Domain\ValueObject\{
	AuthenticatedUser as AuthenticatedUserValueObject,
	ChallengeCode,
	ChallengeSecretInterface,
	ChallengeToken,
	ChallengeType,
};
use Webify\User\Domain\ValueObject\{UserId, UserStatus};

/**
 * Implementation of the challenge-based authentication service.
 */
final readonly class ChallengeBase implements ChallengeBasedInterface
{
	/**
	 * The number of minutes for which the session will be valid.
	 */
	private const int SESSION_TTL_MINUTES = 60;

	/**
	 * The constructor.
	 */
	public function __construct(
		private UserCredentialsLookupInterface $userLookup,
		private StrategyRegisterInterface $strategyRegister,
		private UserMustBeActive $userMustBeActive,
		private VerifyChallenge $verifyChallenge,
		private OpenSession $openSession
	) {}

	/**
	 * {@inheritDoc}
	 *
	 * @throws AuthenticationFailedException if the authentication initiation fails
	 */
	public function initiate(CredentialsInterface $credentials): void
	{
		$user = $this->userLookup($credentials);

		$this->userMustBeActive->guard(UserStatus::fromString($user->status));

		$strategy = $this->strategyLookup($credentials);

		$strategy->initiate($credentials, $user);
	}

	/**
	 * {@inheritDoc}
	 *
	 * @throws AuthenticationFailedException if the authentication fails
	 */
	public function complete(CredentialsInterface $credentials): AuthenticatedUser
	{
		if (!$credentials->has('secret')) {
			throw AuthenticationFailedException::forMissingSecret();
		}

		$user = $this->userLookup($credentials);

		$this->userMustBeActive->guard(UserStatus::fromString($user->status));

		$userId        = UserId::fromString($user->id);
		$secret        = $this->identifySecretType($credentials);

		try {
			$this->verifyChallenge->verify($userId, $secret);
		} catch (ChallengeNotFoundException|InvalidChallengeSecretException) { // @phpstan-ignore catch.neverThrown
			throw AuthenticationFailedException::forInvalid();
		}

		$session = $this->openSession(UserId::fromString($user->id));

		return new AuthenticatedUser(
			$userId->toNative(),
			$user->email,
			$user->displayName,
			DateTime::now()->toNative(),
			$session->getAccessToken()->toNative(),
			$session->getRefreshToken()->toNative()
		);
	}

	/**
	 * Looks up the authentication strategy.
	 */
	private function strategyLookup(CredentialsInterface $credentials): StrategyInterface
	{
		$strategy = $this->strategyRegister->get($credentials->getStrategyIdentifier());

		if (!$strategy->isSupported($credentials)) {
			throw AuthenticationFailedException::strategyNotSupported($credentials->getStrategyIdentifier());
		}

		return $strategy;
	}

	/**
	 * Identifies the type of secret.
	 */
	private function identifySecretType(CredentialsInterface $credentials): ChallengeSecretInterface
	{
		$strategy = $this->strategyLookup($credentials);
		$type     = ChallengeType::tryFrom(str_replace('challenge_', '', $strategy->getIdentifier()));

		if (null === $type) {
			throw AuthenticationFailedException::forInvalid();
		}

		$secret = $this->requiredString($credentials, 'secret');

		if ($type->isCode()) {
			return ChallengeCode::fromString($secret);
		}

		return ChallengeToken::fromString($secret);
	}

	/**
	 * Looks up the user credentials.
	 */
	private function userLookup(CredentialsInterface $credentials): UserCredentials
	{
		if (!$credentials->has('email')) {
			throw AuthenticationFailedException::forMissingEmail();
		}

		$email = $this->requiredString($credentials, 'email');
		$user  = $this->userLookup->findByEmail($email);

		if (null === $user) {
			throw AuthenticationFailedException::userNotFound($email);
		}

		return $user;
	}

	/**
	 * Reads a credential that must be present and must be a string.
	 *
	 * `KeyValueReaderInterface::get()` returns `mixed`, so a present key can still hold a
	 * non-string value. Narrowing here keeps the rest of the flow type-safe and turns a
	 * malformed payload into an authentication failure rather than a `TypeError`.
	 *
	 * @throws AuthenticationFailedException if the value is missing or not a string
	 */
	private function requiredString(CredentialsInterface $credentials, string $key): string
	{
		$value = $credentials->get($key);

		if (!is_string($value)) {
			throw AuthenticationFailedException::forInvalid();
		}

		return $value;
	}

	/**
	 * Opens a session for the user.
	 */
	private function openSession(UserId $userId): Session
	{
		$datetime = DateTime::fromString(
			sprintf('+%d minutes', self::SESSION_TTL_MINUTES),
			'UTC'
		);

		return $this->openSession->open(
			AuthenticatedUserValueObject::fromSuccessfulAuthentication($userId),
			$datetime->toNative()
		);
	}
}
