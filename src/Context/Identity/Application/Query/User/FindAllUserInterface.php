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

/**
 * Query class defines the contract for a query to find all users.
 */
interface FindAllUserInterface
{
	/**
	 * Retrieves a collection of all users.
	 *
	 * @return UserCollection a collection containing all user-read models
	 */
	public function findAll(): UserCollection;
}
