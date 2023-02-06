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

namespace OneCMS\User\Application\Account\Request;

use OneCMS\User\Domain\Model\Account\ValueObject\AccountId;

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
