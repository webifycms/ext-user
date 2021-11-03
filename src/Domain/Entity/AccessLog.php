<?php
declare(strict_types=1);

namespace OneCMS\User\Domain\Entity;

use DateTimeInterface;
use OneCMS\User\Domain\ValueObject\AccountId;
use OneCMS\User\Domain\ValueObject\PersonId;

/**
 * Class AccessLog
 *
 * @package getonecms/user
 * @version 0.0.1
 * @since   0.0.1
 * @author  Mohammed Shifreen
 */
final class AccessLog
{
    private PersonId $userId;

    private AccountId $accountId;

    private string $sessionId;

    private string $ipAddress;

    private string $remoteIpAddress;

    private string $agent;

    private bool $isActive;

    private DateTimeInterface $timeIn;

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
        PersonId           $userId,
        AccountId          $accountId,
        string             $sessionId,
        string             $ipAddress,
        string             $remoteIpAddress,
        string             $agent,
        bool               $isActive,
        DateTimeInterface  $timeIn,
        ?DateTimeInterface $timeOut = null
    )
    {
        $this->userId = $userId;
        $this->sessionId = $sessionId;
        $this->ipAddress = $ipAddress;
        $this->remoteIpAddress = $remoteIpAddress;
        $this->agent = $agent;
        $this->isActive = $isActive;
        $this->accountId = $accountId;
        $this->timeIn = $timeIn;

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
     *
     * @return  string
     */
    public function getSessionId(): string
    {
        return $this->sessionId;
    }

    /**
     * Get the value of ipAddress
     *
     * @return  string
     */
    public function getIpAddress(): string
    {
        return $this->ipAddress;
    }

    /**
     * Get the value of remoteIpAddress
     *
     * @return  string
     */
    public function getRemoteIpAddress(): string
    {
        return $this->remoteIpAddress;
    }

    /**
     * Get the value of agent
     *
     * @return  string
     */
    public function getAgent(): string
    {
        return $this->agent;
    }

    /**
     * Get the value of isActive
     *
     * @return  bool
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }

    /**
     * Get the value of timeIn
     *
     * @return  DateTimeInterface
     */
    public function getTimeIn(): DateTimeInterface
    {
        return $this->timeIn;
    }

    /**
     * Get the value of timeOut
     *
     * @return  ?DateTimeInterface
     */
    public function getTimeOut(): ?DateTimeInterface
    {
        return $this->timeOut;
    }
}
