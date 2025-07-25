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

use Webify\Base\Domain\ValueObject\UniqueIdValueObject;

final class PersonUidValueObject extends UniqueIdValueObject
{
	protected function throwException(array $params): void
	{
		// TODO: Implement throwException() method.
	}
}
