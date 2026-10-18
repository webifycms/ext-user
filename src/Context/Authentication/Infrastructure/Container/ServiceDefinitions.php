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

namespace Webify\User\Context\Authentication\Infrastructure\Container;

use Webify\Base\Domain\Contract\Authentication\Service\StrategyRegisterInterface;
use Webify\Base\Infrastructure\Contract\DefinitionsInterface;
use Webify\User\Context\Authentication\Infrastructure\Service\StrategyRegister;

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
			StrategyRegisterInterface::class => create(StrategyRegister::class),
		];
	}
}
