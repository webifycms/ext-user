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

namespace Webify\User\Test\Unit\Context\Authentication\Domain\ValueObject;

use PHPUnit\Framework\Attributes\{CoversClass, CoversMethod, Test};
use PHPUnit\Framework\TestCase;
use Webify\User\Context\Authentication\Domain\Exception\InvalidAccessTokenException;
use Webify\User\Context\Authentication\Domain\ValueObject\AccessToken;

/**
 * Tests for the AccessToken value object.
 *
 * @internal
 */
#[CoversClass(AccessToken::class)]
#[CoversMethod(AccessToken::class, '__toString')]
#[CoversMethod(AccessToken::class, 'generate')]
#[CoversMethod(AccessToken::class, 'throwExceptionWhenInvalid')]
final class AccessTokenTest extends TestCase
{
	/**
	 * Test creating a valid access token from a 64-character hex string.
	 */
	#[Test]
	public function testFromStringWithValidToken(): void
	{
		$value = '0123456789abcdef0123456789abcdef0123456789abcdef0123456789abcdef';
		$token = AccessToken::fromString($value);

		$this->assertSame($value, $token->toNative());
	}

	/**
	 * Test throws InvalidAccessTokenException for a token shorter than 64 characters.
	 */
	#[Test]
	public function testThrowsExceptionForTooShortToken(): void
	{
		$this->expectException(InvalidAccessTokenException::class);
		$this->expectExceptionMessageIs('The access token "short" is invalid.');

		AccessToken::fromString('short');
	}

	/**
	 * Test generate always produces an access token with at least 64 characters.
	 */
	#[Test]
	public function testGenerateProducesLongEnoughToken(): void
	{
		$token = AccessToken::generate();

		$this->assertGreaterThanOrEqual(64, strlen($token->toNative()));
	}

	/**
	 * Test generate returns an AccessToken instance.
	 */
	#[Test]
	public function testGenerateReturnsAccessTokenInstance(): void
	{
		$token = AccessToken::generate();

		$this->assertInstanceOf(AccessToken::class, $token);
	}

	/**
	 * Test fromString returns an AccessToken instance.
	 */
	#[Test]
	public function testFromStringReturnsAccessTokenInstance(): void
	{
		$token = AccessToken::fromString('0123456789abcdef0123456789abcdef0123456789abcdef0123456789abcdef');

		$this->assertInstanceOf(AccessToken::class, $token);
	}

	/**
	 * Test __toString returns the token value.
	 */
	#[Test]
	public function testToStringReturnsTokenValue(): void
	{
		$value = '0123456789abcdef0123456789abcdef0123456789abcdef0123456789abcdef';
		$token = AccessToken::fromString($value);

		$this->assertSame($value, (string) $token);
	}

	/**
	 * Test equals returns true for two access tokens with the same value.
	 */
	#[Test]
	public function testEqualsReturnsTrueForSameValue(): void
	{
		$value   = '0123456789abcdef0123456789abcdef0123456789abcdef0123456789abcdef';
		$token1  = AccessToken::fromString($value);
		$token2  = AccessToken::fromString($value);

		$this->assertTrue($token1->equals($token2));
	}

	/**
	 * Test equals returns false for two access tokens with different values.
	 */
	#[Test]
	public function testEqualsReturnsFalseForDifferentValues(): void
	{
		$token1 = AccessToken::generate();
		$token2 = AccessToken::generate();

		$this->assertFalse($token1->equals($token2));
	}
}
