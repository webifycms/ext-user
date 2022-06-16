<?php

declare(strict_types=1);

namespace OneCMS\User\Domain\Model\Person;

use DateTimeInterface;
use OneCMS\Base\Domain\ValueObject\TimestampValueObject;
use OneCMS\Base\Domain\ValueObject\RecycleValueObject;
use OneCMS\Base\Domain\Model\RecyclableModelInterface;

/**
 * Person
 *
 * @package getonecms/ext-user
 * @version 0.0.1
 * @since   0.0.1
 * @author  Mohammed Shifreen
 */
final class Person implements RecyclableModelInterface
{
    /**
     * Person entity object constructor.
     *
     * @param PersonId $id
     * @param string $firstName
     * @param string $lastName
     * @param TimestampValueObject $timestamp
     * @param ?RecycleValueObject $recycle
     */
    public function __construct(
        private readonly PersonId $id,
        private readonly string $firstName,
        private readonly string $lastName,
        private readonly TimestampValueObject $timestamp,
        private readonly ?RecycleValueObject $recycle = null
    ) {
    }

    /**
     * Get the value of id.
     */
    public function getId(): string
    {
        return $this->id->getValue();
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

    /**
     * Get the timestamp value object.
     *
     * @return TimestampValueObject
     */
    public function getTimestamp(): TimestampValueObject
    {
        return $this->timestamp;
    }

    /**
     * @inheritDoc
     */
    public function inRecycle(): bool
    {
        return $this->recycle instanceof RecycleValueObject;
    }

    /**
     * @inheritDoc
     */
    public function getRecycledAt(): DateTimeInterface
    {
        if ($this->inRecycle()) {
            return $this->recycle->getRecycledAt();
        }
    }
}
