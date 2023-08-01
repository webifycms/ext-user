<?php

declare(strict_types=1);

namespace Webify\User\Domain\Entity;

use Webify\User\Domain\ValueObject\AccountId;
use Webify\User\Domain\ValueObject\PersonId;

/**
 * Class Activation.
 *
 * @version 0.0.1
 *
 * @since   0.0.1
 *
 * @author  Mohammed Shifreen
 */
final class Activation
{
	private ?\DateTimeInterface $activatedAt = null;

	public function __construct(
		private readonly PersonId $userId,
		private readonly AccountId $accountId,
		private readonly string $token,
		private readonly \DateTimeInterface $expiryAt,
		?\DateTimeInterface $activatedAt = null
	) {
		if (null !== $activatedAt) {
			$this->activatedAt = $activatedAt;
		}
	}

	/**
	 * Get the value of userId.
	 */
	public function getUserId(): PersonId
	{
		return $this->userId;
	}

	/**
	 * Get the value of accountId.
	 */
	public function getAccountId(): AccountId
	{
		return $this->accountId;
	}

	/**
	 * Get the value of token.
	 */
	public function getToken(): string
	{
		return $this->token;
	}

	/**
	 * Get the value of activatedAt.
	 */
	public function getActivatedAt(): \DateTimeInterface
	{
		return $this->activatedAt;
	}

	/**
	 * Get the value of expiryAt.
	 */
	public function getExpiryAt(): \DateTimeInterface
	{
		return $this->expiryAt;
	}
}
