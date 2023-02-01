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

use OneCMS\Base\Domain\Model\RecyclableModelInterface;
use OneCMS\Base\Domain\ValueObject\DateTimeValueObject;
use OneCMS\User\Domain\Model\Person\Exception\UnableToUnTrashPersonException;
use OneCMS\User\Domain\Model\Person\ValueObject\PersonAddress;
use OneCMS\User\Domain\Model\Person\ValueObject\PersonEmail;
use OneCMS\User\Domain\Model\Person\ValueObject\PersonId;
use OneCMS\User\Domain\Model\Person\ValueObject\PersonName;

/**
 * It's an entity class that represents a person object.
 */
final class Person implements RecyclableModelInterface
{
	/**
	 * The object constructor.
	 */
	public function __construct(
		public readonly PersonId $id,
		public readonly PersonName $name,
		public readonly PersonEmail $email,
		public readonly PersonAddress $address,
		private ?\DateTimeInterface $trashedAt = null
	) {
	}

	/**
	 * Move the Person object into trash.
	 */
	public function moveToTrash(): TrashedPerson
	{
		$this->trashedAt = DateTimeValueObject::create()->getDateTimeObject();

		return new TrashedPerson($this);
	}

	/**
	 * Un trash the person.
	 */
	public function unTrash(): void
	{
		if ($this->isInTrash()) {
			$this->trashedAt = null;
		}

		throw new UnableToUnTrashPersonException('person_not_in_trash');
	}

	/**
	 * {@inheritDoc}
	 */
	public function isInTrash(): bool
	{
		return $this->trashedAt instanceof \DateTimeInterface;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getTrashedAt(string $format): ?string
	{
		if ($this->isInTrash()) {
			return $this->trashedAt->format($format);
		}

		return null;
	}
}
