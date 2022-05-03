<?php
declare(strict_types=1);

namespace OneCMS\User\Domain\Entity;

use DateTimeInterface;
use OneCMS\User\Domain\ValueObject\AccountId;
use OneCMS\User\Domain\ValueObject\PersonId;

/**
 * Class Activation
 *
 * @package getonecms/user
 * @version 0.0.1
 * @since   0.0.1
 * @author  Mohammed Shifreen
 */
final class Activation
{
    private ?DateTimeInterface $activatedAt = null;

    public function __construct(
        private readonly PersonId           $userId,
        private readonly AccountId          $accountId,
        private readonly string             $token,
        private readonly DateTimeInterface  $expiryAt,
        ?DateTimeInterface $activatedAt = null
    ) {
        if (!is_null($activatedAt)) {
            $this->activatedAt = $activatedAt;
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
     * Get the value of token
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * Get the value of activatedAt
     */
    public function getActivatedAt(): DateTimeInterface
    {
        return $this->activatedAt;
    }

    /**
     * Get the value of expiryAt
     */
    public function getExpiryAt(): DateTimeInterface
    {
        return $this->expiryAt;
    }
}
