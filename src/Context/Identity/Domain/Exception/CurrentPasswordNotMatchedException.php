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

namespace Webify\User\Context\Identity\Domain\Exception;

use DomainException;
use Webify\Base\Contract\Exception\TranslatableExceptionInterface;
use Webify\Base\Contract\Translation\ExceptionTranslation;

/**
 * Thrown when the user's current password is not matched.
 */
final class CurrentPasswordNotMatchedException extends DomainException implements TranslatableExceptionInterface
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
	 * Factory method to create a CurrentPasswordNotMatchedException for a specific user email.
	 */
	public static function create(): CurrentPasswordNotMatchedException
	{
		return new self(
			new ExceptionTranslation(
				'user.identity',
				'current_password_not_matched'
			),
			'Current password does not matched.'
		);
	}
}
