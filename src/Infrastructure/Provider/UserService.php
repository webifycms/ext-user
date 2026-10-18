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

namespace Webify\User\Infrastructure\Provider;

use Webify\Base\Infrastructure\Contract\ServiceProviderInterface;
use Webify\User\Context\Authentication\Infrastructure\Container\ServiceDefinitions as AuthenticationServiceDefinitions;
use Webify\User\Context\Authorization\Infrastructure\Container\ServiceDefinitions as AuthorizationServiceDefinitions;
use Webify\User\Context\Identity\Infrastructure\Container\ServiceDefinitions as IdentityServiceDefinitions;

/**
 * The user service provider.
 */
final readonly class UserService implements ServiceProviderInterface
{
	/**
	 * {@inheritDoc}
	 */
	public function getDefinitions(): array
	{
		return [
			...AuthenticationServiceDefinitions::getDefinitions(),
			...AuthorizationServiceDefinitions::getDefinitions(),
			...IdentityServiceDefinitions::getDefinitions(),
		];
	}
}
