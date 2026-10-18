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
use Webify\User\Context\Authorization\Domain\Exception\InvalidSubjectIdException;

/**
 * Subject ID value object.
 */
final readonly class SubjectId extends AggregateId
{
	/**
	 * Throws an exception if the value is not valid.
	 *
	 * @throws InvalidSubjectIdException
	 */
	protected function throwException(string $value): never
	{
		throw InvalidSubjectIdException::forInvalidId($value);
	}
}
