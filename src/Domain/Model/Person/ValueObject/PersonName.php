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

namespace Webify\User\Domain\Model\Person\ValueObject;

use Webify\User\Domain\Model\Person\Exception\InvalidPersonNameException;

/**
 * It's a value object that represents a person's first and last name.
 */
final class PersonName
{
	/**
	 * It's a constant that represents the maximum number of characters allowed for a person's
	 * first and last names.
	 */
	private const MAXIMUM_CHARACTERS = 255;

	/**
	 * The constructor takes two strings `firstName` and `lastName`, and throws an exception if
	 * either of them are longer than the maximum number of characters.
	 */
	public function __construct(
		public readonly string $firstName,
		public readonly string $lastName
	) {
		if (!$this->isValid([$this->firstName, $this->lastName])) {
			throw new InvalidPersonNameException(
				'maximum_characters_exceeded',
				['limit' => self::MAXIMUM_CHARACTERS]
			);
		}
	}

	/**
	 * The __toString() method is called when the object is used in a string context.
	 *
	 * @return string the first name and last name of the person
	 */
	public function __toString(): string
	{
		return $this->firstName . ' ' . $this->lastName;
	}

	/**
	 * Validates the given first and last names.
	 *
	 * @param array<string> $names
	 */
	private function isValid(array $names): bool
	{
		foreach ($names as $name) {
			if (mb_strlen($name) > self::MAXIMUM_CHARACTERS) {
				return false;
			}
		}

		return true;
	}
}
