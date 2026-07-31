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

namespace Webify\User\Test\Unit\Authorization\Domain\Service;

use PHPUnit\Framework\Attributes\{CoversClass, CoversMethod, Test};
use PHPUnit\Framework\TestCase;
use Webify\Base\Domain\Contract\Authorization\{AuthorizableResourceInterface, AuthorizableSubjectInterface};
use Webify\Base\Domain\Contract\Authorization\Service\RuleRegistryInterface;
use Webify\Base\Domain\Exception\AccessDeniedException;
use Webify\User\Authorization\Domain\Collection\{PermissionCollection, RoleAssignmentCollection};
use Webify\User\Authorization\Domain\Entity\{Role, RoleAssignment};
use Webify\User\Authorization\Domain\Repository\{RoleAssignmentRepositoryInterface, RoleRepositoryInterface};
use Webify\User\Authorization\Domain\Service\{Authorization, CheckAccess};
use Webify\User\Authorization\Domain\ValueObject\{Permission, RoleAssignmentId, RoleId, RoleName, RoleSlug, SubjectId};

/**
 * CheckAccessTest tests the functionality of the CheckAccess service.
 *
 * @internal
 */
#[CoversClass(CheckAccess::class)]
#[CoversMethod(CheckAccess::class, '__construct')]
#[CoversMethod(CheckAccess::class, 'isAllowed')]
#[CoversMethod(CheckAccess::class, 'denyUnless')]
final class CheckAccessTest extends TestCase
{
	/**
	 * The identifier for a specific role.
	 */
	private RoleId $roleId;

	/**
	 * The unique identifier for a specific subject.
	 */
	private SubjectId $subjectId;

	/**
	 * The unique identifier for a specific role assignment.
	 */
	private RoleAssignmentId $assignmentId;

	protected function setUp(): void
	{
		$this->roleId       = RoleId::fromString('01ARZ3NDEKTSV4RRFFQ69G5FAV');
		$this->subjectId    = SubjectId::fromString('01ARZ3NDEKTSV4RRFFQ69G5FBW');
		$this->assignmentId = RoleAssignmentId::fromString('01ARZ3NDEKTSV4RRFFQ69G5FDY');
	}

	/**
	 * Tests that the method isAllowed returns true when the authorization check passes.
	 */
	#[Test]
	public function testIsAllowedReturnsTrueWhenAuthorizationCheckPasses(): void
	{
		$permissions = PermissionCollection::from([
			Permission::fromNative([
				'scope'    => 'post',
				'action'   => 'read',
				'resource' => 'all',
			]),
		]);
		$role = Role::create(
			$this->roleId,
			RoleName::fromString('Editor'),
			RoleSlug::fromString('webify.editor'),
			$permissions,
			false
		);
		$assignment = RoleAssignment::assign(
			$this->assignmentId,
			$this->roleId,
			$this->subjectId
		);

		$roleRepository = $this->createStub(RoleRepositoryInterface::class);
		$roleRepository->method('getById')
			->willReturn($role)
		;

		$assignmentRepository = $this->createStub(RoleAssignmentRepositoryInterface::class);
		$assignmentRepository->method('getBySubjectId')
			->willReturn(RoleAssignmentCollection::from([$assignment]))
		;

		$ruleRegistry = $this->createStub(RuleRegistryInterface::class);
		$ruleRegistry->method('getAllApplicableTo')
			->willReturn([])
		;

		$authorization = $this->createAuthorization($roleRepository, $assignmentRepository, $ruleRegistry);

		$subject = $this->createStub(AuthorizableSubjectInterface::class);
		$subject->method('subjectId')
			->willReturn($this->subjectId->toNative())
		;
		$subject->method('tenantId')
			->willReturn(null)
		;

		$resource = $this->createStub(AuthorizableResourceInterface::class);
		$resource->method('resourceScope')
			->willReturn('post')
		;
		$resource->method('resourceType')
			->willReturn('all')
		;
		$resource->method('resourceId')
			->willReturn('01ARZ3NDEKTSV4RRFFQ69G5FBW')
		;
		$resource->method('ownerId')
			->willReturn(null)
		;
		$resource->method('tenantId')
			->willReturn(null)
		;

		$service = new CheckAccess($authorization);

		$this->assertTrue($service->isAllowed('read', $subject, $resource));
	}

	/**
	 * Tests that the method isAllowed returns false when the authorization check fails.
	 */
	#[Test]
	public function testIsAllowedReturnsFalseWhenAuthorizationCheckFails(): void
	{
		$permissions = PermissionCollection::from([
			Permission::fromNative([
				'scope'    => 'post',
				'action'   => 'write',
				'resource' => 'all',
			]),
		]);
		$role = Role::create(
			$this->roleId,
			RoleName::fromString('Editor'),
			RoleSlug::fromString('webify.editor'),
			$permissions,
			false
		);
		$assignment = RoleAssignment::assign(
			$this->assignmentId,
			$this->roleId,
			$this->subjectId
		);

		$roleRepository = $this->createStub(RoleRepositoryInterface::class);
		$roleRepository->method('getById')
			->willReturn($role)
		;

		$assignmentRepository = $this->createStub(RoleAssignmentRepositoryInterface::class);
		$assignmentRepository->method('getBySubjectId')
			->willReturn(RoleAssignmentCollection::from([$assignment]))
		;

		$ruleRegistry = $this->createStub(RuleRegistryInterface::class);
		$ruleRegistry->method('getAllApplicableTo')
			->willReturn([])
		;

		$authorization = $this->createAuthorization($roleRepository, $assignmentRepository, $ruleRegistry);

		$subject = $this->createStub(AuthorizableSubjectInterface::class);
		$subject->method('subjectId')
			->willReturn($this->subjectId->toNative())
		;
		$subject->method('tenantId')
			->willReturn(null)
		;

		$resource = $this->createStub(AuthorizableResourceInterface::class);
		$resource->method('resourceScope')
			->willReturn('post')
		;
		$resource->method('resourceType')
			->willReturn('all')
		;
		$resource->method('resourceId')
			->willReturn('01ARZ3NDEKTSV4RRFFQ69G5FBW')
		;
		$resource->method('ownerId')
			->willReturn(null)
		;
		$resource->method('tenantId')
			->willReturn(null)
		;

		$service = new CheckAccess($authorization);

		$this->assertFalse($service->isAllowed('delete', $subject, $resource));
	}

	/**
	 * Tests that the `isAllowed` method delegates to the `authorize` method of the injected
	 * `Authorization` implementation, verifying access permissions based on
	 * the provided action, subject, and resource.
	 */
	#[Test]
	public function testIsAllowedDelegatesToAuthorizationCheck(): void
	{
		$permissions = PermissionCollection::from([
			Permission::fromNative([
				'scope'    => 'post',
				'action'   => 'update',
				'resource' => 'all',
			]),
		]);
		$role = Role::create(
			$this->roleId,
			RoleName::fromString('Editor'),
			RoleSlug::fromString('webify.editor'),
			$permissions,
			false
		);
		$assignment = RoleAssignment::assign(
			$this->assignmentId,
			$this->roleId,
			$this->subjectId
		);

		$roleRepository = $this->createMock(RoleRepositoryInterface::class);
		$roleRepository->expects($this->once())
			->method('getById')
			->with($this->equalTo($this->roleId))
			->willReturn($role)
		;

		$assignmentRepository = $this->createMock(RoleAssignmentRepositoryInterface::class);
		$assignmentRepository->expects($this->once())
			->method('getBySubjectId')
			->with($this->isInstanceOf(SubjectId::class))
			->willReturn(RoleAssignmentCollection::from([$assignment]))
		;

		$ruleRegistry = $this->createStub(RuleRegistryInterface::class);
		$ruleRegistry->method('getAllApplicableTo')
			->willReturn([])
		;

		$authorization = $this->createAuthorization($roleRepository, $assignmentRepository, $ruleRegistry);

		$subject = $this->createStub(AuthorizableSubjectInterface::class);
		$subject->method('subjectId')
			->willReturn($this->subjectId->toNative())
		;
		$subject->method('tenantId')
			->willReturn(null)
		;

		$resource = $this->createStub(AuthorizableResourceInterface::class);
		$resource->method('resourceScope')
			->willReturn('post')
		;
		$resource->method('resourceType')
			->willReturn('all')
		;
		$resource->method('resourceId')
			->willReturn('01ARZ3NDEKTSV4RRFFQ69G5FBW')
		;
		$resource->method('ownerId')
			->willReturn(null)
		;
		$resource->method('tenantId')
			->willReturn(null)
		;

		$service = new CheckAccess($authorization);

		$service->isAllowed('update', $subject, $resource);
	}

	/**
	 * Tests that the `denyUnless` method does not throw an exception when access is allowed.
	 *
	 * This test verifies that the `CheckAccess` service correctly proceeds without error
	 * when the `Authorization` authorizes the requested action for the specified
	 * subject and resource.
	 */
	#[Test]
	public function testDenyUnlessDoesNotThrowWhenAccessIsAllowed(): void
	{
		$permissions = PermissionCollection::from([
			Permission::fromNative([
				'scope'    => 'post',
				'action'   => 'read',
				'resource' => 'all',
			]),
		]);
		$role = Role::create(
			$this->roleId,
			RoleName::fromString('Editor'),
			RoleSlug::fromString('webify.editor'),
			$permissions,
			false
		);
		$assignment = RoleAssignment::assign(
			$this->assignmentId,
			$this->roleId,
			$this->subjectId
		);

		$roleRepository = $this->createStub(RoleRepositoryInterface::class);
		$roleRepository->method('getById')
			->willReturn($role)
		;

		$assignmentRepository = $this->createStub(RoleAssignmentRepositoryInterface::class);
		$assignmentRepository->method('getBySubjectId')
			->willReturn(RoleAssignmentCollection::from([$assignment]))
		;

		$ruleRegistry = $this->createStub(RuleRegistryInterface::class);
		$ruleRegistry->method('getAllApplicableTo')
			->willReturn([])
		;

		$authorization = $this->createAuthorization($roleRepository, $assignmentRepository, $ruleRegistry);

		$subject = $this->createStub(AuthorizableSubjectInterface::class);
		$subject->method('subjectId')
			->willReturn($this->subjectId->toNative())
		;
		$subject->method('tenantId')
			->willReturn(null)
		;

		$resource = $this->createStub(AuthorizableResourceInterface::class);
		$resource->method('resourceScope')
			->willReturn('post')
		;
		$resource->method('resourceType')
			->willReturn('all')
		;
		$resource->method('resourceId')
			->willReturn('01ARZ3NDEKTSV4RRFFQ69G5FBW')
		;
		$resource->method('ownerId')
			->willReturn(null)
		;
		$resource->method('tenantId')
			->willReturn(null)
		;

		$service = new CheckAccess($authorization);

		$this->expectNotToPerformAssertions();
		$service->denyUnless('read', $subject, $resource);
	}

	/**
	 * Tests that the `denyUnless` method throws an `AccessDeniedException` when access is denied.
	 *
	 * This test verifies that the `CheckAccess` service correctly throws an `AccessDeniedException`
	 * when the `Authorization` denies the requested action for the specified subject and resource.
	 */
	#[Test]
	public function testDenyUnlessThrowsAccessDeniedExceptionWhenAccessIsDenied(): void
	{
		$permissions = PermissionCollection::from([
			Permission::fromNative([
				'scope'    => 'post',
				'action'   => 'write',
				'resource' => 'all',
			]),
		]);
		$role = Role::create(
			$this->roleId,
			RoleName::fromString('Editor'),
			RoleSlug::fromString('webify.editor'),
			$permissions,
			false
		);
		$assignment = RoleAssignment::assign(
			$this->assignmentId,
			$this->roleId,
			$this->subjectId
		);

		$roleRepository = $this->createStub(RoleRepositoryInterface::class);
		$roleRepository->method('getById')
			->willReturn($role)
		;

		$assignmentRepository = $this->createStub(RoleAssignmentRepositoryInterface::class);
		$assignmentRepository->method('getBySubjectId')
			->willReturn(RoleAssignmentCollection::from([$assignment]))
		;

		$ruleRegistry = $this->createStub(RuleRegistryInterface::class);
		$ruleRegistry->method('getAllApplicableTo')
			->willReturn([])
		;

		$authorization = $this->createAuthorization($roleRepository, $assignmentRepository, $ruleRegistry);

		$subjectId  = '01ARZ3NDEKTSV4RRFFQ69G5FAV';
		$resourceId = '01ARZ3NDEKTSV4RRFFQ69G5FBW';

		$subject = $this->createStub(AuthorizableSubjectInterface::class);
		$subject->method('subjectId')
			->willReturn($subjectId)
		;
		$subject->method('tenantId')
			->willReturn(null)
		;

		$resource = $this->createStub(AuthorizableResourceInterface::class);
		$resource->method('resourceScope')
			->willReturn('post')
		;
		$resource->method('resourceType')
			->willReturn('all')
		;
		$resource->method('resourceId')
			->willReturn($resourceId)
		;
		$resource->method('ownerId')
			->willReturn(null)
		;
		$resource->method('tenantId')
			->willReturn(null)
		;

		$service = new CheckAccess($authorization);

		$this->expectException(AccessDeniedException::class);
		$this->expectExceptionMessage(
			sprintf(
				'Access denied for action "delete" on subject "%s" and resource "%s".',
				$subjectId,
				$resourceId
			)
		);
		$service->denyUnless('delete', $subject, $resource);
	}

	/**
	 * Tests that the `denyUnless` method delegates to the `Authorization` for permission checks.
	 *
	 * This test ensures that the `CheckAccess` service calls the `authorize` method on the `Authorization`
	 * with the expected action, subject, and resource. It verifies that the `authorize` method is invoked
	 * exactly once and returns `true` to allow the requested action.
	 */
	#[Test]
	public function testDenyUnlessDelegatesToAuthorizationCheck(): void
	{
		$permissions = PermissionCollection::from([
			Permission::fromNative([
				'scope'    => 'post',
				'action'   => 'manage',
				'resource' => 'all',
			]),
		]);
		$role = Role::create(
			$this->roleId,
			RoleName::fromString('Editor'),
			RoleSlug::fromString('webify.editor'),
			$permissions,
			false
		);
		$assignment = RoleAssignment::assign(
			$this->assignmentId,
			$this->roleId,
			$this->subjectId
		);

		$roleRepository = $this->createMock(RoleRepositoryInterface::class);
		$roleRepository->expects($this->once())
			->method('getById')
			->with($this->equalTo($this->roleId))
			->willReturn($role)
		;

		$assignmentRepository = $this->createMock(RoleAssignmentRepositoryInterface::class);
		$assignmentRepository->expects($this->once())
			->method('getBySubjectId')
			->with($this->isInstanceOf(SubjectId::class))
			->willReturn(RoleAssignmentCollection::from([$assignment]))
		;

		$ruleRegistry = $this->createStub(RuleRegistryInterface::class);
		$ruleRegistry->method('getAllApplicableTo')
			->willReturn([])
		;

		$authorization = $this->createAuthorization($roleRepository, $assignmentRepository, $ruleRegistry);

		$subject = $this->createStub(AuthorizableSubjectInterface::class);
		$subject->method('subjectId')
			->willReturn($this->subjectId->toNative())
		;
		$subject->method('tenantId')
			->willReturn(null)
		;

		$resource = $this->createStub(AuthorizableResourceInterface::class);
		$resource->method('resourceScope')
			->willReturn('post')
		;
		$resource->method('resourceType')
			->willReturn('all')
		;
		$resource->method('resourceId')
			->willReturn('01ARZ3NDEKTSV4RRFFQ69G5FBW')
		;
		$resource->method('ownerId')
			->willReturn(null)
		;
		$resource->method('tenantId')
			->willReturn(null)
		;

		$service = new CheckAccess($authorization);

		$service->denyUnless('manage', $subject, $resource);
	}

	/**
	 * Creates an Authorization instance with the given dependencies.
	 */
	private function createAuthorization(
		RoleRepositoryInterface $roleRepository,
		RoleAssignmentRepositoryInterface $assignmentRepository,
		RuleRegistryInterface $ruleRegistry
	): Authorization {
		return new Authorization($roleRepository, $assignmentRepository, $ruleRegistry);
	}
}
