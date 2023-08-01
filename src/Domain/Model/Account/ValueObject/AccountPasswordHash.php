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
use Webify\User\Domain\Service\HashServiceInterface;

/**
 * A value object represent account password hash.
 */
final class AccountPasswordHash
{
	/**
	 * The object constructor.
	 * Note: This is a private constructor and should use factory method 'createFrom' in order to initialize this object.
	 */
	private function __construct(
		private readonly string $hash,
		private readonly string $password,
		private readonly HashServiceInterface $hashService
	) {
		if (!$this->isValid()) {
			throw new InvalidPasswordException();
		}
	}

	/**
	 * The __toString() function is a magic method that is called when the object is used in a string
	 * context.
	 *
	 * @return string the account password hash
	 */
	public function __toString()
	{
		return $this->hash;
	}

	/**
	 * Creates account password hash value object from the given password string.
	 */
	public static function createFrom(
		string $password,
		HashServiceInterface $hashService
	): static {
		return new self($hashService->generateHash($password), $password, $hashService);
	}

	/**
	 * Validates the hash and password.
	 */
	private function isValid(): bool
	{
		return $this->hashService->validatesHash($this->password, $this->hash);
	}
}
