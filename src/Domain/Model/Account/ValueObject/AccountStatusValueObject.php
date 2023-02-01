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

/**
 * A value object type enum class that represents account statuses.
 */
enum AccountStatusValueObject: string
{
	case PENDING = 'pending';

	case ACTIVATED = 'activated';

	case BLOCKED = 'blocked';
}
