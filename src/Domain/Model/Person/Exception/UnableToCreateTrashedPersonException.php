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

use Webify\Base\Domain\Exception\TranslatableRuntimeException;

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
