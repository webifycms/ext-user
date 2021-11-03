<?php
declare(strict_types=1);

namespace OneCMS\User\Domain\Entity;

use OneCMS\Base\Domain\ValueObject\EmailAddress;
use OneCMS\User\Domain\ValueObject\AccountId;
use OneCMS\User\Domain\ValueObject\PersonId;

/**
 * Class Account
 *
 * @package getonecms/user
 * @version 0.0.1
 * @since   0.0.1
 * @author  Mohammed Shifreen
 */
final class Account
{
    private AccountId $accountId;
    private PersonId $personId;
    private string $username;
    private EmailAddress $email;
    private string $password;
    private string $authorizationToken;
    private string $cookieToken;

    /**
     * @param AccountId $accountId
     * @param PersonId $personId
     * @param string $username
     * @param EmailAddress $email
     * @param string $password
     * @param string $authorizationToken
     * @param string $cookieToken
     */
    public function __construct(
        AccountId    $accountId,
        PersonId     $personId,
        string       $username,
        EmailAddress $email,
        string       $password,
        string       $authorizationToken,
        string       $cookieToken
    )
    {
        $this->accountId = $accountId;
        $this->personId = $personId;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->authorizationToken = $authorizationToken;
        $this->cookieToken = $cookieToken;
    }

    /**
     * Get the value of accountId.
     *
     * @return  AccountId
     */
    public function getAccountId(): AccountId
    {
        return $this->accountId;
    }

    /**
     * Get the value of userId
     *
     * @return  PersonId
     */
    public function getPersonId(): PersonId
    {
        return $this->personId;
    }

    /**
     * Get the value of username
     *
     * @return  string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * Get the value of email
     *
     * @return  EmailAddress
     */
    public function getEmail(): EmailAddress
    {
        return $this->email;
    }

    /**
     * Get the value of password
     *
     * @return  string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Get the value of authorizationToken
     *
     * @return  string
     */
    public function getAuthorizationToken(): string
    {
        return $this->authorizationToken;
    }

    /**
     * Get the value of cookieToken
     *
     * @return  string
     */
    public function getCookieToken(): string
    {
        return $this->cookieToken;
    }
}
