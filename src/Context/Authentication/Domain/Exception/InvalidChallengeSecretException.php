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

namespace Webify\User\Context\Authentication\Domain\Exception;

use DomainException;
use Webify\Base\Contract\Exception\TranslatableExceptionInterface;
use Webify\Base\Contract\Translation\ExceptionTranslation;

/**
 * Thrown when encountered an invalid authentication challenge secret during verification.
 */
final class InvalidChallengeSecretException extends DomainException implements TranslatableExceptionInterface
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
	 * Factory method to create an exception for an invalid verification code or token supplied by the user.
	 */
	public static function create(): InvalidChallengeSecretException
	{
		return new self(
			new ExceptionTranslation(
				'user.authentication',
				'challenge_invalid_secret',
			),
			'Provided authentication challenge secret is invalid.'
		);
	}
}
