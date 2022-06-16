<?php

declare(strict_types=1);

namespace OneCMS\User;

use OneCMS\Base\Infrastructure\Service\Bootstrap\RegisterDependencyBootstrapInterface;
use OneCMS\Base\Infrastructure\Service\Bootstrap\WebBootstrapService;
use OneCMS\User\Application\Repository\Person\PersonRepositoryInterface;
use OneCMS\User\Infrastructure\UserModule;
use OneCMS\User\Infrastructure\Persistence\Person\PersonRepository;

/**
 * WebBootstrap
 *
 * @package getonecms/ext-user
 * @version 0.0.1
 * @since   0.0.1
 * @author  Mohammed Shifreen
 */
class WebBootstrap extends WebBootstrapService implements RegisterDependencyBootstrapInterface
{
    /**
     * @inheritdoc
     */
    public function init(): void
    {
        set_alias('@User', dirname(__DIR__));

        $adminPath = $this->getApplicationService()->getAdministration()->getPath();

        $this->getApplication()->getModule($adminPath)->setModule('user', [
            'class' => UserModule::class
        ]);
        $this->registerAdminMenuItems($adminPath);
        $this->registerTranslations();
    }

    /**
     * @inheritDoc
     */
    public function dependencies(): array
    {
        return [
            PersonRepositoryInterface::class => PersonRepository::class
        ];
    }

    /**
     * Register user extension's admin menu items.
     *
     * @param string $adminPath
     */
    private function registerAdminMenuItems(string $adminPath): void
    {
        $this->getApplicationService()->getAdministration()->setMenuItems([
            [
                'label' => 'Users',
                'icon' => 'person-square',
                'route' => ["/$adminPath/user"],
                'position' => 1,
            ]
        ]);
    }

    /**
     * Register translations for user extension.
     */
    private function registerTranslations(): void
    {
        $this->getApplication()->i18n->translations['user*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@User/resources/translations',
        ];
    }
}
