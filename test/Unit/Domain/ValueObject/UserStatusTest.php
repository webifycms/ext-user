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

namespace Webify\User\Test\Unit\Domain\ValueObject;

use PHPUnit\Framework\Attributes\{CoversClass, CoversMethod, Test};
use PHPUnit\Framework\TestCase;
use ValueError;
use Webify\User\Domain\ValueObject\UserStatus;

/**
 * UserStatusTest tests the functionality of the UserStatus value object.
 *
 * @internal
 */
#[CoversClass(UserStatus::class)]
#[CoversMethod(UserStatus::class, 'fromString')]
#[CoversMethod(UserStatus::class, 'isActive')]
#[CoversMethod(UserStatus::class, 'isInactive')]
#[CoversMethod(UserStatus::class, 'isDeactivated')]
#[CoversMethod(UserStatus::class, 'isUnverified')]
final class UserStatusTest extends TestCase
{
	/**
	 * Tests whether the `UserStatus::Active` status is correctly identified as active.
	 */
	#[Test]
	public function testActiveStatusIsActive(): void
	{
		$status = UserStatus::Active;

		$this->assertTrue($status->isActive());
		$this->assertFalse($status->isInactive());
		$this->assertFalse($status->isDeactivated());
		$this->assertFalse($status->isUnverified());
	}

	/**
	 * Tests whether the `UserStatus::Inactive` status is correctly identified as inactive.
	 */
	#[Test]
	public function testInactiveStatusIsInactive(): void
	{
		$status = UserStatus::Inactive;

		$this->assertFalse($status->isActive());
		$this->assertTrue($status->isInactive());
		$this->assertFalse($status->isDeactivated());
		$this->assertFalse($status->isUnverified());
	}

	/**
	 * Tests whether the `UserStatus::Deactivated` status is correctly identified as deactivated.
	 */
	#[Test]
	public function testDeactivatedStatusIsDeactivated(): void
	{
		$status = UserStatus::Deactivated;

		$this->assertFalse($status->isActive());
		$this->assertFalse($status->isInactive());
		$this->assertTrue($status->isDeactivated());
		$this->assertFalse($status->isUnverified());
	}

	/**
	 * Tests whether the `UserStatus::Unverified` status is correctly identified as unverified.
	 *
	 * This case was contributed by Authentication when the enum was merged into the shared
	 * kernel, where Identity's three lifecycle cases used to be the only ones.
	 */
	#[Test]
	public function testUnverifiedStatusIsUnverified(): void
	{
		$status = UserStatus::Unverified;

		$this->assertFalse($status->isActive());
		$this->assertFalse($status->isInactive());
		$this->assertFalse($status->isDeactivated());
		$this->assertTrue($status->isUnverified());
	}

	/**
	 * Tests that each status reports only its own case.
	 */
	#[Test]
	public function testEveryCaseReportsOnlyItself(): void
	{
		foreach (UserStatus::cases() as $status) {
			foreach (UserStatus::cases() as $other) {
				$this->assertSame(
					$status === $other,
					$status->{'is' . $other->name}(),
					sprintf('%s::is%s() should be %s', $status->name, $other->name, $status === $other ? 'true' : 'false')
				);
			}
		}
	}

	/**
	 * Tests status values.
	 */
	#[Test]
	public function testStatusValues(): void
	{
		$this->assertSame('active', UserStatus::Active->value);
		$this->assertSame('inactive', UserStatus::Inactive->value);
		$this->assertSame('deactivated', UserStatus::Deactivated->value);
		$this->assertSame('unverified', UserStatus::Unverified->value);
	}

	/**
	 * Tests weather can create status from value.
	 */
	#[Test]
	public function testStatusFromValue(): void
	{
		$this->assertSame(UserStatus::Active, UserStatus::from('active'));
		$this->assertSame(UserStatus::Inactive, UserStatus::from('inactive'));
		$this->assertSame(UserStatus::Deactivated, UserStatus::from('deactivated'));
		$this->assertSame(UserStatus::Unverified, UserStatus::from('unverified'));
	}

	/**
	 * Tests throwing exception for invalid value.
	 */
	#[Test]
	public function testInvalidValueThrowsException(): void
	{
		$this->expectException(ValueError::class);
		UserStatus::from('invalid');
	}

	/**
	 * Tests every case survives the round trip through its stored string.
	 *
	 * Identity's lifecycle cases must not collapse on the way in, otherwise a deactivated
	 * user is reported to guards as unverified and rejected for the wrong reason.
	 */
	#[Test]
	public function testFromStringResolvesEveryCaseToItself(): void
	{
		foreach (UserStatus::cases() as $status) {
			$this->assertSame(
				$status,
				UserStatus::fromString($status->value),
				sprintf('status "%s" must resolve to its own case', $status->value)
			);
		}
	}

	/**
	 * Tests an unreadable status fails closed instead of throwing.
	 *
	 * `from()` would raise a ValueError here, escaping whatever flow happened to read the
	 * row. `fromString()` reports `Unverified` so a guard rejects the user deliberately.
	 */
	#[Test]
	public function testFromStringFallsBackToUnverifiedForUnknownValue(): void
	{
		$this->assertSame(UserStatus::Unverified, UserStatus::fromString('unknown_status'));
		$this->assertFalse(UserStatus::fromString('unknown_status')->isActive());
	}

	/**
	 * Tests the fallback also covers values that are empty or the wrong shape entirely.
	 */
	#[Test]
	public function testFromStringFallsBackToUnverifiedForUnusableValue(): void
	{
		$this->assertSame(UserStatus::Unverified, UserStatus::fromString(''));
		$this->assertSame(UserStatus::Unverified, UserStatus::fromString('0'));
		$this->assertSame(UserStatus::Unverified, UserStatus::fromString('Active'));
	}
}
