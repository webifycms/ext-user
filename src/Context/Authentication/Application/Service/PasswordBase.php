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

use DateTimeImmutable;
use DateTimeZone;
use Webify\Base\Domain\Contract\Authentication\{AuthenticatedUser, CredentialsInterface, UserCredentials, UserCredentialsLookupInterface};
use Webify\Base\Domain\Contract\Authentication\Service\PasswordBaseInterface;
use Webify\Base\Domain\Contract\Identity\Service\PasswordHasherInterface;
use Webify\Base\Domain\ValueObject\DateTime;
use Webify\User\Context\Authentication\Domain\Entity\Session;
use Webify\User\Context\Authentication\Domain\Exception\AuthenticationFailedException;
use Webify\User\Context\Authentication\Domain\Guard\UserMustBeActive;
use Webify\User\Context\Authentication\Domain\Service\ChallengeSecretDeliveryInterface;
use Webify\User\Context\Authentication\Domain\ValueObject\{AuthenticatedUser as AuthenticatedUserValueObject, ChallengeCode, ChallengeType};
use Webify\User\Domain\ValueObject\{UserId, UserStatus};

/**
 * The implementation of the password base authentication service.
 */
final readonly class PasswordBase implements PasswordBaseInterface
{
	/**
	 * The number of minutes for which the session will be valid.
	 */
	private const int SESSION_TTL_MINUTES = 60;

	/**
	 * The constructor.
	 */
	public function __construct(
		private UserCredentialsLookupInterface $credentialLookup,
		private PasswordHasherInterface $passwordHasher,
		private UserMustBeActive $userMustBeActive,
		private IssueChallenge $issueChallenge,
		private OpenSession $openSession,
		private ChallengeSecretDeliveryInterface $delivery
	) {}

	/**
	 * {@inheritDoc}
	 *
	 * @throws AuthenticationFailedException if the authentication fails
	 */
	public function authenticate(CredentialsInterface $request): ?AuthenticatedUser
	{
		if (!$request->has('email')) {
			throw AuthenticationFailedException::forMissingEmail();
		}

		if (!$request->has('password')) {
			throw AuthenticationFailedException::forMissingPassword();
		}

		$email    = $this->requiredString($request, 'email');
		$password = $this->requiredString($request, 'password');

		$userCredentials = $this->userLookup($email);

		$this->userMustBeActive->guard(UserStatus::fromString($userCredentials->status));

		if (!$this->passwordHasher->verify($password, $userCredentials->passwordHash)) {
			throw AuthenticationFailedException::forInvalid();
		}

		$userId = UserId::fromString($userCredentials->id);

		if ($userCredentials->isTwoFactorEnabled) {
			$this->issueCode($userId);

			// Interrupt the authentication process to wait for the user to enter the code
			return null;
		}

		// Open a session for the user
		$session = $this->openSession($userId);

		return new AuthenticatedUser(
			$userId->toNative(),
			$userCredentials->email,
			$userCredentials->displayName,
			DateTime::now()->toNative(),
			$session->getAccessToken()->toNative(),
			$session->getRefreshToken()->toNative()
		);
	}

	/**
	 * Looks up the user.
	 *
	 * @throws AuthenticationFailedException if the user is not found
	 */
	private function userLookup(string $email): UserCredentials
	{
		$userCredentials = $this->credentialLookup->findByEmail($email);

		if (null === $userCredentials) {
			throw AuthenticationFailedException::userNotFound($email);
		}

		return $userCredentials;
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
	 * Issues a challenge code for the user when the user enabled two-factor authentication.
	 */
	private function issueCode(UserId $userId): void
	{
		$challenge = $this->issueChallenge->issue($userId, ChallengeType::Code);

		/** @var ChallengeCode $challengeCode */
		$challengeCode = $challenge->getSecret();

		$this->delivery->deliver($userId, $challenge->getType()->value, $challengeCode->toNative());
	}

	/**
	 * Opens a session for the user.
	 */
	private function openSession(UserId $userId): Session
	{
		return $this->openSession->open(
			AuthenticatedUserValueObject::fromSuccessfulAuthentication($userId),
			new DateTimeImmutable(
				sprintf('+%d minutes', self::SESSION_TTL_MINUTES),
				new DateTimeZone('UTC')
			)
		);
	}
}
