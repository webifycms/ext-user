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
use OneCMS\User\Domain\Model\Account\ValueObject\AccountActivationHashValueObject;
use OneCMS\User\Domain\Model\Account\ValueObject\AccountStatusValueObject;

/**
 * Entity class that have the state of activated and represents as activated account.
 *
 * @todo To avoid code duplication and setters for additional properties introduced init method and should be investigate for good practice.
 */
final class ActivatedAccount extends Account
{
	/**
	 * The account activated status.
	 */
	private AccountStatusValueObject $status = AccountStatusValueObject::ACTIVATED;

	/**
	 * The datetime of the account activation and initially null.
	 */
	private ?\DateTimeInterface $activatedAt = null;

	/**
	 * The activation hash.
	 */
	private ?AccountActivationHashValueObject $activationHash = null;

	/**
	 * Initialize with the additional properties this object required.
	 */
	public function init(
		\DateTimeInterface $activatedAt,
		AccountActivationHashValueObject $activationHash
	): void {
		$this->activatedAt    = $activatedAt;
		$this->activationHash = $activationHash;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getStatus(): string
	{
		return $this->status->value;
	}

	/**
	 * Returns the activation hash as object.
	 *
	 * @throws TranslatableRuntimeException if activation hash not sets the exception will be thrown
	 */
	public function getActivationHash(): AccountActivationHashValueObject
	{
		if ($this->activationHash instanceof AccountActivationHashValueObject) {
			return $this->activationHash;
		}

		throw new TranslatableRuntimeException('activation_hash_not_set');
	}

	/**
	 * Returns the activated datetime as string for the given format.
	 *
	 * @throws TranslatableRuntimeException if activated datetime not sets the exception will be thrown
	 */
	public function getActivatedAt(string $format): string
	{
		if ($this->activatedAt instanceof \DateTimeInterface) {
			return $this->activatedAt->format($format);
		}

		throw new TranslatableRuntimeException('activated_datetime_not_set');
	}
}
