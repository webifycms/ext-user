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
 * Exception class can be thrown when account IP validation failed.
 */
final class InvalidAccountIpException extends TranslatableInvalidArgumentException
{
	/**
	 * Default message key.
	 */
	public const MESSAGE_KEY = 'invalid_ip_address';

	public function __construct(
		string $messageKey = self::MESSAGE_KEY,
		array $params = [],
		$code = null,
		?\Throwable $previous = null
	) {
		parent::__construct($messageKey, $params, $code, $previous);
	}
}
