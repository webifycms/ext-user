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

namespace Webify\User\Domain\Model\Account\Exception;

use Webify\Base\Domain\Exception\TranslatableInvalidArgumentException;

/**
 * Exception class can be thrown when account id validation failed.
 */
final class InvalidAccountIdException extends TranslatableInvalidArgumentException
{
	/**
	 * {@inheritDoc}
	 */
	public function __construct(
		string $messageKey = 'invalid_account_id',
		array $params = []
	) {
		parent::__construct($messageKey, $params);
	}
}
