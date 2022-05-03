<?php
declare(strict_types=1);

namespace OneCMS\User\Domain\Model\Account;

use OneCMS\Base\Domain\Behaviour\Blockable\BlockableBehaviour;
use OneCMS\Base\Domain\Behaviour\Blockable\BlockableInterface;
use OneCMS\Base\Domain\ValueObject\EmailAddress;
use OneCMS\Base\Domain\ValueObject\EmailValueObject;
use OneCMS\User\Domain\Model\Person\Person;
/**
 * The Account entity class holds the user's account information.
 *
 * @package getonecms/ext-user
 * @version 0.0.1
 * @since   0.0.1
 * @author  Mohammed Shifreen
 */
final class Account
{
    /**
     * Account entity object constructor
     *
     * @param AccountId $id
     * @param Person $person
     * @param EmailAddress $email
     * @param string $username
     * @param AccountPasswordHash $passwordHash
     * @param string $validationToken
     * @param string $registeredIp
     * @param AccountActivation $activation
     */
    public function __construct(private readonly AccountId $id, private readonly Person $person, private readonly EmailValueObject $email, private readonly string $username, private readonly AccountPasswordHash $passwordHash, private readonly string $validationToken, private readonly ?string $registeredIp, private readonly AccountActivation $activation)
    {
    }

    /**
     * Get the value of id
     */
    public function getId(): string
    {
        return $this->id->getValue();
    }

    /**
     * Get the Person object
     */
    public function getPerson(): Person
    {
        return $this->person;
    }

    /**
     * Get the value of email
     *
     * @return EmailValueObject
     */
    public function getEmail(): string
    {
        return $this->email->getEmail();
    }

    /**
     * Get the value of username
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * Get the passwordHash object
     */
    public function getPasswordHash(): AccountPasswordHash
    {
        return $this->passwordHash;
    }

    /**
     * Get the value of validationToken
     */
    public function getValidationToken(): string
    {
        return $this->validationToken;
    }

    /**
     * Get the value of registeredIp
     */
    public function getRegisteredIp(): string
    {
        return $this->registeredIp;
    }

    /**
     * Get the AccountActivation object
     */
    public function getActivation(): AccountActivation
    {
        return $this->activation;
    }
}
