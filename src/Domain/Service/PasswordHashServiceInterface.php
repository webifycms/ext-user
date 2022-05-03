<?php

declare(strict_types=1);

namespace OneCMS\User\Domain\Service;
/**
 * PasswordHashServiceInterface
 */
interface PasswordHashServiceInterface
{
    /**
     * Generate password hash.
     */
    public function generateHash(string $password): void;

    /**
     * Verify the password.
     *
     * @return boolean true will be returns if verification success otherwise false
     */
    public function verifyPassword(string $password): bool;
}
