<?php

declare(strict_types=1);

namespace OneCMS\User\Application\Person\Request;

/**
 * CreatePersonRequest class is a simple data transfer object.
 */
class CreatePersonRequest
{
    public function __construct(
        private readonly string $firstName,
        private readonly string $lastName,
    ) {
        # code...
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }
}
