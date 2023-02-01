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

namespace OneCMS\User\Domain\Model\Person\Exception;

use OneCMS\Base\Domain\Exception\TranslatableRuntimeException;

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
