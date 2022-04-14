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
     * @var PersonId
     */
    private PersonId $id;
    /**
     * @var UuidValueObject
     */
    private UuidValueObject $uuid;
    /**
     * @var string
     */
    private string $firstName;
    /**
     * @var string
     */
    private string $lastName;
    /**
     * @var TimestampValueObject
     */
    private TimestampValueObject $timestamp;

    /**
     * Person entity object constructor.
     *
     * @param PersonId $id
     * @param Uuid $uuid
     * @param string $firstName
     * @param string $lastName
     * @param Timestamp $timestamp
     */
    public function __construct(
        PersonId  $id,
        UuidValueObject      $uuid,
        string    $firstName,
        string    $lastName,
        TimestampValueObject $timestamp
    ) {
        $this->id = $id;
        $this->uuid = $uuid;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->timestamp = $timestamp;
    }

    /**
     * Get the value of id.
     *
     * @return string
     */
    public function getPersonId(): string
    {
        return $this->id->getValue();
    }

    /**
     * Get the value of uuid.
     *
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid->getUuid();
    }

    /**
     * Get the value of firstName.
     *
     * @return  string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * Get the value of lastName.
     *
     * @return  string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return TimestampValueObject
     */
    public function getTimestamp(): TimestampValueObject
    {
        return $this->timestamp;
    }
}
