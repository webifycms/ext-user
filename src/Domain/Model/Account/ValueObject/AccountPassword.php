<?php

/**
 * The file is part of the "webifycms/ext-user", WebifyCMS extension package.
 *
 * @see https://webifycms.com/extension/user
 *
 * @license Copyright (c) 2022 WebifyCMS
 * @license https://webifycms.com/extension/user/license
 * @author Mohammed Shifreen <mshifreen@gmail.com>
 */
declare(strict_types=1);

namespace Webify\User\Domain\Model\Account\ValueObject;

use Webify\User\Domain\Model\Account\Exception\InvalidPasswordException;

/**
 * A value object that represents account password.
 */
final class AccountPassword
{
	/**
	 * Minimum characters' length.
	 */
	private const MIN_LENGTH = 12;

	/**
	 * The object constructor.
	 */
	private function __construct(
		private readonly string $password
	) {
		if (!$this->isValid($this->password)) {
			throw new InvalidPasswordException();
		}
	}

	/**
	 * The __toString() function is a magic method that is called when the object is used in a string
	 * context.
	 *
	 * @return string the account password
	 */
	public function __toString()
	{
		return $this->password;
	}

	/**
	 * Creates account password value object from the given password string.
	 */
	public static function createFrom(string $password): static
	{
		return new self($password);
	}

	/**
	 * Validates the given password.
	 *
	 * Validation rules:
	 * 1. Should contain at least a uppercase letter (A-Z)
	 * 2. Should contain at least a lowercase letter (a-z)
	 * 2. Should contain at least a digit (0-9)
	 * 3. Should contain at least a special character
	 * 4. Should contain at least 12 or more characters long
	 */
	private function isValid(string $password): bool
	{
		if (!preg_match(
			'/(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{' . self::MIN_LENGTH . ',})/',
			$password
		)
		) {
			return false;
		}

		return true;
	}
}
