<?php
/**
 * The file is part of the "getonecms/ext-user", OneCMS extension package.
 *
 * @see https://getonecms.com/extension/user
 *
 * @license Copyright (c) 2022 OneCMS
 * @license https://getonecms.com/extension/user/license
 * @author Mohammed Shifreen <mshifreen@gmail.com>
 */
declare(strict_types=1);

namespace OneCMS\User\Domain\Model\Account\Factory;

use OneCMS\User\Domain\Model\Account\PendingAccount;

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
