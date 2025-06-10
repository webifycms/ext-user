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

namespace Webify\User\Domain\Model\Account\ValueObject;

use Webify\User\Domain\Model\Account\Exception\InvalidUsernameException;

/**
 * A value object that represents account username.
 */
final class AccountUsername
{
	/**
	 * Allowed characters length.
	 *
	 * @todo If any standards for character limits should be used.
	 */
	private const MIN_LENGTH = 6;

	/**
	 * The object constructor.
	 *
	 * @throws InvalidUsernameException
	 */
	private function __construct(private readonly string $username)
	{
		if (!$this->isValid($this->username)) {
			throw new InvalidUsernameException('invalid_username', ['username' => $this->username]);
		}
	}

	/**
	 * The __toString() function is a magic method that is called when the object is used in a string
	 * context.
	 *
	 * @return string The username
	 */
	public function __toString()
	{
		return $this->username;
	}

	/**
	 * Creates an username value object from the given string.
	 */
	public static function createFrom(string $username): static
	{
		return new self($username);
	}

	/**
	 * Validates the given unique ID.
	 *
	 * Validation rules:
	 * 1. Can contain only letters (a-z), numbers (0,9) and character (_)
	 * 2. Cannot begin or end with (_) character
	 * 3. Should have at least 6 or more characters long
	 *
	 * @todo If regex can be improved further for performance would be considered.
	 */
	private function isValid(string $username): bool
	{
		if (!preg_match(
			'/^(?!.*[_]{2})(?=.*[a-z0-9]$)[a-z0-9][a-z0-9_]{' . self::MIN_LENGTH . ',}$/i',
			$username
		)
		) {
			return false;
		}

		return true;
	}
}
