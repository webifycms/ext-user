<?php
declare(strict_types=1);

namespace OneCMS\User\Application\Request\Person;

/**
 * Class RequestPersonCreate
 *
 * @package getonecms/user
 * @version 0.0.1
 * @since   0.0.1
 * @author  Mohammed Shifreen
 */
final class CreatePersonRequest
{
    /**
     * @param string $firstName
     * @param string $lastName
     */
    public function __construct(private readonly string $firstName, private readonly string $lastName)
    {
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