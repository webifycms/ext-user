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

namespace Webify\User\Context\Identity\Domain\Guard;

use Webify\User\Context\Identity\Domain\Exception\EmailMustBeUniqueException;
use Webify\User\Context\Identity\Domain\Repository\UserRepositoryInterface;
use Webify\User\Context\Identity\Domain\ValueObject\UserEmail;

/**
 * Guard prevents against the user registration with existed registered email.
 */
final readonly class EmailMustBeUnique
{
	/**
	 * The constructor.
	 */
	public function __construct(
		private UserRepositoryInterface $repository
	) {}

	/**
	 * Guards against the registration of a user with an email that already exists.
	 *
	 * @throws EmailMustBeUniqueException
	 */
	public function guard(UserEmail $email): void
	{
		if ($this->repository->isExists($email)) {
			throw EmailMustBeUniqueException::create((string) $email);
		}
	}
}
