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

namespace Webify\User\Domain\Service;

/**
 * A service class that helps to hash and validates the hash for the provided string.
 */
interface HashServiceInterface
{
	/**
	 * Generate hash for the given string.
	 */
	public function generateHash(string $string): string;

	/**
	 * Validates the given string and hash.
	 */
	public function validatesHash(string $string, string $hash): bool;
}
