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
 * Exception class can be thrown when account activation hash validation failed.
 */
final class InvalidAccountActivationHashException extends TranslatableInvalidArgumentException
{
	/**
	 * The object constructor.
	 *
	 * @param string[] $params
	 */
	public function __construct(
		string $messageKey = 'invalid_activation_hash',
		array $params = []
	) {
		parent::__construct($messageKey, $params);
	}
}
