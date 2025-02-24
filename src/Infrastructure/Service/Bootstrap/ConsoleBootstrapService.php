<?php

/**
 * The file is part of the "webifycms/ext-user", WebifyCMS extension package.
 *
 * @see https://webifycms.com/extension/user
 *
 * @license Copyright (c) 2022 WebifyCMS
 * @license https://webifycms.com/extension/user/license
 * @author Mohammed Shifreen <mshifreen@gmail.com>
 */
declare(strict_types=1);

namespace Webify\User\Infrastructure\Service\Bootstrap;

use Webify\Base\Domain\Service\Application\ApplicationServiceInterface;
use Webify\Base\Domain\Service\Config\ConfigServiceInterface;
use Webify\Base\Domain\Service\Dependency\DependencyServiceInterface;
use Webify\Base\Infrastructure\Service\Bootstrap\BaseConsoleBootstrapService;
use Webify\Base\Infrastructure\Service\Bootstrap\RegisterControllerMapBootstrapInterface;
use yii\console\controllers\MigrateController;

use function Webify\Base\Infrastructure\set_alias;

/**
 * Handles the console bootstrap functionality for the application.
 * Extends the base functionality provided by BaseConsoleBootstrapService
 * and implements the necessary interface for registering controllers.
 */
final class ConsoleBootstrapService extends BaseConsoleBootstrapService implements RegisterControllerMapBootstrapInterface
{
	/**
	 * The class construct.
	 */
	public function __construct(
		DependencyServiceInterface $dependencyService,
		ConfigServiceInterface $configService,
	) {
		set_alias('@User', '@Extensions/ext-user');
		parent::__construct($dependencyService, $configService);
	}

	public function bootstrap(ApplicationServiceInterface $appService): void
	{
		// TODO: Implement bootstrap() method.
	}

	public function controllerMap(): array
	{
		// @phpstan-ignore-next-line
		return [
			'migrate-user' => [
				'class'          => MigrateController::class,
				'migrationPath'  => '@User/database/migrations',
			],
		];
	}
}
