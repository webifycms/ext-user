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

namespace OneCMS\User\Domain\Model\Account\Exception;

use OneCMS\Base\Domain\Exception\TranslatableInvalidArgumentException;

/**
 * Invalid account email exception.
 */
final class InvalidAccountEmailException extends TranslatableInvalidArgumentException
{
	/**
	 * The object constructor.
	 *
	 * @param string[] $params
	 */
	public function __construct(
		string $messageKey = 'invalid_account_email',
		array $params = []
	) {
		parent::__construct($messageKey, $params);
	}
}
