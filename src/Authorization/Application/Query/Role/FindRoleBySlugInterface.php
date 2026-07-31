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

namespace Webify\User\Authorization\Application\Query\Role;

use Webify\User\Authorization\Domain\ValueObject\RoleSlug;

/**
 * Query class defines the contract for a query to find a role by its slug.
 */
interface FindRoleBySlugInterface
{
	/**
	 * Retrieves a Role model based on the given slug.
	 *
	 * @return null|Role the Role model if found, or null if no match is found
	 */
	public function find(RoleSlug $slug): ?Role;
}
