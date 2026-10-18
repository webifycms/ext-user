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

use RuntimeException;
use Throwable;
use Webify\Base\Contract\Exception\TranslatableExceptionInterface;
use Webify\Base\Contract\Translation\ExceptionTranslation;

/**
 * Exception thrown when a refresh token generation fails.
 */
final class RefreshTokenGenerationFailedException extends RuntimeException implements TranslatableExceptionInterface
{
	/**
	 * Private constructor enforces the use of the factory methods to initiate this exception.
	 *
	 * @param ExceptionTranslation $translation the translation object for this exception
	 * @param string               $message     the exception message (optional)
	 * @param Throwable            $previous    the previous throwable used for the exception chaining (optional)
	 */
	private function __construct(
		public readonly Throwable $previous,
		public readonly ExceptionTranslation $translation,
		string $message = '',
	) {
		parent::__construct($message, 0, $previous);
	}

	/**
	 * Factory method to initiate this with a default message.
	 */
	public static function create(Throwable $throwable): RefreshTokenGenerationFailedException
	{
		return new self(
			$throwable,
			new ExceptionTranslation(
				'user.authentication',
				'refresh_token_generation_failed',
			),
			'Unable to generate refresh token.',
		);
	}
}
