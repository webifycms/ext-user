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

use Webify\Base\Domain\Exception\TranslatableInvalidArgumentException;
use Webify\Base\Domain\ValueObject\IncrementalIdValueObject;

/**
 * It's a value object that represents a user's ID.
 */
final class UserIdValueObject extends IncrementalIdValueObject
{
	/**
	 * {@inheritDoc}
	 */
	protected function throwException(array $params): void
	{
		throw new TranslatableInvalidArgumentException('invalid_user_id');
	}
}
