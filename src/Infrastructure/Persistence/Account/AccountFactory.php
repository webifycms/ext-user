<?php

namespace OneCMS\User\Infrastructure\Persistance\Account;

use OneCMS\User\Domain\Model\Account\Account;
use OneCMS\User\Domain\Model\Account\AccountFactoryInterface;
use OneCMS\Base\Domain\Service\IdentityServiceInterface;

/**
 * AccountFactory class implementation.
 */
final class AccountFactory implements AccountFactoryInterface
{
    private IdentityServiceInterface $identityService;

    /**
     * AccountFactory constructor
     *
     * @param IdentityServiceInterface $identityService
     */
    public function __construct(IdentityServiceInterface $identityService)
    {
        $this->identityService = $identityService;
    }

    /**
     * {@inheritDoc}
     */
    public function build(array $args): Account
    {
        # code...
    }
}
