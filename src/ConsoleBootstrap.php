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

namespace Webify\User;

use Webify\Base\Infrastructure\Service\Bootstrap\ConsoleBootstrapService;
use Webify\Base\Infrastructure\Service\Bootstrap\RegisterControllersBootstrapInterface;
use yii\console\controllers\MigrateController;

use function Webify\Base\Infrastructure\set_alias;

/**
 * {@inheritDoc}
 */
final class ConsoleBootstrap extends ConsoleBootstrapService implements RegisterControllersBootstrapInterface
{
	/**
	 * {@inheritDoc}
	 */
	public function init(): void
	{
		set_alias('@User', \dirname(__DIR__));
	}

	public function controllers(): array
	{
		return [
			'migrate-user' => [
				'class'          => MigrateController::class,
				'migrationPath'  => '@User/src/Infrastructure/Console/Migration',
				'migrationTable' => 'migration_user',
			],
		];
	}
}
