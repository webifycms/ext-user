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

namespace OneCMS\User\Domain\Service;

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
