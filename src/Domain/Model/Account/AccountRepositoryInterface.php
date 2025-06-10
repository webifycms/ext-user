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

use Webify\User\Domain\Model\Account\ValueObject\AccountId;

/**
 * Undocumented interface.
 */
interface AccountRepositoryInterface
{
	public function persist(Account $account): void;

	/**
	 * @todo This method should be remove because it is temporary.
	 */
	public function getPendingAccountById(AccountId $id): PendingAccount;
}
