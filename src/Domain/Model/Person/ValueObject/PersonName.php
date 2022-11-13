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

namespace OneCMS\User\Domain\Model\Person\ValueObject;

use OneCMS\User\Domain\Model\Person\Exception\PersonNameMaxCharactersExceededException;

/**
 * It's a value object that represents a person's first and last name.
 */
final class PersonName
{
	/**
	 * It's a constant that represents the maximum number of characters allowed for a person's
	 * first and last name.
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
		if (mb_strlen($this->firstName) > self::MAXIMUM_CHARACTERS || mb_strlen($this->lastName) > self::MAXIMUM_CHARACTERS) {
			throw new PersonNameMaxCharactersExceededException('maximum_characters_exceeded', ['limit' => self::MAXIMUM_CHARACTERS]);
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
}
