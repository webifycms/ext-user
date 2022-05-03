<?php

namespace OneCMS\User\Infrastructure\Service\PasswordHash;

use OneCMS\User\Domain\Service\PasswordHashServiceInterface;
use yii\base\Security;

final class PasswordHashService implements PasswordHashServiceInterface
{
    private string $hash;

    public function __construct(private readonly Security $securityComponent)
    {
    }

    public function generateHash(string $password): void
    {
        $this->hash = $this->securityComponent->generatePasswordHash($password);
    }

    public function verifyPassword(string $password): bool
    {
        return $this->securityComponent->validatePassword($password, $this->hash);
    }
}
