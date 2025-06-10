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

namespace Webify\User\Domain\Model\Account;

use Webify\User\Domain\Model\Account\Factory\ActivatedAccountFactory;
use Webify\User\Domain\Model\Account\ValueObject\AccountStatusValueObject;

/**
 * Entity class that have the state of pending and represents as pending account.
 * This is the default account status.
 */
final class PendingAccount extends Account
{
	/**
	 * The pending account status.
	 */
	private AccountStatusValueObject $status = AccountStatusValueObject::PENDING;

	public function getStatus(): string
	{
		return $this->status->value;
	}

	/**
	 * Activate the account.
	 * Only pending account can be activated.
	 */
	public function activate(): ActivatedAccount
	{
		return (new ActivatedAccountFactory())->createFromPendingAccount($this);
	}
}
