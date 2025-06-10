<?php

/**
 * The file is part of the "webifycms/ext-user", WebifyCMS extension package.
 *
 * @see https://webifycms.com/extension/user
 *
 * @copyright Copyright (c) 2023 WebifyCMS
 * @license https://webifycms.com/extension/user/license
 * @author Mohammed Shifreen <mshifreen@gmail.com>
 */
declare(strict_types=1);

namespace Webify\User\Test\Unit\Domain\Model\Account\ValueObject;

use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use Webify\Base\Domain\Service\Validator\EmailValidatorServiceInterface;
use Webify\User\Domain\Model\Account\Exception\InvalidAccountEmailException;
use Webify\User\Domain\Model\Account\ValueObject\AccountEmail;

/**
 * Account email test class.
 *
 * @coversDefaultClass \Webify\User\Domain\Model\Account\ValueObject\AccountEmail
 *
 * @internal
 */
final class AccountEmailTest extends TestCase
{
	private EmailValidatorServiceInterface $validatorService;

	/**
	 * @throws Exception
	 */
	protected function setUp(): void
	{
		parent::setUp();

		$this->validatorService = $this->createMock(EmailValidatorServiceInterface::class);
	}

	/**
	 * @covers \AccountEmail::create
	 * @covers \AccountEmail::isValid
	 */
	public function testCanBeCreatedWithValidEmailAddress(): void
	{
		// @phpstan-ignore-next-line
		$this->validatorService->method('isValid')
			->willReturn(true)
		;
		$this->assertInstanceOf(
			AccountEmail::class,
			AccountEmail::create('info@webifycms.com', $this->validatorService)
		);
	}

	/**
	 * @covers \AccountEmail::create
	 * @covers \AccountEmail::isValid
	 */
	public function testCannotBeCreatedWithInvalidEmailAddress(): void
	{
		// @phpstan-ignore-next-line
		$this->validatorService->method('isValid')
			->willReturn(false)
		;
		$this->expectException(InvalidAccountEmailException::class);

		AccountEmail::create('invalid_email', $this->validatorService);
	}

	/**
	 * @covers \AccountEmail::__toString
	 * @covers \AccountEmail::create
	 * @covers \AccountEmail::isValid
	 */
	public function testCanBeUsedAsString(): void
	{
		// @phpstan-ignore-next-line
		$this->validatorService->method('isValid')
			->willReturn(true)
		;

		$email = AccountEmail::create('info@webifycms.com', $this->validatorService);

		$this->assertSame(
			'info@webifycms.com',
			(string) $email
		);
	}
}
