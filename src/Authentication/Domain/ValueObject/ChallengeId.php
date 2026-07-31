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

namespace Webify\User\Authentication\Domain\ValueObject;

use Webify\Base\Domain\ValueObject\AggregateId;
use Webify\User\Authentication\Domain\Exception\InvalidChallengeIdException;

/**
 * Challenge ID value object.
 *
 * Define a typed identity for an authentication challenge.
 */
final readonly class ChallengeId extends AggregateId
{
	/**
	 * Throws an exception for an invalid challenge ID.
	 *
	 * @throws InvalidChallengeIdException
	 */
	protected function throwException(string $value): never
	{
		throw InvalidChallengeIdException::forInvalidId($value);
	}
}
