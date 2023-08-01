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

namespace Webify\User\Domain\Model\Account\ValueObject;

use Webify\Base\Domain\ValueObject\IncrementalIdValueObject;
use Webify\User\Domain\Model\Account\Exception\InvalidAccountIdException;

/**
 * This class represents a account's unique ID.
 */
final class AccountId extends IncrementalIdValueObject
{
	protected function throwException(array $params): void
	{
		throw new InvalidAccountIdException('invalid_account_id', $params);
	}
}
