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

namespace Webify\User\Context\Authentication\Domain\Event;

use DateTimeImmutable;
use Webify\Base\Domain\Event\DomainEventInterface;

/**
 * The event that is triggered when a session was revoked.
 */
final readonly class SessionWasRevoked implements DomainEventInterface
{
	/**
	 * The constructor.
	 */
	public function __construct(
		public string $sessionId,
		public string $userId,
		public DateTimeImmutable $expiresAt,
		public DateTimeImmutable $createdAt
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
		return 'user.authentication.session_was_revoked';
	}
}
