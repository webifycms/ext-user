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

namespace Webify\User\Domain\Model\Person;

use Webify\User\Domain\Model\Person\ValueObject\PersonAddress;
use Webify\User\Domain\Model\Person\ValueObject\PersonEmail;
use Webify\User\Domain\Model\Person\ValueObject\PersonId;
use Webify\User\Domain\Model\Person\ValueObject\PersonName;

/**
 * It's an entity class that represents a person object, and it is an aggregate root.
 */
final class Person
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
