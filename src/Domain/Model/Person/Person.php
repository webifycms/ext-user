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

use OneCMS\User\Domain\Model\Person\ValueObject\PersonAddress;
use OneCMS\User\Domain\Model\Person\ValueObject\PersonEmail;
use OneCMS\User\Domain\Model\Person\ValueObject\PersonId;
use OneCMS\User\Domain\Model\Person\ValueObject\PersonName;

/**
 * It's an entity class that represents a person object and it is an aggregate root.
 */
abstract class Person
{
	/**
	 * The object constructor.
	 */
	public function __construct(
		public readonly PersonId $id,
		public readonly PersonName $name,
		public readonly PersonEmail $email,
		public readonly PersonAddress $address
	) {
	}
}
