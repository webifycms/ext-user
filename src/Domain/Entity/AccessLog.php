<?php

declare(strict_types=1);

namespace Webify\User\Domain\Entity;

use Webify\User\Domain\ValueObject\AccountId;
use Webify\User\Domain\ValueObject\PersonId;

/**
 * Class AccessLog.
 *
 * @version 0.0.1
 *
 * @since   0.0.1
 *
 * @author  Mohammed Shifreen
 */
final class AccessLog
{
	private ?\DateTimeInterface $timeOut = null;

	/**
	 * AccountLog constructor.
	 */
	public function __construct(
		private readonly PersonId $userId,
		private readonly AccountId $accountId,
		private readonly string $sessionId,
		private readonly string $ipAddress,
		private readonly string $remoteIpAddress,
		private readonly string $agent,
		private readonly bool $isActive,
		private readonly \DateTimeInterface $timeIn,
		?\DateTimeInterface $timeOut = null
	) {
		if (null !== $timeOut) {
			$this->timeOut = $timeOut;
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
	 * Get the value of sessionId.
	 */
	public function getSessionId(): string
	{
		return $this->sessionId;
	}

	/**
	 * Get the value of ipAddress.
	 */
	public function getIpAddress(): string
	{
		return $this->ipAddress;
	}

	/**
	 * Get the value of remoteIpAddress.
	 */
	public function getRemoteIpAddress(): string
	{
		return $this->remoteIpAddress;
	}

	/**
	 * Get the value of agent.
	 */
	public function getAgent(): string
	{
		return $this->agent;
	}

	/**
	 * Get the value of isActive.
	 */
	public function isActive(): bool
	{
		return $this->isActive;
	}

	/**
	 * Get the value of timeIn.
	 */
	public function getTimeIn(): \DateTimeInterface
	{
		return $this->timeIn;
	}

	/**
	 * Get the value of timeOut.
	 */
	public function getTimeOut(): ?\DateTimeInterface
	{
		return $this->timeOut;
	}
}
