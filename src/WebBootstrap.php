<?php

declare(strict_types=1);

namespace OneCMS\User;

use OneCMS\Base\Infrastructure\Service\Application\WebApplicationServiceInterface;
use OneCMS\Base\Infrastructure\Service\Bootstrap\WebBootstrapService;
use OneCMS\User\Infrastructure\Framework\Module;

/**
 * WebBootstrap
 *
 * @package getonecms/ext-user
 * @version 0.0.1
 * @since   0.0.1
 * @author  Mohammed Shifreen
 */
class WebBootstrap extends WebBootstrapService
{
    /**
     * @param WebApplicationServiceInterface $app
     */
    public function init(WebApplicationServiceInterface $app): void
    {
        parent::init($app);
        set_alias('@User', dirname(__DIR__));

        $adminPath = $app->getAdministration()->getPath();

        $app->getAdministration()->setMenuItems([
            [
                'label' => 'Users',
                'icon' => 'person-square',
                'route' => ["/$adminPath/user"],
                'position' => 1,
            ]
        ]);
        $app->getApplication()->getModule($adminPath)->setModule('user', ['class' => Module::class]);
    }
}
