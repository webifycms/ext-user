<?php

/**
 * The file is part of the "webifycms/ext-user", WebifyCMS extension package.
 *
 * @see https://webifycms.com/extension/user
 *
 * @copyright Copyright (c) 2023 WebifyCMS
 * @license https://webifycms.com/extension/user/license
 * @author Mohammed Shifreen <mshifreen@gmail.com>
 */
declare(strict_types=1);

namespace Webify\User\Domain\Model\Person\Exception;

use Webify\Base\Domain\Exception\TranslatableRuntimeException;

/**
 * Exception class can be used when unable to un trash an account.
 */
final class UnableToUnTrashPersonException extends TranslatableRuntimeException
{
	/**
	 * The class constructor.
	 *
	 * @param mixed[] $params
	 */
	public function __construct(
		string $messageKey = 'unable_to_un_trash',
		array $params = []
	) {
		parent::__construct($messageKey, $params);
	}
}
