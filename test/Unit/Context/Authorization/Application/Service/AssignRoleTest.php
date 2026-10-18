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

namespace Webify\User\Test\Unit\Context\Authorization\Application\Service;

use DateTimeImmutable;
use PHPUnit\Framework\Attributes\{CoversClass, CoversMethod, Test};
use PHPUnit\Framework\TestCase;
use Webify\Base\Domain\Event\DomainEventPublisherInterface;
use Webify\Base\Domain\Service\UlidGeneratorInterface;
use Webify\User\Context\Authorization\Application\Service\AssignRole;
use Webify\User\Context\Authorization\Domain\Collection\PermissionCollection;
use Webify\User\Context\Authorization\Domain\Entity\Role;
use Webify\User\Context\Authorization\Domain\Exception\DuplicateRoleAssignmentException;
use Webify\User\Context\Authorization\Domain\Guard\DuplicateRoleAssignment;
use Webify\User\Context\Authorization\Domain\Repository\{RoleAssignmentRepositoryInterface, RoleRepositoryInterface};
use Webify\User\Context\Authorization\Domain\ValueObject\{RoleId, RoleName, RoleSlug, SubjectId, TenantId};

/**
 * RoleAssignTest tests the functionality of the RoleAssign service.
 *
 * @internal
 */
#[CoversClass(AssignRole::class)]
#[CoversMethod(AssignRole::class, 'assign')]
final class AssignRoleTest extends TestCase
{
	/**
	 * Identifier for the role.
	 */
	private RoleId $roleId;

	/**
	 * Identifier for the subject.
	 */
	private SubjectId $subjectId;

	/**
	 * Identifier for the tenant.
	 */
	private TenantId $tenantId;

	/**
	 * Slug for the role.
	 */
	private RoleSlug $roleSlug;

	/**
	 * {@inheritDoc}
	 */
	protected function setUp(): void
	{
		$this->roleId    = RoleId::fromString('01ARZ3NDEKTSV4RRFFQ69G5FAV');
		$this->subjectId = SubjectId::fromString('01ARZ3NDEKTSV4RRFFQ69G5FBW');
		$this->tenantId  = TenantId::fromString('01ARZ3NDEKTSV4RRFFQ69G5FCX');
		$this->roleSlug  = RoleSlug::fromString('system.admin');
	}

	/**
	 * Tests that a role can be assigned successfully.
	 */
	#[Test]
	public function testAssignRoleSuccessfully(): void
	{
		$role = Role::create(
			$this->roleId,
			RoleName::fromString('Admin'),
			$this->roleSlug,
			new PermissionCollection()
		);
		$roleRepository = $this->createStub(RoleRepositoryInterface::class);

		$roleRepository->method('getBySlug')
			->willReturn($role)
		;

		$roleAssignmentRepository = $this->createMock(RoleAssignmentRepositoryInterface::class);

		$roleAssignmentRepository->expects($this->once())
			->method('persist')
		;

		$idGenerator = $this->createStub(UlidGeneratorInterface::class);

		$idGenerator->method('generate')
			->willReturn('01ARZ3NDEKTSV4RRFFQ69G5FDY')
		;

		$duplicateRoleAssignmentRepo = $this->createStub(RoleAssignmentRepositoryInterface::class);

		$duplicateRoleAssignmentRepo->method('isExists')
			->willReturn(false)
		;

		$duplicateRoleAssignment = new DuplicateRoleAssignment($duplicateRoleAssignmentRepo);
		$eventPublisher          = $this->createMock(DomainEventPublisherInterface::class);

		$eventPublisher->expects($this->once())
			->method('publish')
		;

		$service = new AssignRole(
			$roleRepository,
			$roleAssignmentRepository,
			$idGenerator,
			$duplicateRoleAssignment,
			$eventPublisher
		);

		$service->assign($this->subjectId->toNative(), (string) $this->roleSlug);
	}

	/**
	 * Tests that a role can be assigned with a tenant ID.
	 */
	#[Test]
	public function testAssignRoleWithTenantId(): void
	{
		$role = Role::create(
			$this->roleId,
			RoleName::fromString('Admin'),
			$this->roleSlug,
			new PermissionCollection()
		);
		$roleRepository = $this->createStub(RoleRepositoryInterface::class);

		$roleRepository->method('getBySlug')
			->willReturn($role)
		;

		$roleAssignmentRepository = $this->createMock(RoleAssignmentRepositoryInterface::class);

		$roleAssignmentRepository->expects($this->once())
			->method('persist')
		;

		$idGenerator = $this->createStub(UlidGeneratorInterface::class);

		$idGenerator->method('generate')
			->willReturn('01ARZ3NDEKTSV4RRFFQ69G5FDY')
		;

		$duplicateRoleAssignmentRepo = $this->createStub(RoleAssignmentRepositoryInterface::class);

		$duplicateRoleAssignmentRepo->method('isExists')
			->willReturn(false)
		;

		$duplicateRoleAssignment = new DuplicateRoleAssignment($duplicateRoleAssignmentRepo);
		$eventPublisher          = $this->createMock(DomainEventPublisherInterface::class);

		$eventPublisher->expects($this->once())
			->method('publish')
		;

		$service = new AssignRole(
			$roleRepository,
			$roleAssignmentRepository,
			$idGenerator,
			$duplicateRoleAssignment,
			$eventPublisher
		);

		$service->assign(
			$this->subjectId->toNative(),
			(string) $this->roleSlug,
			$this->tenantId->toNative()
		);
	}

	/**
	 * Tests that a role can be assigned with an expiration date.
	 */
	#[Test]
	public function testAssignRoleWithExpiresAt(): void
	{
		$role = Role::create(
			$this->roleId,
			RoleName::fromString('Admin'),
			$this->roleSlug,
			new PermissionCollection()
		);
		$roleRepository = $this->createStub(RoleRepositoryInterface::class);

		$roleRepository->method('getBySlug')
			->willReturn($role)
		;

		$roleAssignmentRepository = $this->createMock(RoleAssignmentRepositoryInterface::class);

		$roleAssignmentRepository->expects($this->once())
			->method('persist')
		;

		$idGenerator = $this->createStub(UlidGeneratorInterface::class);

		$idGenerator->method('generate')
			->willReturn('01ARZ3NDEKTSV4RRFFQ69G5FDY')
		;

		$duplicateRoleAssignmentRepo = $this->createStub(RoleAssignmentRepositoryInterface::class);

		$duplicateRoleAssignmentRepo->method('isExists')
			->willReturn(false)
		;

		$duplicateRoleAssignment = new DuplicateRoleAssignment($duplicateRoleAssignmentRepo);
		$eventPublisher          = $this->createMock(DomainEventPublisherInterface::class);

		$eventPublisher->expects($this->once())
			->method('publish')
		;

		$service = new AssignRole(
			$roleRepository,
			$roleAssignmentRepository,
			$idGenerator,
			$duplicateRoleAssignment,
			$eventPublisher
		);

		$expireAt = new DateTimeImmutable('+1 hour');

		$service->assign(
			$this->subjectId->toNative(),
			(string) $this->roleSlug,
			null,
			$expireAt
		);
	}

	/**
	 * Tests that duplicate role assigning throws an exception.
	 */
	#[Test]
	public function testDuplicateRoleAssignmentThrowsException(): void
	{
		$role = Role::create(
			$this->roleId,
			RoleName::fromString('Admin'),
			$this->roleSlug,
			new PermissionCollection()
		);
		$roleRepository = $this->createStub(RoleRepositoryInterface::class);

		$roleRepository->method('getBySlug')
			->willReturn($role)
		;

		$duplicateRoleAssignmentRepo = $this->createStub(RoleAssignmentRepositoryInterface::class);

		$duplicateRoleAssignmentRepo->method('isExists')
			->willReturn(true)
		;

		$duplicateRoleAssignment  = new DuplicateRoleAssignment($duplicateRoleAssignmentRepo);
		$roleAssignmentRepository = $this->createMock(RoleAssignmentRepositoryInterface::class);

		$roleAssignmentRepository->expects($this->never())
			->method('persist')
		;

		$idGenerator    = $this->createStub(UlidGeneratorInterface::class);
		$eventPublisher = $this->createMock(DomainEventPublisherInterface::class);

		$eventPublisher->expects($this->never())
			->method('publish')
		;

		$service = new AssignRole(
			$roleRepository,
			$roleAssignmentRepository,
			$idGenerator,
			$duplicateRoleAssignment,
			$eventPublisher
		);

		$this->expectException(DuplicateRoleAssignmentException::class);
		$service->assign($this->subjectId->toNative(), (string) $this->roleSlug);
	}
}
