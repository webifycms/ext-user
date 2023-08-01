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
 * Invalid username exception class.
 */
final class InvalidUsernameException extends TranslatableInvalidArgumentException
{
	/**
	 * The object constructor.
	 *
	 * @param string[] $params
	 */
	public function __construct(
		string $messageKey = 'invalid_username',
		array $params = []
	) {
		parent::__construct($messageKey, $params);
	}
}
