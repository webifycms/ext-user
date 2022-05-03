<?php

declare(strict_types=1);

namespace OneCMS\User;

use OneCMS\Base\Infrastructure\Service\Bootstrap\ConsoleBootstrapService;
use OneCMS\Base\Infrastructure\Service\Bootstrap\RegisterControllersBootstrapInterface;

/**
 * ConsoleBootstrap
 *
 * @package getonecms/ext-user
 * @version 0.0.1
 * @since   0.0.1
 * @author  Mohammed Shifreen
 */
class ConsoleBootstrap extends ConsoleBootstrapService implements RegisterControllersBootstrapInterface
{
    /**
     * @inheritDoc
     */
    public function init(): void
    {
        set_alias('@User', dirname(__DIR__));
    }

    public function controllers(): array
    {
        return [
            'migrate-user' => [
                'class' => \yii\console\controllers\MigrateController::class,
                'migrationPath' => '@User/src/Infrastructure/Console/Migration', //null,
                'migrationTable' => 'migration_user',
                // 'migrationNamespaces' => [
                //     'OneCMS\User\Infrastructure\Framework\Console\Migration'
                // ]
            ],
        ];
    }
}
