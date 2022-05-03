<?php
declare(strict_types=1);

namespace OneCMS\User\Domain\Entity;

use DateTimeInterface;
use OneCMS\User\Domain\ValueObject\PersonId;

/**
 * Class PasswordReset
 *
 * @package getonecms/user
 * @version 0.0.1
 * @since   0.0.1
 * @author  Mohammed Shifreen
 */
final class PasswordReset
{
    private ?DateTimeInterface $resettedAt = null;

    /**
     * PasswordReset Costructor.
     *
     * @param PersonId $userId
     * @param string $token
     * @param DateTimeInterface $expiryAt
     * @param DateTimeInterface|null $resettedAt
     * @return void
     */
    public function __construct(
        private readonly PersonId           $userId,
        private readonly string             $token,
        private readonly DateTimeInterface  $expiryAt,
        ?DateTimeInterface $resettedAt = null
    )
    {
        if (!is_null($resettedAt)) {
            $this->resettedAt = $resettedAt;
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
     * Get the value of token
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * Get the value of expiryAt
     */
    public function getExpiryAt(): DateTimeInterface
    {
        return $this->expiryAt;
    }

    /**
     * Get the value of resettedAt
     */
    public function getResettedAt(): ?DateTimeInterface
    {
        return $this->resettedAt;
    }
}
