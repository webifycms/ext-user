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

namespace Webify\User\Context\Authentication\Application\Strategy;

use Webify\Base\Domain\Contract\Authentication\{CredentialsInterface, StrategyInterface, UserCredentials};
use Webify\User\Context\Authentication\Application\Service\IssueChallenge;
use Webify\User\Context\Authentication\Domain\Service\ChallengeSecretDeliveryInterface;
use Webify\User\Context\Authentication\Domain\ValueObject\{ChallengeToken, ChallengeType};
use Webify\User\Domain\ValueObject\UserId;

/**
 * ChallengeTokenStrategy handles challenge token authentication flow (via a magic link) that sent by email.
 */
final readonly class ChallengeTokenStrategy implements StrategyInterface
{
	/**
	 * The constructor.
	 */
	public function __construct(
		private IssueChallenge $issueChallenge,
		private ChallengeSecretDeliveryInterface $delivery,
	) {}

	/**
	 * {@inheritDoc}
	 */
	public function getIdentifier(): string
	{
		return 'challenge_token';
	}

	/**
	 * {@inheritDoc}
	 */
	public function isSupported(CredentialsInterface $credentials): bool
	{
		return $this->getIdentifier() === $credentials->getStrategyIdentifier();
	}

	/**
	 * {@inheritDoc}
	 */
	public function initiate(
		CredentialsInterface $requestCredentials,
		UserCredentials $userCredentials
	): void {
		$type      = ChallengeType::Token;
		$userId    = UserId::fromString($userCredentials->id);
		$challenge = $this->issueChallenge->issue($userId, $type);

		/** @var ChallengeToken $challengeToken */
		$challengeToken = $challenge->getSecret();

		// Deliver the challenge token via a link to the user
		$this->delivery->deliver($userId, $type->value, $challengeToken->toNative());
	}
}
