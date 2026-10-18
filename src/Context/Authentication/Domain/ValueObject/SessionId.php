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

namespace Webify\User\Context\Authentication\Domain\ValueObject;

use Webify\Base\Domain\ValueObject\AggregateId;
use Webify\User\Context\Authentication\Domain\Exception\InvalidSessionIdException;

/**
 * Session ID value object.
 *
 * Define a typed identity for an authentication session.
 */
final readonly class SessionId extends AggregateId
{
	/**
	 * Will throw an exception if the token id value is not valid.
	 *
	 * @throws InvalidSessionIdException
	 */
	protected function throwException(string $value): never
	{
		throw InvalidSessionIdException::forInvalidId($value);
	}
}
