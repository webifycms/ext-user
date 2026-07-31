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

/**
 * The user status value object.
 */
enum UserStatus: string
{
	case Active     = 'active';
	case Unverified = 'unverified';

	/**
	 * Check if the user is active.
	 */
	public function isActive(): bool
	{
		return self::Active === $this;
	}
}
