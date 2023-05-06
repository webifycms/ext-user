<?php

namespace Webify\User\Infrastructure\Persistance\Account;

use Webify\User\Domain\Model\Account\Account;
use Webify\User\Domain\Model\Account\AccountFactoryInterface;
use Webify\Base\Domain\Service\IdentityServiceInterface;

/**
 * AccountFactory class implementation.
 */
final class AccountFactory implements AccountFactoryInterface
{
    /**
     * AccountFactory constructor
     *
     * @param IdentityServiceInterface $identityService
     */
    public function __construct(private readonly IdentityServiceInterface $identityService)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function build(array $args): Account
    {
        # code...
    }
}
