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

namespace OneCMS\User\Test\Unit\Domain\Model\Account\ValueObject;

use OneCMS\User\Domain\Model\Account\Exception\InvalidAccountEmailException;
use OneCMS\User\Domain\Model\Account\ValueObject\AccountEmail;
use PHPUnit\Framework\TestCase;

/**
 * Account email test class.
 */
final class AccountEmailTest extends TestCase
{
    /**
	 * @covers \AccountEmail::create
	 * @covers \AccountEmail::isValid
	 */
	public function testCanBeCreatedWithValidEmailAddress(): void
	{
		static::assertInstanceOf(
			AccountEmail::class,
			AccountEmail::create('test@example.com')
		);
	}

	/**
	 * @covers \AccountEmail::create
	 * @covers \AccountEmail::isValid
	 */
	public function testCannotBeCreatedWithInvalidEmailAddress(): void
	{
		$this->expectException(InvalidAccountEmailException::class);

		AccountEmail::create('invalid_email');
	}

	/**
	 * @covers \AccountEmail::__toString
	 * @covers \AccountEmail::create
	 * @covers \AccountEmail::isValid
	 */
	public function testCanBeUsedAsString(): void
	{
		$email = AccountEmail::create('test@example.com');

		static::assertSame(
			'test@example.com',
			(string) $email
		);
	}
}
