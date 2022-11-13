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
 * This class is thrown when a person is not in the trash.
 */
final class UnableToCreateTrashedPersonException extends TranslatableRuntimeException
{
	/**
	 * The class constructor.
	 *
	 * @param string[] $params
	 */
	public function __construct(
		string $messageKey = 'person_not_in_trash',
		array $params = []
	) {
		parent::__construct($messageKey, $params);
	}
}
