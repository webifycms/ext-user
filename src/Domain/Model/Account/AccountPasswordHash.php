<?php
declare(strict_types=1);

namespace OneCMS\User\Domain\Model\Account;

use OneCMS\User\Domain\Service\PasswordHashServiceInterface;

/**
 * Undocumented class
 */
final class AccountPasswordHash
{
    private string $hash;

    private PasswordHashServiceInterface $passwordHashService;

    public function __construct(PasswordHashServiceInterface $passwordHashService)
    {
        $this->passwordHashService = $passwordHashService;
    }

    public function setHash(string $password): void
    {
        $this->hash = $this->passwordHashService->generateHash($password);
    }

    public function getHash(): string
    {
        return $this->hash;
    }
}
