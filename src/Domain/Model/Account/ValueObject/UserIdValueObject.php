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

namespace OneCMS\User\Domain\Model\Account\ValueObject;

use OneCMS\Base\Domain\Exception\TranslatableInvalidArgumentException;
use OneCMS\Base\Domain\ValueObject\IncrementalIdValueObject;

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
