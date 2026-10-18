<?php

/**
 * The file is part of the "webifycms/ext-user", WebifyCMS extension package.
 *
 * @see https://webifycms.com/extension/user
 *
 * @copyright Copyright (c) 2023 - Present WebifyCMS
 * @license https://webifycms.com/license
 * @author Mohammed Shifreen <mshifreen@gmail.com>
 */
declare(strict_types=1);

namespace Webify\User\Domain\ValueObject;

use Webify\Base\Domain\ValueObject\AggregateId;
use Webify\User\Domain\Exception\InvalidUserIdException;

/**
 * The user ID value object.
 *
 * Shared by every context, so it lives in the shared kernel. Identity owns the user aggregate
 * and is therefore the canonical home of the user id translation group.
 */
final readonly class UserId extends AggregateId
{
	/**
	 * Will throw an exception if the user id value is not valid.
	 *
	 * @throws InvalidUserIdException
	 */
	protected function throwException(string $value): never
	{
		throw InvalidUserIdException::forInvalidId($value);
	}
}
