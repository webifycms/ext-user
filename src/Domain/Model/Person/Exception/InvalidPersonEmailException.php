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

namespace Webify\User\Domain\Model\Person\Exception;

use Webify\Base\Domain\Exception\TranslatableInvalidArgumentException;

/**
 * Exception class can be use when validating email.
 */
final class InvalidPersonEmailException extends TranslatableInvalidArgumentException
{
	/**
	 * The class constructor.
	 *
	 * @param array<string, string> $params
	 */
	public function __construct(
		string $messageKey = 'invalid_person_email',
		array $params = []
	) {
		parent::__construct($messageKey, $params);
	}
}
