<?php
/**
 * The file is part of the "webifycms/ext-user", WebifyCMS extension package.
 *
 * @see https://webifycms.com/extension/user
 *
 * @license Copyright (c) 2022 WebifyCMS
 * @license https://webifycms.com/extension/user/license
 * @author Mohammed Shifreen <mshifreen@gmail.com>
 */
declare(strict_types=1);

namespace Webify\User\Domain\Model\User;

/**
 * It's an entity object that represents trashed user.
 */
final class TrashedUser
{
	/**
	 * The object constructor.
	 */
	public function __construct(
		private readonly User $user
	) {
	}

	/**
	 * It returns the user's ID as string.
	 */
	public function getId(): string
	{
		return (string) $this->user->id;
	}

	/**
	 * Return the user's unique ID as a string.
	 */
	public function getUid(): string
	{
		return (string) $this->user->uid;
	}

	/**
	 * Get the name of the user.
	 */
	public function getName(): string
	{
		return (string) $this->user->person->name;
	}
}
