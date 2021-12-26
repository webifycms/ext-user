<?php

namespace OneCMS\User\Domain\Service;

/**
 * Undocumented interface
 */
interface PasswordHashServiceInterface
{
    public function generateHash(string $password): void;
    
    public function verifyPassword(string $password): bool;
}
