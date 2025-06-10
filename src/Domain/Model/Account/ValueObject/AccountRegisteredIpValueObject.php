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

namespace Webify\User\Domain\Model\Account\ValueObject;

use Webify\Base\Domain\ValueObject\IpValueObject;
use Webify\User\Domain\Model\Account\Exception\InvalidAccountIpException;

/**
 * An value object represents account registered IP address.
 */
final class AccountRegisteredIpValueObject extends IpValueObject
{
	protected function throwException(array $params): void
	{
		throw new InvalidAccountIpException();
	}
}
