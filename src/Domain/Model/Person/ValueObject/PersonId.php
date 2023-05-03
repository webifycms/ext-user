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

use OneCMS\Base\Domain\ValueObject\IncrementalIdValueObject;
use OneCMS\User\Domain\Model\Account\Exception\InvalidAccountIdException;

/**
 * This class represents a person's unique ID.
 */
final class PersonId extends IncrementalIdValueObject
{
	/**
	 * {@inheritDoc}
	 */
	protected function throwException(array $params): void
	{
		throw new InvalidAccountIdException('invalid_person_id', $params);
	}
}
