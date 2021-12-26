<?php
declare(strict_types=1);

namespace OneCMS\User\Domain\Model\Person;

use OneCMS\Base\Domain\Behaviour\Recyclable\RecyclableBehaviour;
use OneCMS\Base\Domain\Behaviour\Recyclable\RecyclableInterface;
use OneCMS\Base\Domain\ValueObject\Timestamp;
use OneCMS\Base\Domain\ValueObject\Uuid;

/**
 * Class Person
 *
 * @package getonecms/user
 * @version 0.0.1
 * @since   0.0.1
 * @author  Mohammed Shifreen
 */
final class Person implements RecyclableInterface
{
    use RecyclableBehaviour;

    /**
     * @var PersonId
     */
    private PersonId $id;
    /**
     * @var Uuid
     */
    private Uuid $uuid;
    /**
     * @var string
     */
    private string $firstName;
    /**
     * @var string
     */
    private string $lastName;
    /**
     * @var Timestamp
     */
    private Timestamp $timestamp;

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
        Uuid      $uuid,
        string    $firstName,
        string    $lastName,
        Timestamp $timestamp
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
        return $this->uuid->getValue();
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
     * @return Timestamp
     */
    public function getTimestamp(): Timestamp
    {
        return $this->timestamp;
    }
}
