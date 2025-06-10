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

namespace Webify\User\Domain\Model\Person\ValueObject;

use Webify\Base\Domain\ValueObject\EmailValueObject;
use Webify\User\Domain\Model\Person\Exception\InvalidPersonEmailException;

/**
 * This class represents a person's email address.
 */
final class PersonEmail extends EmailValueObject
{
	protected function throwException(array $params): void
	{
		throw new InvalidPersonEmailException('invalid_person_email', $params);
	}
}
