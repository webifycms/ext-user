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

use OneCMS\User\Domain\Model\Account\ValueObject\AccountStatusValueObject;

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

	/**
	 * {@inheritDoc}
	 */
	public function getStatus(): string
	{
		return $this->status->value;
	}
}
