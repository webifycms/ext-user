<?php
declare(strict_types=1);

namespace OneCMS\User\Infrastructure\Framework\Console;

use OneCMS\Base\Infrastructure\Framework\Bootstrap\RegisterControllersBootstrapInterface;
use OneCMS\Base\Infrastructure\Framework\Console\Bootstrap\ConsoleAbstractBootstrap;

/**
 * Class Bootstrap
 *
 * @package getonecms/user
 * @version 0.0.1
 * @since   0.0.1
 * @author  Mohammed Shifreen
 */
class Bootstrap extends ConsoleAbstractBootstrap implements RegisterControllersBootstrapInterface
{
    /**
     * @return array
     */
    public function controllers(): array
    {
        return [
            'migrate-user' => [
                'class' => 'yii\console\controllers\MigrateController',
                'migrationPath' => '@User/Framework/Console/Migration',
                'migrationTable' => 'migration_user',
            ],
        ];
    }
}