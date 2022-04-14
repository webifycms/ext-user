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
    private AccountId $id;

    private Person $person;

    private EmailValueObject $email;

    private string $username;

    private AccountPasswordHash $passwordHash;

    private string $validationToken;

    private ?string $registeredIp = null;

    private AccountActivation $activation;

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
    public function __construct(
        AccountId $id,
        Person $person,
        EmailValueObject $email,
        string $username,
        AccountPasswordHash $passwordHash,
        string $validationToken,
        ?string $registeredIp,
        AccountActivation $activation
    ) {
        $this->id = $id;
        $this->person = $person;
        $this->email = $email;
        $this->username = $username;
        $this->passwordHash = $passwordHash;
        $this->validationToken = $validationToken;
        $this->registeredIp = $registeredIp;
        $this->activation = $activation;
    }

    /**
     * Get the value of id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id->getValue();
    }

    /**
     * Get the Person object
     *
     * @return Person
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
     *
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * Get the passwordHash object
     *
     * @return AccountPasswordHash
     */
    public function getPasswordHash(): AccountPasswordHash
    {
        return $this->passwordHash;
    }

    /**
     * Get the value of validationToken
     *
     * @return string
     */
    public function getValidationToken(): string
    {
        return $this->validationToken;
    }

    /**
     * Get the value of registeredIp
     *
     * @return string
     */
    public function getRegisteredIp(): string
    {
        return $this->registeredIp;
    }

    /**
     * Get the AccountActivation object
     *
     * @return AccountActivation
     */
    public function getActivation(): AccountActivation
    {
        return $this->activation;
    }
}
