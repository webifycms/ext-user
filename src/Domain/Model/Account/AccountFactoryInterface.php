<?php
declare(strict_types=1);

namespace Webify\User\Domain\Model\Account;

/**
 * Undocumented interface
 */
interface AccountFactoryInterface
{
    /**
     * Build a new account entity. In order to build account entity, following properties are required.
     *
     * Required properties:
     * accountId
     * person
     * email
     * username
     * passwordHash
     * validationToken
     * activation
     *
     * @param array $args
     */
    public function build(array $args): Account;
}
