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

namespace Webify\User\Domain\Model\User\ValueObject;

use Webify\Base\Domain\ValueObject\UniqueIdValueObject;
use Webify\User\Domain\Model\Account\Exception\InvalidAccountIdException;

final class UserUuidValueObject extends UniqueIdValueObject
{
	protected function throwException(array $params): void
	{
		throw new InvalidAccountIdException('invalid_user_uuid', $params);
	}
}
