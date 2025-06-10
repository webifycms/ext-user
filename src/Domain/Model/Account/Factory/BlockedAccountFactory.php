<?php

/**
 * The file is part of the "webifycms/ext-user", WebifyCMS extension package.
 *
 * @see https://webifycms.com/extension/user
 *
 * @copyright Copyright (c) 2023 WebifyCMS
 * @license https://webifycms.com/extension/user/license
 * @author Mohammed Shifreen <mshifreen@gmail.com>
 */
declare(strict_types=1);

namespace Webify\User\Domain\Model\Account\Factory;

use Webify\Base\Domain\ValueObject\DateTimeValueObject;
use Webify\User\Domain\Model\Account\ActivatedAccount;
use Webify\User\Domain\Model\Account\BlockedAccount;

/**
 * Factory class is to create blocked account object.
 */
final class BlockedAccountFactory
{
	/**
	 * "Create a new blocked account object from an activated account.".
	 *
	 * The function is a factory method. It creates a new blocked account object from an activated account
	 * object.
	 *
	 * @param ActivatedAccount $activatedAccount The activated account that we want to block
	 */
	public function createFromActivatedAccount(ActivatedAccount $activatedAccount): BlockedAccount
	{
		$activatedAt = DateTimeValueObject::create(
			$activatedAccount->getActivatedAt(DateTimeValueObject::DEFAULT_FORMAT)
		);

		return new BlockedAccount(
			$activatedAccount->id,
			$activatedAccount->username,
			$activatedAccount->email,
			$activatedAccount->activationHash,
			$activatedAccount->registeredIp,
			$activatedAccount->password,
			$activatedAccount->passwordHash,
			$activatedAt->getDateTimeObject(),
			DateTimeValueObject::create()->getDateTimeObject()
		);
	}

	/**
	 * This function creates a new blocked account object from an array of arguments.
	 *
	 * @param array<string, mixed> $args the array of arguments to pass to the constructor, should be
	 *                                   in order of the constructor arguments
	 */
	public function createFromArray(array $args): BlockedAccount
	{
		return new BlockedAccount(...$args);
	}
}
