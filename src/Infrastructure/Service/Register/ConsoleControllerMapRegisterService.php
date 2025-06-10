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

namespace Webify\User\Infrastructure\Service\Register;

use Webify\Base\Infrastructure\Service\Register\Controllers\ControllerMapRegisterService;
use yii\console\controllers\MigrateController;

/**
 * The service class to register a controller map for the User extension.
 */
final class ConsoleControllerMapRegisterService extends ControllerMapRegisterService
{
	public function getMap(): array
	{
		return [
			'migrate-user' => [
				'class'         => MigrateController::class,
				'migrationPath' => '@User/database/migrations',
			],
		];
	}
}
