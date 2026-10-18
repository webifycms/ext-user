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

namespace Webify\User\Context\Authorization\Application\Query\RoleAssignment;

use Webify\User\Context\Authorization\Domain\ValueObject\TenantId;

/**
 * Query class defines the contract for a query to find role assignments by tenant.
 */
interface FindRoleAssignmentsByTenantInterface
{
	/**
	 * Retrieves a collection of role assignment read models associated with a specific tenant.
	 *
	 * @param TenantId $tenantId the identifier of the tenant
	 *
	 * @return RoleAssignmentCollection the collection of role assignment read models for the given tenant
	 */
	public function find(TenantId $tenantId): RoleAssignmentCollection;
}
