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
use Webify\User\Domain\Exception\InvalidUserIdException;
use Webify\User\Domain\ValueObject\UserId;

/**
 * UserIdTest tests the functionality of the UserId value object.
 *
 * @internal
 */
#[CoversClass(UserId::class)]
#[CoversMethod(UserId::class, 'fromString')]
final class UserIdTest extends TestCase
{
	/**
	 * Tests the creation of a valid user ID from a string.
	 */
	#[Test]
	public function testCreateValidUserId(): void
	{
		$userId = UserId::fromString('01ARZ3NDEKTSV4RRFFQ69G5FAV');

		$this->assertInstanceOf(UserId::class, $userId);
	}

	/**
	 * Test user ID with an invalid format.
	 */
	#[Test]
	public function testInvalidUserIdFormatThrowsException(): void
	{
		$this->expectException(InvalidUserIdException::class);
		UserId::fromString('invalid-id-format');
	}
}
