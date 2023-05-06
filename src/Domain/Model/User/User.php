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

use Webify\Base\Domain\Exception\TranslatableRuntimeException;
use Webify\Base\Domain\Model\RecyclableModelInterface;
use Webify\Base\Domain\ValueObject\DateTimeValueObject;
use Webify\User\Domain\Model\Account\Account;
use Webify\User\Domain\Model\Account\ActivatedAccount;
use Webify\User\Domain\Model\Account\BlockedAccount;
use Webify\User\Domain\Model\Account\PendingAccount;
use Webify\User\Domain\Model\Account\ValueObject\UserIdValueObject;
use Webify\User\Domain\Model\Person\Person;
use Webify\User\Domain\Model\User\ValueObject\UserUniqueIdValueObject;

/**
 * User aggregate root.
 */
final class User implements RecyclableModelInterface
{
	/**
	 * The object constructor.
	 */
	public function __construct(
		public readonly UserIdValueObject $id,
		public readonly UserUniqueIdValueObject $uid,
		public Person $person,
		public ?Account $account = null,
		private ?\DateTimeInterface $trashedAt = null
	) {
	}

	/**
	 * Activate user account.
	 * If the user account is still in pending only can be activated.
	 */
	public function activateAccount(): void
	{
		if ($this->account instanceof PendingAccount) {
			$this->account = $this->account->activate();
		}

		throw new TranslatableRuntimeException('unable_to_activate', ['status' => $this->account->getStatus()]);
	}

	/**
	 * Block the account.
	 * Only activated user account can be blocked.
	 */
	public function blockAccount(): void
	{
		if ($this->account instanceof ActivatedAccount) {
			$this->account = $this->account->block();
		}

		throw new TranslatableRuntimeException('unable_to_block', ['status' => $this->account->getStatus()]);
	}

	/**
	 * Unblock the account.
	 * Only blocked user account can be unblocked.
	 */
	public function unblockAccount(): void
	{
		if ($this->account instanceof BlockedAccount) {
			$this->account = $this->account->unblock();
		}

		throw new TranslatableRuntimeException('unable_to_unblock', ['status' => $this->account->getStatus()]);
	}

	/**
	 * Move the user to the trash.
	 */
	public function moveToTrash(): TrashedUser
	{
		$this->trashedAt = DateTimeValueObject::create()->getDateTimeObject();

		return new TrashedUser($this);
	}

	/**
	 * Restore the user from trash.
	 */
	public function restoreFromTrash(): void
	{
		if ($this->isInTrash()) {
			$this->trashedAt = null;
		}

		throw new TranslatableRuntimeException('user_not_in_trash', []);
	}

	/**
	 * {@inheritDoc}
	 */
	public function isInTrash(): bool
	{
		return $this->trashedAt instanceof \DateTimeInterface;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getTrashedAt(string $format): ?string
	{
		if ($this->isInTrash()) {
			return $this->trashedAt->format($format);
		}

		return null;
	}
}
