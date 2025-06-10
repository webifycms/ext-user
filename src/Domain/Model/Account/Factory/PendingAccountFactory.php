<?php

/**
 * The file is part of the "webifycms/ext-user", WebifyCMS extension package.
 *
 * @see https://webifycms.com/extension/user
 *
 * @copyright Copyright (c) 2023 WebifyCMS
 * @license https://webifycms.com/extension/user/license
 * @author Mohammed Shifreen <mshifreen@gmail.com>
 */
declare(strict_types=1);

namespace Webify\User\Domain\Model\Account\Factory;

use Webify\User\Domain\Model\Account\PendingAccount;

/**
 * Factory class is to create pending account object.
 */
final class PendingAccountFactory
{
	/**
	 * Create a new pending account object.
	 *
	 * @param array<string, mixed> $args The array of arguments to pass to the constructor, should be
	 *                                   in order of the constructor arguments
	 */
	public function createFromArray(array $args): PendingAccount
	{
		return new PendingAccount(...$args);
	}
}
