<?php
/**
 * The file is part of the "getonecms/ext-user", OneCMS extension package.
 *
 * @see https://getonecms.com/extension/user
 *
 * @license Copyright (c) 2022 OneCMS
 * @license https://getonecms.com/extension/user/license
 * @author Mohammed Shifreen <mshifreen@gmail.com>
 */
declare(strict_types=1);

namespace OneCMS\User\Domain\Model\Account;

use OneCMS\User\Domain\Model\Account\ValueObject\AccountEmail;
use OneCMS\User\Domain\Model\Account\ValueObject\AccountId;
use OneCMS\User\Domain\Model\Account\ValueObject\AccountPassword;
use OneCMS\User\Domain\Model\Account\ValueObject\AccountPasswordHash;
use OneCMS\User\Domain\Model\Account\ValueObject\AccountRegisteredIpValueObject;
use OneCMS\User\Domain\Model\Account\ValueObject\AccountUsername;

/**
 * The Account entity class holds the user's account information.
 */
abstract class Account
{
	/**
	 * The object constructor.
	 */
	final public function __construct(
		public readonly AccountId $id,
		public readonly AccountUsername $username,
		public readonly AccountEmail $email,
		public readonly ?AccountRegisteredIpValueObject $registeredIp = null,
		public readonly ?AccountPassword $password = null,
		public readonly ?AccountPasswordHash $passwordHash = null
	) {
	}

	/**
	 * Returns the state of the account as string.
	 */
	abstract public function getStatus(): string;
}
