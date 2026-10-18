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

namespace Webify\User\Context\Identity\Application\Service;

use Webify\Base\Domain\Contract\Identity\Service\PasswordHasherInterface;
use Webify\Base\Domain\Event\DomainEventPublisherInterface;
use Webify\Base\Domain\Service\UlidGeneratorInterface;
use Webify\User\Context\Identity\Domain\Entity\User;
use Webify\User\Context\Identity\Domain\Guard\{EmailMustBeUnique, PasswordMustBeStrong};
use Webify\User\Context\Identity\Domain\Repository\UserRepositoryInterface;
use Webify\User\Context\Identity\Domain\ValueObject\{DisplayName, UserEmail};
use Webify\User\Domain\ValueObject\{PasswordHash, UserId};

/**
 * RegisterUser service handles the user registering process.
 *
 * Encapsulate the use case of registering a new user. Orchestrates email uniqueness validation,
 * password hashing, user entity creation, persistence, and event publishing.
 */
final readonly class RegisterUser
{
	/**
	 * The constructor.
	 */
	public function __construct(
		private PasswordHasherInterface $passwordHasher,
		private UserRepositoryInterface $repository,
		private EmailMustBeUnique $emailMustBeUnique,
		private PasswordMustBeStrong $passwordMustBeStrong,
		private UlidGeneratorInterface $ulidGenerator,
		private DomainEventPublisherInterface $eventPublisher
	) {}

	/**
	 * Registers a new user with the provided email and password.
	 *
	 * @param string $email       the email of the user to register
	 * @param string $password    the password of the user to register
	 * @param string $displayName the display name of the user to register
	 */
	public function register(string $email, string $password, string $displayName): void
	{
		$userEmail = UserEmail::fromString($email);

		$this->emailMustBeUnique->guard($userEmail);
		$this->passwordMustBeStrong->guard($password);

		$hashedPassword = $this->passwordHasher->hash($password);
		$user           = User::register(
			UserId::fromString($this->ulidGenerator->generate()),
			$userEmail,
			PasswordHash::fromHash($hashedPassword),
			DisplayName::fromString($displayName)
		);

		$this->repository->persist($user);
		$this->eventPublisher->publish(...$user->getDomainEvents());
	}
}
