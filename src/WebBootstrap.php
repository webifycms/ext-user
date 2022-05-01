<?php

declare(strict_types=1);

namespace OneCMS\User;

use OneCMS\Base\Infrastructure\Service\Bootstrap\WebBootstrapService;
use OneCMS\User\Infrastructure\Module;

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
     * @inheritdoc
     */
    public function init(): void
    {
        set_alias('@User', dirname(__DIR__));

        $adminPath = $this->getApplicationService()->getAdministration()->getPath();

        $this->getApplicationService()->getAdministration()->setMenuItems([
            [
                'label' => 'Users',
                'icon' => 'person-square',
                'route' => ["/$adminPath/user"],
                'position' => 1,
            ]
        ]);
        $this->getApplicationService()->getApplication()->getModule($adminPath)->setModule('user', ['class' => Module::class]);
    }
}
