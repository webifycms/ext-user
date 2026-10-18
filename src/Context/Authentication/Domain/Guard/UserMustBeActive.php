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

namespace Webify\User\Context\Authentication\Domain\Guard;

use Webify\User\Context\Authentication\Domain\Exception\AuthenticationFailedException;
use Webify\User\Domain\ValueObject\UserStatus;

/**
 * Guard that ensures that the user is active.
 */
final class UserMustBeActive
{
	/**
	 * Ensures that the given status meets the required conditions.
	 *
	 * @param UserStatus $status the status to be checked
	 */
	public function guard(UserStatus $status): void
	{
		if (!$status->isActive()) {
			throw AuthenticationFailedException::userNotActive();
		}
	}
}
