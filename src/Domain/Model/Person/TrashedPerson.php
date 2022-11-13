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

namespace OneCMS\User\Domain\Model\Person;

use OneCMS\User\Domain\Model\Person\Exception\UnableToCreateTrashedPersonException;

/**
 * Read-only Person entity which is representing as trashed person object.
 */
final class TrashedPerson
{
	/**
	 * The object constructor.
	 */
	public function __construct(
		private readonly Person $person
	) {
		if (!$this->person->isInTrash()) {
			throw new UnableToCreateTrashedPersonException();
		}
	}

	/**
	 * Returns the id.
	 */
	public function getId(): string
	{
		return (string) $this->person->id;
	}

	/**
	 * Returns the first name.
	 */
	public function getFirstName(): string
	{
		return $this->person->name->firstName;
	}

	/**
	 * Returns the last name.
	 */
	public function getLastName(): string
	{
		return $this->person->name->lastName;
	}

	/**
	 * Returns the trashed at datetime formatted string.
	 */
	public function getTrashedAt(?string $format = null): string
	{
		return $this->person->getTrashedAt($format);
	}
}
