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

namespace Webify\User\Context\Authorization\Application\Service;

use Webify\Base\Domain\Contract\Authorization\{AuthorizableResourceInterface, AuthorizableSubjectInterface};
use Webify\Base\Domain\Exception\AccessDeniedException;
use Webify\User\Context\Authorization\Domain\Service\Authorization;

/**
 * CheckAccess is the implementation of the `CheckAccessInterface` that uses the
 * `AuthorizationInterface` to check access permissions.
 */
final readonly class CheckAccess
{
	/**
	 * The constructor.
	 */
	public function __construct(
		private Authorization $authorization
	) {}

	/**
	 * Checks if the given subject has permission to perform the specified action on the resource.
	 *
	 * @param string                        $action   the action being performed
	 * @param AuthorizableSubjectInterface  $subject  the subject performing the action
	 * @param AuthorizableResourceInterface $resource the resource being accessed
	 *
	 * @return bool true if access is allowed, false otherwise
	 */
	public function isAllowed(
		string $action,
		AuthorizableSubjectInterface $subject,
		AuthorizableResourceInterface $resource
	): bool {
		return $this->authorization->authorize($action, $subject, $resource);
	}

	/**
	 * Checks if the given subject has permission to perform the specified action on the resource,
	 * and throws an `AccessDeniedException` if access is denied.
	 *
	 * @param string                        $action   the action being performed
	 * @param AuthorizableSubjectInterface  $subject  the subject performing the action
	 * @param AuthorizableResourceInterface $resource the resource being accessed
	 *
	 * @throws AccessDeniedException if access is denied
	 */
	public function denyUnless(
		string $action,
		AuthorizableSubjectInterface $subject,
		AuthorizableResourceInterface $resource
	): void {
		if (!$this->authorization->authorize($action, $subject, $resource)) {
			throw AccessDeniedException::deniedFor($action, $subject->subjectId(), $resource->resourceId());
		}
	}
}
