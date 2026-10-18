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

namespace Webify\User\Context\Authorization\Domain\ValueObject;

use Webify\Base\Domain\ValueObject\AggregateId;
use Webify\User\Context\Authorization\Domain\Exception\InvalidTenantIdException;

/**
 * Tenant ID value object.
 */
final readonly class TenantId extends AggregateId
{
	/**
	 * Throws an exception if the value is not valid.
	 *
	 * @throws InvalidTenantIdException
	 */
	protected function throwException(string $value): never
	{
		throw InvalidTenantIdException::forInvalidId($value);
	}
}
