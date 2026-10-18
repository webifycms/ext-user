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

namespace Webify\User\Context\Identity\Application\Query\User;

use Webify\User\Context\Identity\Domain\ValueObject\UserEmail;

/**
 * Query class defines the contract for a query to find a user by its identifier.
 */
interface FindUserByEmailInterface
{
	/**
	 * Finds a User by its email.
	 *
	 * @param UserEmail $email the email of the user to find
	 *
	 * @return null|User the User read-model if found, or null if no user matches the given email
	 */
	public function find(UserEmail $email): ?User;
}
