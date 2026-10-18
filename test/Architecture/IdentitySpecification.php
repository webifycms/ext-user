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

namespace Webify\User\Test\Architecture;

use Exception;
use PHPat\Selector\Selector;
use PHPat\Test\Builder\Rule;
use PHPat\Test\PHPat;

/**
 * Architecture tests for the Identity context.
 *
 * Domain is the innermost layer — it must not know about Application or Infrastructure.
 * Application sits between Domain and Infrastructure.
 * Infrastructure implements Domain interfaces (Dependency Inversion).
 *
 * @internal
 */
final class IdentitySpecification
{
	/**
	 * Domain classes must not depend on Application or Infrastructure.
	 *
	 * Anything in `Identity\Domain` that orchestrates repositories, hashers, ID generators
	 * or event publishers is a use case and belongs in `Identity\Application` instead.
	 */
	public function testDomainDoesNotDependOnApplicationOrInfrastructure(): Rule
	{
		return PHPat::rule()
			->classes(Selector::inNamespace('Webify\User\Context\Identity\Domain'))
			->shouldNot()
			->dependOn()
			->classes(
				Selector::inNamespace('Webify\User\Context\Identity\Application'),
				Selector::inNamespace('Webify\User\Context\Identity\Infrastructure'),
			)
			->because('Domain is the innermost layer and must not depend on outer layers')
		;
	}

	/**
	 * Application classes must not depend on Infrastructure classes.
	 *
	 * NOTE: live today — `Identity\Application\Query` and `Identity\Application\Service` are
	 * populated, so a violation here fails `composer analyse`.
	 */
	public function testApplicationDoesNotDependOnInfrastructure(): Rule
	{
		return PHPat::rule()
			->classes(Selector::inNamespace('Webify\User\Context\Identity\Application'))
			->shouldNot()
			->dependOn()
			->classes(Selector::inNamespace('Webify\User\Context\Identity\Infrastructure'))
			->because('Application should not depend on Infrastructure details')
		;
	}

	/**
	 * All domain exception classes must extend \Exception.
	 */
	public function testDomainExceptionsExtendException(): Rule
	{
		return PHPat::rule()
			->classes(Selector::inNamespace('Webify\User\Context\Identity\Domain\Exception'))
			->should()
			->extend()
			->classes(Selector::classname(Exception::class))
			->because('All domain exceptions must extend \Exception to ensure consistent error handling')
		;
	}

	/**
	 * All infrastructure exception classes must extend \Exception.
	 */
	public function testInfrastructureExceptionsExtendException(): Rule
	{
		return PHPat::rule()
			->classes(Selector::inNamespace('Webify\User\Context\Identity\Infrastructure\Exception'))
			->should()
			->extend()
			->classes(Selector::classname(Exception::class))
			->because('All infrastructure exceptions must extend \Exception')
		;
	}
}
