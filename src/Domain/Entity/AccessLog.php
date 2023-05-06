<?php
declare(strict_types=1);

namespace Webify\User\Domain\Entity;

use DateTimeInterface;
use Webify\User\Domain\ValueObject\AccountId;
use Webify\User\Domain\ValueObject\PersonId;

/**
 * Class AccessLog
 *
 * @package webifycms/user
 * @version 0.0.1
 * @since   0.0.1
 * @author  Mohammed Shifreen
 */
final class AccessLog
{
    private ?DateTimeInterface $timeOut = null;

    /**
     * AccountLog constructor.
     *
     * @param PersonId $userId
     * @param AccountId $accountId
     * @param string $sessionId
     * @param string $ipAddress
     * @param string $remoteIpAddress
     * @param string $agent
     * @param boolean $isActive
     * @param DateTimeInterface $timeIn
     * @param DateTimeInterface|null $timeOut
     * @return void
     */
    public function __construct(
        private readonly PersonId           $userId,
        private readonly AccountId          $accountId,
        private readonly string             $sessionId,
        private readonly string             $ipAddress,
        private readonly string             $remoteIpAddress,
        private readonly string             $agent,
        private readonly bool               $isActive,
        private readonly DateTimeInterface  $timeIn,
        ?DateTimeInterface $timeOut = null
    )
    {
        if (!is_null($timeOut)) {
            $this->timeOut = $timeOut;
        }
    }

    /**
     * Get the value of userId
     *
     * @return  PersonId
     */
    public function getUserId(): PersonId
    {
        return $this->userId;
    }

    /**
     * Get the value of accountId
     *
     * @return  AccountId
     */
    public function getAccountId(): AccountId
    {
        return $this->accountId;
    }

    /**
     * Get the value of sessionId
     */
    public function getSessionId(): string
    {
        return $this->sessionId;
    }

    /**
     * Get the value of ipAddress
     */
    public function getIpAddress(): string
    {
        return $this->ipAddress;
    }

    /**
     * Get the value of remoteIpAddress
     */
    public function getRemoteIpAddress(): string
    {
        return $this->remoteIpAddress;
    }

    /**
     * Get the value of agent
     */
    public function getAgent(): string
    {
        return $this->agent;
    }

    /**
     * Get the value of isActive
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }

    /**
     * Get the value of timeIn
     */
    public function getTimeIn(): DateTimeInterface
    {
        return $this->timeIn;
    }

    /**
     * Get the value of timeOut
     */
    public function getTimeOut(): ?DateTimeInterface
    {
        return $this->timeOut;
    }
}
