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

namespace Webify\User\Authentication\Application\Query\Session;

use Webify\Base\Contract\Collection\Collection;

/**
 * Collection class for Session's read models.
 *
 * @extends Collection<Session>
 */
final class SessionCollection extends Collection
{
	/**
	 * {@inheritDoc}
	 */
	protected function type(): string
	{
		return Session::class;
	}
}
