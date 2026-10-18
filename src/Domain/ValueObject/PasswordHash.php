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

namespace Webify\User\Domain\ValueObject;

use Webify\User\Domain\Exception\InvalidPasswordHashException;

use function password_get_info;

/**
 * Password hash value object.
 *
 * Produced by Identity and consumed by Authentication, so it lives in the shared kernel.
 *
 * The invariant is that the wrapped value is a hash produced by a PHP password hashing
 * algorithm, which is what makes it safe to hand straight to `password_verify()`. An empty
 * value, a plaintext password, a truncated row, or a value carrying stray surrounding
 * whitespace is rejected rather than silently accepted, because each of those means the
 * stored data is wrong and swallowing it would hide that.
 *
 * Validity is decided by `password_get_info()`, so it recognises exactly the algorithms PHP
 * supports. If a non-PHP hasher is ever adopted — a legacy `scrypt`/`pbkdf2` column, or a
 * remote hashing service — this check has to be widened alongside it.
 */
final readonly class PasswordHash
{
	/**
	 * Private constructor enforces the use of the factory method.
	 *
	 * @param string $value the password hash value
	 *
	 * @throws InvalidPasswordHashException
	 */
	private function __construct(private string $value)
	{
		if (!$this->isValid()) {
			throw InvalidPasswordHashException::forInvalidPasswordHash($this->value);
		}
	}

	/**
	 * Converts the object to its string representation.
	 */
	public function __toString(): string
	{
		return $this->value;
	}

	/**
	 * Get the native string value of the password hash.
	 */
	public function toNative(): string
	{
		return $this->value;
	}

	/**
	 * Factory method to create a password hash object from a hash.
	 */
	public static function fromHash(string $value): self
	{
		return new self($value);
	}

	/**
	 * Checks if the password hash is equal to another password hash.
	 */
	public function equals(self $other): bool
	{
		return $this->toNative() === $other->toNative();
	}

	/**
	 * Validates the password hash value.
	 *
	 * A recognised algorithm is the signal that the value is a real hash: `algo` is null for
	 * anything PHP does not recognise, including plaintext and malformed input.
	 */
	private function isValid(): bool
	{
		if ('' === $this->value) {
			return false;
		}

		return null !== password_get_info($this->value)['algo'];
	}
}
