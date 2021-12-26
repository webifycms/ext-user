<?php
declare(strict_types=1);

namespace OneCMS\User\Infrastructure\Framework\Console;

use OneCMS\Base\Infrastructure\Framework\Console\Application\ConsoleApplicationInterface;
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
     * @inheritDoc
     */
    public function init(ConsoleApplicationInterface $app): void
    {
        parent::init($app);
        set_alias('@User', dirname(__DIR__, 4));
    }

    /**
     * @return array
     */
    public function controllers(): array
    {
        return [
            'migrate-user' => [
                'class' => 'yii\console\controllers\MigrateController',
                'migrationPath' => '@User/src/Infrastructure/Framework/Console/Migration', //null,
                'migrationTable' => 'migration_user',
                // 'migrationNamespaces' => [
                //     'OneCMS\User\Infrastructure\Framework\Console\Migration'
                // ]
            ],
        ];
    }
}
