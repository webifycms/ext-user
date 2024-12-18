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

use Webify\Base\Domain\Service\Application\ApplicationServiceInterface as DomainApplicationServiceInterface;
use Webify\Base\Domain\Service\Dependency\DependencyServiceInterface;
use Webify\Base\Infrastructure\Service\Application\ApplicationServiceInterface;
use Webify\Base\Infrastructure\Service\Application\WebApplicationServiceInterface;
use Webify\Base\Infrastructure\Service\Bootstrap\BaseWebBootstrapService;
use Webify\Base\Infrastructure\Service\Bootstrap\RegisterDependencyBootstrapInterface;
use Webify\Base\Infrastructure\Service\Bootstrap\RegisterRoutesBootstrapInterface;
use Webify\User\Infrastructure\UserModule;
use function Webify\Admin\Infrastructure\administration_path;
use function Webify\Base\Infrastructure\get_alias;
use function Webify\Base\Infrastructure\set_alias;

/**
 * WebBootstrapService is responsible for initializing and setting up
 * the bootstrap process for the web application, including registering
 * modules and required dependencies. It extends the BaseWebBootstrapService
 * and implements the RegisterDependencyBootstrapInterface.
 */
final class WebBootstrapService extends BaseWebBootstrapService
    implements RegisterDependencyBootstrapInterface, RegisterRoutesBootstrapInterface
{
    public function __construct(
        DependencyServiceInterface                                                                   $dependencyService,
        ApplicationServiceInterface|WebApplicationServiceInterface|DomainApplicationServiceInterface $appService
    )
    {
        set_alias('@User', \dirname(__DIR__));
        parent::__construct($dependencyService, $appService);
    }

    /**
     * @inheritDoc
     */
    public function init(): void
    {
        $this->getApplication()->getModule(administration_path())->setModule('user', [
            'class' => UserModule::class,
        ]);
        $this->registerTranslations();
    }

    /**
     * @inheritDoc
     */
    public function dependencies(): array
    {
        return include_once get_alias('@User/config/dependencies.php');
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

    /**
     * @inheritDoc
     */
    public function routes(): array
    {
        return include_once get_alias('@User/config/routes.php');
    }
}
