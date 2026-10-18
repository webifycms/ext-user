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

namespace Webify\User\Context\Identity\Application\Query\User;

use Webify\Base\Contract\Collection\Collection;

/**
 * Collection class for User-read models.
 *
 * @extends Collection<User>
 */
final class UserCollection extends Collection
{
	/**
	 * {@inheritDoc}
	 */
	protected function type(): string
	{
		return User::class;
	}
}
