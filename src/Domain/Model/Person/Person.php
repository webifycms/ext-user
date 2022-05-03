<?php

declare(strict_types=1);

namespace OneCMS\User\Domain\Model\Person;

use OneCMS\Base\Domain\ValueObject\TimestampValueObject;
use OneCMS\Base\Domain\ValueObject\UuidValueObject;

/**
 * Person
 *
 * @package getonecms/ext-user
 * @version 0.0.1
 * @since   0.0.1
 * @author  Mohammed Shifreen
 */
final class Person
{
    /**
     * Person entity object constructor.
     *
     * @param PersonId $id
     * @param Uuid $uuid
     * @param string $firstName
     * @param string $lastName
     * @param Timestamp $timestamp
     */
    public function __construct(private readonly PersonId  $id, private readonly UuidValueObject      $uuid, private readonly string    $firstName, private readonly string    $lastName, private readonly TimestampValueObject $timestamp)
    {
    }

    /**
     * Get the value of id.
     */
    public function getPersonId(): string
    {
        return $this->id->getValue();
    }

    /**
     * Get the value of uuid.
     */
    public function getUuid(): string
    {
        return $this->uuid->getUuid();
    }

    /**
     * Get the value of firstName.
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * Get the value of lastName.
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getTimestamp(): TimestampValueObject
    {
        return $this->timestamp;
    }
}
