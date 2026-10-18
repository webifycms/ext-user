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
 * Architecture tests for the Domain in `src/Domain`.
 *
 * `src/Domain` holds the value objects and exceptions that Identity, Authentication and
 * Authorization all depend on. Because it sits below every context, it must not reach back
 * up into any of them — otherwise the dependency direction inverts and the contexts can no
 * longer be developed or reasoned about independently.
 *
 * @internal
 */
final class DomainSpecification
{
	/**
	 * The shared kernel must not depend on a context.
	 */
	public function testSharedKernelDoesNotDependOnContext(): Rule
	{
		return PHPat::rule()
			->classes(Selector::inNamespace('Webify\User\Domain'))
			->shouldNot()
			->dependOn()
			->classes(Selector::inNamespace('Webify\User\Context'))
			->because('the shared kernel sits below every context and must not depend on one')
		;
	}

	/**
	 * The shared kernel must not depend on the top-level application layer.
	 */
	public function testSharedKernelDoesNotDependOnApplication(): Rule
	{
		return PHPat::rule()
			->classes(Selector::inNamespace('Webify\User\Domain'))
			->shouldNot()
			->dependOn()
			->classes(Selector::inNamespace('Webify\User\Application'))
			->because('the shared kernel must not depend on an outer layer')
		;
	}

	/**
	 * The shared kernel must not depend on the infrastructure layer.
	 */
	public function testSharedKernelDoesNotDependOnInfrastructure(): Rule
	{
		return PHPat::rule()
			->classes(Selector::inNamespace('Webify\User\Domain'))
			->shouldNot()
			->dependOn()
			->classes(Selector::inNamespace('Webify\User\Infrastructure'))
			->because('the shared kernel must not depend on an outer layer')
		;
	}

	/**
	 * All shared kernel exception classes must extend \Exception.
	 */
	public function testSharedKernelExceptionsExtendException(): Rule
	{
		return PHPat::rule()
			->classes(Selector::inNamespace('Webify\User\Domain\Exception'))
			->should()
			->extend()
			->classes(Selector::classname(Exception::class))
			->because('All domain exceptions must extend \Exception to ensure consistent error handling')
		;
	}
}
