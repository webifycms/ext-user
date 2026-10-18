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
use Webify\User\Domain\Exception\InvalidPasswordHashException;
use Webify\User\Domain\ValueObject\PasswordHash;

/**
 * PasswordHashTest tests the functionality of the HashedPassword value object.
 *
 * @internal
 */
#[CoversClass(PasswordHash::class)]
#[CoversMethod(PasswordHash::class, 'fromHash')]
#[CoversMethod(PasswordHash::class, 'equals')]
#[CoversMethod(PasswordHash::class, '__toString')]
#[CoversMethod(PasswordHash::class, 'toNative')]
final class PasswordHashTest extends TestCase
{
	#[Test]
	public function testCreateValidHashedPassword(): void
	{
		$hash           = password_hash('test_password', PASSWORD_DEFAULT);
		$hashedPassword = PasswordHash::fromHash($hash);

		$this->assertInstanceOf(PasswordHash::class, $hashedPassword);
		$this->assertSame($hash, $hashedPassword->toNative());
	}

	#[Test]
	public function testEmptyHashThrowsException(): void
	{
		$this->expectException(InvalidPasswordHashException::class);
		PasswordHash::fromHash('');
	}

	#[Test]
	public function testToNativeReturnsStringValue(): void
	{
		$hash           = password_hash('test_password', PASSWORD_DEFAULT);
		$hashedPassword = PasswordHash::fromHash($hash);

		$this->assertSame($hash, $hashedPassword->toNative());
	}

	#[Test]
	public function testStringRepresentation(): void
	{
		$hash           = password_hash('test_password', PASSWORD_DEFAULT);
		$hashedPassword = PasswordHash::fromHash($hash);

		$this->assertSame($hash, (string) $hashedPassword);
	}

	#[Test]
	public function testEqualsReturnsTrueForSameHash(): void
	{
		$hash            = password_hash('test_password', PASSWORD_DEFAULT);
		$hashedPassword1 = PasswordHash::fromHash($hash);
		$hashedPassword2 = PasswordHash::fromHash($hash);

		$this->assertTrue($hashedPassword1->equals($hashedPassword2));
	}

	#[Test]
	public function testEqualsReturnsFalseForDifferentHash(): void
	{
		$hashedPassword1 = PasswordHash::fromHash(password_hash('password_one', PASSWORD_DEFAULT));
		$hashedPassword2 = PasswordHash::fromHash(password_hash('password_two', PASSWORD_DEFAULT));

		$this->assertFalse($hashedPassword1->equals($hashedPassword2));
	}

	#[Test]
	public function testPlaintextPasswordIsRejected(): void
	{
		$this->expectException(InvalidPasswordHashException::class);
		PasswordHash::fromHash('test_password');
	}

	#[Test]
	public function testMalformedHashIsRejected(): void
	{
		$this->expectException(InvalidPasswordHashException::class);
		PasswordHash::fromHash('not-a-hash');
	}

	#[Test]
	public function testZeroStringIsRejected(): void
	{
		$this->expectException(InvalidPasswordHashException::class);
		PasswordHash::fromHash('0');
	}

	#[Test]
	public function testWhitespaceOnlyValueIsRejected(): void
	{
		$this->expectException(InvalidPasswordHashException::class);
		PasswordHash::fromHash('   ');
	}

	#[Test]
	public function testPaddedHashIsRejectedRatherThanSilentlyTrimmed(): void
	{
		$padded = '  ' . password_hash('test_password', PASSWORD_DEFAULT) . '  ';

		$this->expectException(InvalidPasswordHashException::class);
		PasswordHash::fromHash($padded);
	}

	#[Test]
	public function testTruncatedHashIsRejected(): void
	{
		$hash = password_hash('test_password', PASSWORD_DEFAULT);

		$this->expectException(InvalidPasswordHashException::class);
		PasswordHash::fromHash(substr($hash, 0, 20));
	}

	#[Test]
	public function testHashFromNonDefaultAlgorithmIsAccepted(): void
	{
		$hash = password_hash('test_password', PASSWORD_ARGON2ID);

		$this->assertSame($hash, PasswordHash::fromHash($hash)->toNative());
	}
}
