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

namespace Webify\User\Domain\ValueObject;

/**
 * The user status value object.
 *
 * Shared by every context, so it lives in the shared kernel. This enum is the reconciliation of
 * two previously diverged copies:
 *
 * - Identity owned `Active`, `Inactive`, `Deactivated` — the lifecycle of the user aggregate.
 * - Authentication owned `Active`, `Unverified` — only the subset it needs to gate logins.
 *
 * Both sets are preserved here so neither context loses a case it depends on.
 */
enum UserStatus: string
{
	case Active      = 'active';
	case Inactive    = 'inactive';
	case Deactivated = 'deactivated';
	case Unverified  = 'unverified';

	/**
	 * Resolves a stored status string to the corresponding status.
	 *
	 * Status reaches the boundaries as a plain string — `UserCredentials::$status` is a string,
	 * as is a column read from persistence — so this is the step that turns it back into a
	 * real type.
	 *
	 * An unrecognised value resolves to {@see self::Unverified} rather than throwing. A status
	 * the system cannot read means the data is not understood, and failing closed on that keeps
	 * a guard from admitting a user whose state is unknown. Throwing instead would turn one
	 * unexpected row into an unhandled error escaping whatever flow happened to read it.
	 *
	 * @param string $status the stored status, such as 'active'
	 */
	public static function fromString(string $status): self
	{
		return self::tryFrom($status) ?? self::Unverified;
	}

	/**
	 * Check if the user is active.
	 */
	public function isActive(): bool
	{
		return self::Active === $this;
	}

	/**
	 * Check if the user is inactive.
	 */
	public function isInactive(): bool
	{
		return self::Inactive === $this;
	}

	/**
	 * Check if the user is deactivated.
	 */
	public function isDeactivated(): bool
	{
		return self::Deactivated === $this;
	}

	/**
	 * Check if the user is unverified.
	 */
	public function isUnverified(): bool
	{
		return self::Unverified === $this;
	}
}
