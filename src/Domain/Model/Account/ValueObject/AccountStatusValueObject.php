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

/**
 * A value object type enum class that represents account statuses.
 */
enum AccountStatusValueObject: string
{
	case PENDING = 'pending';

	case ACTIVATED = 'activated';

	case BLOCKED = 'blocked';
}
