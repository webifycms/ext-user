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

namespace Webify\User\Domain\Model\Account;

use Webify\User\Domain\Model\Account\Factory\BlockedAccountFactory;
use Webify\User\Domain\Model\Account\ValueObject\AccountActivationHashValueObject;
use Webify\User\Domain\Model\Account\ValueObject\AccountEmail;
use Webify\User\Domain\Model\Account\ValueObject\AccountId;
use Webify\User\Domain\Model\Account\ValueObject\AccountPassword;
use Webify\User\Domain\Model\Account\ValueObject\AccountPasswordHash;
use Webify\User\Domain\Model\Account\ValueObject\AccountRegisteredIpValueObject;
use Webify\User\Domain\Model\Account\ValueObject\AccountStatusValueObject;
use Webify\User\Domain\Model\Account\ValueObject\AccountUsername;

/**
 * Entity class that have the state of activated and represents as activated account.
 */
final class ActivatedAccount extends Account
{
	/**
	 * The account activated status.
	 */
	private AccountStatusValueObject $status = AccountStatusValueObject::ACTIVATED;

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
		private readonly \DateTimeInterface $activatedAt
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
	 * {@inheritDoc}
	 */
	public function getStatus(): string
	{
		return $this->status->value;
	}

	/**
	 * Block the account.
	 * Only activated account can be blocked.
	 */
	public function block(): BlockedAccount
	{
		return (new BlockedAccountFactory())->createFromActivatedAccount($this);
	}
}
