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

namespace Webify\User\Context\Identity\Domain\Repository;

use Webify\User\Context\Identity\Domain\Entity\User;
use Webify\User\Context\Identity\Domain\Exception\UserNotFoundException;
use Webify\User\Context\Identity\Domain\ValueObject\UserEmail;
use Webify\User\Domain\ValueObject\UserId;

/**
 * UserRepositoryInterface defines the contract for a user repository.
 */
interface UserRepositoryInterface
{
	/**
	 * Retrieves an entity based on the provided unique UserId.
	 *
	 * @throws UserNotFoundException if the user is not found
	 */
	public function getById(UserId $id): User;

	/**
	 * Retrieves an entity based on the provided unique UserEmail.
	 *
	 * @throws UserNotFoundException if the user is not found
	 */
	public function getByEmail(UserEmail $email): User;

	/**
	 * Checks if a user with the given email already exists.
	 */
	public function isExists(UserEmail $email): bool;

	/**
	 * Persists the given user entity to the underlying storage.
	 *
	 * @param User $user the user entity to be persisted
	 */
	public function persist(User $user): void;
}
