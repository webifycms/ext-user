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

use OneCMS\Base\Domain\Exception\TranslatableInvalidArgumentException;

/**
 * It's a custom exception that is thrown when a person's name exceeds the maximum number of characters.
 */
final class PersonNameMaxCharactersExceededException extends TranslatableInvalidArgumentException
{
	/**
	 * The class constructor.
	 *
	 * @param mixed[] $params
	 */
	public function __construct(
		string $messageKey = 'maximum_characters_exceeded',
		array $params = []
	) {
		parent::__construct($messageKey, $params);
	}
}
