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

namespace Webify\User\Identity\Domain\ValueObject;

/**
 * The user status value object.
 */
enum UserStatus: string
{
	case Active      = 'active';
	case Inactive    = 'inactive';
	case Deactivated = 'deactivated';

	/**
	 * Check if the user is active.
	 */
	public function isActive(): bool
	{
		return self::Active === $this;
	}

	/**
	 * Check if the user is inactive.
	 */
	public function isInactive(): bool
	{
		return self::Inactive === $this;
	}

	/**
	 * Check if the user is deactivated.
	 */
	public function isDeactivated(): bool
	{
		return self::Deactivated === $this;
	}
}
