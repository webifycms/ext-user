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
		private ?DateTimeValueObject $trashedAt = null
	) {
	}

	/**
	 * Move the Person object into trash.
	 */
	public function moveToTrash(): TrashedPerson
	{
		$this->trashedAt = new DateTimeValueObject();

		return new TrashedPerson($this);
	}

	/**
	 * {@inheritDoc}
	 */
	public function isInTrash(): bool
	{
		return $this->trashedAt instanceof DateTimeValueObject;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getTrashedAt(?string $format = null): ?string
	{
		if ($this->isInTrash()) {
			return null !== $format ? $this->trashedAt->getDateTime()->format($format) : (string) $this->trashedAt;
		}

		return null;
	}
}
