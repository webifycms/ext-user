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

use OneCMS\Base\Domain\Exception\TranslatableRuntimeException;

/**
 * Exception class can be used when unable to unblock an account.
 */
final class UnableToUnblockAccountException extends TranslatableRuntimeException
{
	/**
	 * The object constructor.
	 */
	public function __construct(
		string $messageKey = 'unable_to_unblock',
		array $params = []
	) {
		parent::__construct($messageKey, $params);
	}
}
