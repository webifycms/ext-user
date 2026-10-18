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

/**
 * The authentication challenge status value object.
 */
enum ChallengeStatus: string
{
	case Pending   = 'pending';
	case Completed = 'completed';

	/**
	 * Check if the challenge is pending.
	 */
	public function isPending(): bool
	{
		return self::Pending === $this;
	}

	/**
	 * Check if the challenge is completed.
	 */
	public function isCompleted(): bool
	{
		return self::Completed === $this;
	}
}
