<?php
declare(strict_types=1);

namespace OneCMS\User\Domain\Model\Account;

use DateTimeInterface;
use OneCMS\Base\Domain\ValueObject\DateTimeValueObject;

/**
 * AccountActivation
 */
final class AccountActivation
{
    /**
     * Undocumented function
     *
     * @param string|null $token
     * @param DateTimeInterface|null $activatedAt
     */
    public function __construct(private readonly ?string $token = null, private ?\DateTimeInterface $activatedAt = null)
    {
    }

    /**
     * Get the value of activatedAt
     */
    public function getActivatedAt(): ?DateTimeInterface
    {
        return $this->activatedAt;
    }

    /**
     * Get the value of token
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * Validates the given token and returns true if valid otherwise returns false.
     */
    public function validateToken(string $token): bool
    {
        return $this->token === $token;
    }

    /**
     * Returns true if activated otherwise returns false.
     */
    public function isActivated(): bool
    {
        return $this->activatedAt instanceof DateTimeInterface;
    }

    /**
     * Activates the account.
     */
    public function activate(): void
    {
        $this->activatedAt = (new DateTimeValueObject())->getDateTime();
    }
}
