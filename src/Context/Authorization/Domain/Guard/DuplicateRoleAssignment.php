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

namespace Webify\User\Context\Authorization\Domain\Guard;

use Webify\User\Context\Authorization\Domain\Exception\DuplicateRoleAssignmentException;
use Webify\User\Context\Authorization\Domain\Repository\RoleAssignmentRepositoryInterface;
use Webify\User\Context\Authorization\Domain\ValueObject\{RoleId, SubjectId, TenantId};

/**
 * Guard class to prevent duplicate role assignments.
 */
final readonly class DuplicateRoleAssignment
{
	/**
	 * The constructor.
	 */
	public function __construct(
		private RoleAssignmentRepositoryInterface $repository
	) {}

	/**
	 * Ensures that a role-subject assignment does not already exist.
	 *
	 * @param RoleId        $roleId    the identifier for the role
	 * @param SubjectId     $subjectId the identifier for the subject
	 * @param null|TenantId $tenantId  the identifier for the tenant, if applicable
	 *
	 * @throws DuplicateRoleAssignmentException if the role-subject assignment already exists
	 */
	public function guard(RoleId $roleId, SubjectId $subjectId, ?TenantId $tenantId = null): void
	{
		if ($this->repository->isExists($roleId, $subjectId, $tenantId)) {
			throw DuplicateRoleAssignmentException::forRoleAndSubject(
				$roleId->toNative(),
				$subjectId->toNative(),
				$tenantId?->toNative()
			);
		}
	}
}
