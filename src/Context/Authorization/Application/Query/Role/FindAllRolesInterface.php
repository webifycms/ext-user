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

namespace Webify\User\Context\Authorization\Application\Query\Role;

/**
 * Query class defines the contract for a query to find all roles.
 */
interface FindAllRolesInterface
{
	/**
	 * Retrieves a collection of all Role models.
	 *
	 * @return RoleCollection the collection containing all Role models
	 */
	public function findAll(): RoleCollection;
}
