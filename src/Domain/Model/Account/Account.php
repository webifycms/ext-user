<?php
/**
 * The file is part of the "webifycms/ext-user", WebifyCMS extension package.
 *
 * @see https://webifycms.com/extension/user
 *
 * @license Copyright (c) 2022 WebifyCMS
 * @license https://webifycms.com/extension/user/license
 * @author Mohammed Shifreen <mshifreen@gmail.com>
 */
declare(strict_types=1);

namespace Webify\User\Domain\Model\Account;

use Webify\User\Domain\Model\Account\ValueObject\AccountActivationHashValueObject;
use Webify\User\Domain\Model\Account\ValueObject\AccountEmail;
use Webify\User\Domain\Model\Account\ValueObject\AccountId;
use Webify\User\Domain\Model\Account\ValueObject\AccountPassword;
use Webify\User\Domain\Model\Account\ValueObject\AccountPasswordHash;
use Webify\User\Domain\Model\Account\ValueObject\AccountRegisteredIpValueObject;
use Webify\User\Domain\Model\Account\ValueObject\AccountUsername;

/**
 * Abstract class for the account entities.
 */
abstract class Account
{
	/**
	 * The object constructor.
	 */
	public function __construct(
		public readonly AccountId $id,
		public readonly AccountUsername $username,
		public readonly AccountEmail $email,
		public readonly AccountActivationHashValueObject $activationHash,
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
