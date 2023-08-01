<?php

declare(strict_types=1);

namespace Webify\User\Domain\Entity;

use Webify\User\Domain\ValueObject\PersonId;

/**
 * Class PasswordReset.
 *
 * @version 0.0.1
 *
 * @since   0.0.1
 *
 * @author  Mohammed Shifreen
 */
final class PasswordReset
{
	private ?\DateTimeInterface $resettedAt = null;

	/**
	 * PasswordReset Costructor.
	 */
	public function __construct(
		private readonly PersonId $userId,
		private readonly string $token,
		private readonly \DateTimeInterface $expiryAt,
		?\DateTimeInterface $resettedAt = null
	) {
		if (null !== $resettedAt) {
			$this->resettedAt = $resettedAt;
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
	 * Get the value of token.
	 */
	public function getToken(): string
	{
		return $this->token;
	}

	/**
	 * Get the value of expiryAt.
	 */
	public function getExpiryAt(): \DateTimeInterface
	{
		return $this->expiryAt;
	}

	/**
	 * Get the value of resettedAt.
	 */
	public function getResettedAt(): ?\DateTimeInterface
	{
		return $this->resettedAt;
	}
}
