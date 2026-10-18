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

namespace Webify\User\Context\Identity\Domain\Event;

use DateTimeImmutable;
use Webify\Base\Domain\Event\DomainEventInterface;

/**
 * The event that is triggered when a user was activated.
 */
final readonly class UserPasswordWasChanged implements DomainEventInterface
{
	/**
	 * The constructor.
	 */
	public function __construct(
		public string $userId,
		private DateTimeImmutable $createdAt
	) {}

	/**
	 * {@inheritDoc}
	 */
	public function occurredOn(): DateTimeImmutable
	{
		return $this->createdAt;
	}

	/**
	 * {@inheritDoc}
	 */
	public function eventName(): string
	{
		return 'user.identity.password_was_changed';
	}
}
