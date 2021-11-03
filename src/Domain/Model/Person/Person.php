<?php
declare(strict_types=1);

namespace OneCMS\User\Domain\Model\Person;

use OneCMS\Base\Domain\Behaviour\Blockable\BlockableBehaviour;
use OneCMS\Base\Domain\Behaviour\Blockable\BlockableBehaviourInterface;
use OneCMS\Base\Domain\Behaviour\Recyclable\RecyclableBehaviour;
use OneCMS\Base\Domain\Behaviour\Recyclable\RecyclableBehaviourInterface;
use OneCMS\Base\Domain\ValueObject\Timestamp;
use OneCMS\Base\Domain\ValueObject\Uuid;
use OneCMS\User\Domain\ValueObject\PersonId;

/**
 * Class Person
 *
 * @package getonecms/user
 * @version 0.0.1
 * @since   0.0.1
 * @author  Mohammed Shifreen
 */
final class Person implements BlockableBehaviourInterface, RecyclableBehaviourInterface
{
    use BlockableBehaviour;
    use RecyclableBehaviour;

    /**
     * @var PersonId
     */
    private PersonId $personId;
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
     * Person constructor.
     *
     * @param PersonId $personId
     * @param Uuid $uuid
     * @param string $firstName
     * @param string $lastName
     * @param Timestamp $timestamp
     */
    public function __construct(
        PersonId  $personId,
        Uuid      $uuid,
        string    $firstName,
        string    $lastName,
        Timestamp $timestamp
    )
    {
        $this->personId = $personId;
        $this->uuid = $uuid;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->timestamp = $timestamp;
    }

    /**
     * Returns the user personId as PersonId object.
     *
     * @return PersonId
     */
    public function getPersonId(): PersonId
    {
        return $this->personId;
    }

    /**
     * Returns the user uuid as UserUuid object.
     *
     * @return Uuid
     */
    public function getUuid(): Uuid
    {
        return $this->uuid;
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