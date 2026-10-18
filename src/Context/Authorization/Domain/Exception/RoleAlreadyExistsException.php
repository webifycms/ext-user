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

namespace Webify\User\Context\Authorization\Domain\Exception;

use DomainException;
use Webify\Base\Contract\Exception\TranslatableExceptionInterface;
use Webify\Base\Contract\Translation\ExceptionTranslation;

/**
 * Exception thrown when a role already exists.
 */
final class RoleAlreadyExistsException extends DomainException implements TranslatableExceptionInterface
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
	 * Factory method to initiate this with a default message.
	 *
	 * @param string $slug the role slug
	 */
	public static function forSlug(string $slug): self
	{
		return new self(
			new ExceptionTranslation(
				'user.authorization',
				'role_already_exists',
				[
					'slug'    => $slug,
				]
			),
			sprintf('Role is already exists for the given role slug "%s".', $slug)
		);
	}
}
