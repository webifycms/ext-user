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

namespace Webify\User\Context\Authorization\Domain\Collection;

use Webify\Base\Contract\Collection\Collection;
use Webify\User\Context\Authorization\Domain\ValueObject\Permission;

/**
 * Permission collection.
 *
 * @extends Collection<Permission>
 */
final class PermissionCollection extends Collection
{
	/**
	 * {@inheritDoc}
	 */
	protected function type(): string
	{
		return Permission::class;
	}
}
