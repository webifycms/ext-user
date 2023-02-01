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

use OneCMS\Base\Domain\Exception\TranslatableRuntimeException;
use OneCMS\User\Domain\Model\Account\ValueObject\AccountStatusValueObject;

/**
 * Entity class that have the state of blocked and represents as blocked account.
 *
 * @todo To avoid code duplication I have introduced a setter here instead of using the constructor and it has to be investigate.
 */
final class BlockedAccount extends Account
{
	/**
	 * The blocked account status.
	 */
	private AccountStatusValueObject $status = AccountStatusValueObject::BLOCKED;

	/**
	 * The datetime of the account got blocked and initially null.
	 */
	private ?\DateTimeInterface $blockedAt = null;

	/**
	 * Set blocked datetime, this is important and should be set right after the object was constructed.
	 */
	public function setBlockedAt(\DateTimeInterface $datetime): self
	{
		$this->blockedAt = $datetime;

		return $this;
	}

	/**
	 * Returns the blocked at datetime in the given format.
	 */
	public function getBlockedAt(string $format): string
	{
		if ($this->blockedAt instanceof \DateTimeInterface) {
			return $this->blockedAt->format($format);
		}

		throw new TranslatableRuntimeException('blocked_datetime_not_set');
	}

	/**
	 * {@inheritDoc}
	 */
	public function getStatus(): string
	{
		return $this->status->value;
	}
}
