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

namespace Webify\User\Context\Identity\Infrastructure\Container;

use Webify\Base\Domain\Contract\Identity\Service\PasswordHasherInterface;
use Webify\Base\Infrastructure\Contract\DefinitionsInterface;
use Webify\User\Context\Identity\Infrastructure\Service\PasswordHasher;

use function DI\create;

/**
 * Description.
 */
final readonly class ServiceDefinitions implements DefinitionsInterface
{
	/**
	 * {@inheritDoc}
	 */
	public static function getDefinitions(): array
	{
		return [
			PasswordHasherInterface::class => create(PasswordHasher::class),
		];
	}
}
