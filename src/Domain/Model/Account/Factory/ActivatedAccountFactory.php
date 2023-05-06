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

namespace Webify\User\Domain\Model\Account\Factory;

use Webify\Base\Domain\ValueObject\DateTimeValueObject;
use Webify\User\Domain\Model\Account\ActivatedAccount;
use Webify\User\Domain\Model\Account\BlockedAccount;
use Webify\User\Domain\Model\Account\PendingAccount;

/**
 * Factory class is to create activated account object.
 */
final class ActivatedAccountFactory
{
	/**
	 * "Create a new activated account from an pending account.".
	 *
	 * The function is a factory method. It creates a new activated account object from an pending account
	 * object.
	 *
	 * @param PendingAccount $pendingAccount The pending account that we want to activate
	 */
	public function createFromPendingAccount(PendingAccount $pendingAccount): ActivatedAccount
	{
		return new ActivatedAccount(
			$pendingAccount->id,
			$pendingAccount->username,
			$pendingAccount->email,
			$pendingAccount->activationHash,
			$pendingAccount->registeredIp,
			$pendingAccount->password,
			$pendingAccount->passwordHash,
			DateTimeValueObject::create()->getDateTimeObject()
		);
	}

	/**
	 * "Create a new activated account from an blocked account.".
	 *
	 * The function is a factory method. It creates a new activated account object from an blocked account
	 * object.
	 *
	 * @param BlockedAccount $blockedAccount The blocked account that we want to unblock
	 */
	public function createFromBlockedAccount(BlockedAccount $blockedAccount): ActivatedAccount
	{
		$activatedAt = DateTimeValueObject::create(
			$blockedAccount->getActivatedAt(DateTimeValueObject::DEFAULT_FORMAT)
		);

		return new ActivatedAccount(
			$blockedAccount->id,
			$blockedAccount->username,
			$blockedAccount->email,
			$blockedAccount->activationHash,
			$blockedAccount->registeredIp,
			$blockedAccount->password,
			$blockedAccount->passwordHash,
			$activatedAt->getDateTimeObject()
		);
	}

	/**
	 * This function creates a new activated account object from an array of arguments.
	 *
	 * @param array<string, mixed> $args the array of arguments to pass to the constructor, should be
	 *                                   in order of the constructor arguments
	 */
	public function createFromArray(array $args): ActivatedAccount
	{
		return new ActivatedAccount(...$args);
	}
}
