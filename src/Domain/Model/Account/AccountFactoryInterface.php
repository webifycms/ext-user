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

namespace Webify\User\Domain\Model\Account;

/**
 * Undocumented interface.
 */
interface AccountFactoryInterface
{
	/**
	 * Build a new account entity. In order to build account entity, following properties are required.
	 *
	 * Required properties:
	 * accountId
	 * person
	 * email
	 * username
	 * passwordHash
	 * validationToken
	 * activation
	 *
	 * @param array<string, mixed> $args
	 */
	public function build(array $args): Account;
}
