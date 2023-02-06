<?php
/**
 * The file is part of the "getonecms/ext-user", OneCMS extension package.
 *
 * @see https://getonecms.com/extension/user
 *
 * @license Copyright (c) 2022 OneCMS
 * @license https://getonecms.com/extension/user/license
 * @author Mohammed Shifreen <mshifreen@gmail.com>
 */
declare(strict_types=1);

namespace OneCMS\User\Domain\Model\Account;

use OneCMS\User\Domain\Model\Account\Factory\ActivatedAccountFactory;
use OneCMS\User\Domain\Model\Account\ValueObject\AccountActivationHashValueObject;
use OneCMS\User\Domain\Model\Account\ValueObject\AccountEmail;
use OneCMS\User\Domain\Model\Account\ValueObject\AccountId;
use OneCMS\User\Domain\Model\Account\ValueObject\AccountPassword;
use OneCMS\User\Domain\Model\Account\ValueObject\AccountPasswordHash;
use OneCMS\User\Domain\Model\Account\ValueObject\AccountRegisteredIpValueObject;
use OneCMS\User\Domain\Model\Account\ValueObject\AccountStatusValueObject;
use OneCMS\User\Domain\Model\Account\ValueObject\AccountUsername;

/**
 * Entity class that have the state of blocked and represents as blocked account.
 */
final class BlockedAccount extends Account
{
	/**
	 * The blocked account status.
	 */
	private AccountStatusValueObject $status = AccountStatusValueObject::BLOCKED;

	/**
	 * The object constructor.
	 */
	public function __construct(
		public readonly AccountId $id,
		public readonly AccountUsername $username,
		public readonly AccountEmail $email,
		public readonly AccountActivationHashValueObject $activationHash,
		public readonly ?AccountRegisteredIpValueObject $registeredIp,
		public readonly ?AccountPassword $password,
		public readonly ?AccountPasswordHash $passwordHash,
		private readonly \DateTimeInterface $activatedAt,
		private readonly \DateTimeInterface $blockedAt
	) {
	}

	/**
	 * Returns the activated datetime as string for the given format.
	 */
	public function getActivatedAt(string $format): string
	{
		return $this->activatedAt->format($format);
	}

	/**
	 * Returns the blocked at datetime in the given format.
	 */
	public function getBlockedAt(string $format): string
	{
		return $this->blockedAt->format($format);
	}

	/**
	 * {@inheritDoc}
	 */
	public function getStatus(): string
	{
		return $this->status->value;
	}

	/**
	 * Unblock the account.
	 * Only blocked account can be unblock.
	 */
	public function unblock(): ActivatedAccount
	{
		return (new ActivatedAccountFactory())->createFromBlockedAccount($this);
	}
}
