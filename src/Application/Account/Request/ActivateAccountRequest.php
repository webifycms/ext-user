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

namespace Webify\User\Application\Account\Request;

use Webify\User\Domain\Model\Account\ValueObject\AccountId;

final class ActivateAccountRequest
{
	private AccountId $accountId;

	public function __construct(
		int $id
	) {
		$this->accountId = AccountId::createFromString((string) $id);
	}

	public function getAccountId(): AccountId
	{
		return $this->accountId;
	}
}
