<?php

declare(strict_types=1);

namespace OneCMS\User\Domain\Model\Account;

use OneCMS\User\Domain\Service\PasswordHashServiceInterface;
/**
 * AccountPasswordHash
 */
final class AccountPasswordHash
{
    private string $hash;

    public function __construct(private readonly PasswordHashServiceInterface $passwordHashService)
    {
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
