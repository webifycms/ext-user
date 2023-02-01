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

namespace OneCMS\User\Domain\Model\Account\ValueObject;

use OneCMS\Base\Domain\ValueObject\EmailValueObject;
use OneCMS\User\Domain\Model\Account\Exception\InvalidAccountEmailException;

/**
 * A value object that represents account email that is extended from EmailValueObject.
 */
final class AccountEmail extends EmailValueObject
{
	/**
	 * {@inheritDoc}
	 */
	protected function throwException(array $params): void
	{
		throw new InvalidAccountEmailException('invalid_account_email', $params);
	}
}
