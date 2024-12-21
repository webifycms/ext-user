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

use Webify\Base\Domain\ValueObject\EmailValueObject;
use Webify\User\Domain\Model\Account\Exception\InvalidAccountEmailException;

/**
 * A value object that represents account email that is extended from EmailValueObject.
 */
final class AccountEmail extends EmailValueObject
{
	protected function throwException(array $params): void
	{
		throw new InvalidAccountEmailException('invalid_account_email', $params);
	}
}
