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
    private ?string $token = null;

    private ?DateTimeInterface $activatedAt = null;

    /**
     * Undocumented function
     *
     * @param string|null $token
     * @param DateTimeInterface|null $activatedAt
     */
    public function __construct(?string $token = null, ?DateTimeInterface $activatedAt = null)
    {
        $this->token = $token;
        $this->activatedAt = $activatedAt;
    }

    /**
     * Get the value of activatedAt
     *
     * @return DateTimeInterface|null
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
     *
     * @param string $token
     * @return bool
     */
    public function validateToken(string $token): bool
    {
        return $this->token === $token;
    }

    /**
     * Returns true if activated otherwise returns false.
     *
     * @return bool
     */
    public function isActivated(): bool
    {
        return $this->activatedAt instanceof DateTimeInterface;
    }

    /**
     * Activates the account.
     *
     * @return void
     */
    public function activate(): void
    {
        $this->activatedAt = (new DateTimeValueObject())->getDateTime();
    }
}
