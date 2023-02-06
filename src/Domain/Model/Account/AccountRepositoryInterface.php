<?php

declare(strict_types=1);

namespace OneCMS\User\Domain\Model\Account;

use OneCMS\User\Domain\Model\Account\ValueObject\AccountId;

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
