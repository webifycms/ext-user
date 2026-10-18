<?php

/**
 * The file is part of the "webifycms/ext-user", WebifyCMS extension package.
 *
 * @see https://webifycms.com/extension/user
 *
 * @copyright Copyright (c) 2023 - Present WebifyCMS
 * @license https://webifycms.com/license
 * @author Mohammed Shifreen <mshifreen@gmail.com>
 */
declare(strict_types=1);

namespace Webify\User\Domain\Exception;

use InvalidArgumentException;
use Webify\Base\Contract\Exception\TranslatableExceptionInterface;
use Webify\Base\Contract\Translation\ExceptionTranslation;

/**
 * Exception thrown when an invalid user id value is encountered.
 *
 * This exception belongs to the shared kernel because `UserId` is shared by every context.
 */
final class InvalidUserIdException extends InvalidArgumentException implements TranslatableExceptionInterface
{
	/**
	 * Private constructor enforces the use of the factory methods to initiate this exception.
	 *
	 * @param ExceptionTranslation $translation the translation object for this exception
	 * @param string               $message     the exception message (optional)
	 */
	private function __construct(
		public readonly ExceptionTranslation $translation,
		string $message = ''
	) {
		parent::__construct($message);
	}

	/**
	 * Factory method to initiate an InvalidUserIdException with a default message.
	 *
	 * @param string $id the invalid user id value
	 */
	public static function forInvalidId(string $id): self
	{
		return new self(
			new ExceptionTranslation(
				'user.identity',
				'invalid_user_id',
				['id' => $id]
			),
			sprintf('Invalid user id: "%s"', $id)
		);
	}
}
