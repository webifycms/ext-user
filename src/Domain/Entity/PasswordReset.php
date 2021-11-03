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
    private PersonId $userId;

    private string $token;

    private DateTimeInterface $expiryAt;

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
        PersonId           $userId,
        string             $token,
        DateTimeInterface  $expiryAt,
        ?DateTimeInterface $resettedAt = null
    )
    {
        $this->userId = $userId;
        $this->token = $token;
        $this->expiryAt = $expiryAt;

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
     *
     * @return  string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * Get the value of expiryAt
     *
     * @return  DateTimeInterface
     */
    public function getExpiryAt(): DateTimeInterface
    {
        return $this->expiryAt;
    }

    /**
     * Get the value of resettedAt
     *
     * @return  ?DateTimeInterface
     */
    public function getResettedAt(): ?DateTimeInterface
    {
        return $this->resettedAt;
    }
}
