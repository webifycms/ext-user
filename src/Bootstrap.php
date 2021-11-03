<?php
declare(strict_types=1);

namespace OneCMS\User;


use OneCMS\Base\Infrastructure\Framework\Bootstrap\AbstractBootstrap;
use OneCMS\Base\Infrastructure\Framework\Web\Application\WebApplicationInterface;
use OneCMS\User\Infrastructure\Framework\Module;

/**
 * Class Bootstrap
 *
 * @package getonecms/user
 * @version 0.0.1
 * @since   0.0.1
 * @author  Mohammed Shifreen
 */
class Bootstrap extends AbstractBootstrap
{
    /**
     * @param WebApplicationInterface $app
     */
    public function init(WebApplicationInterface $app): void
    {
        parent::init($app);
        set_alias('@User', dirname(__DIR__));

        $adminPath = $app->getAdministration()->getPath();

        $app->getAdministration()->getMenu()->addItems([
            [
                'label' => 'Users',
                'icon' => 'person-square',
                'route' => ["/$adminPath/user"],
                'position' => 1,
            ]
        ]);
        $app->getComponent()->getModule($adminPath)->setModule('user', ['class' => Module::class]);
    }
}
