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

use Webify\Admin\Infrastructure\Service\ViewInjector\PrimaryMenuViewInjectorService;
use Webify\Base\Domain\Exception\TranslatableRuntimeException;
use Webify\Base\Domain\Service\Application\ApplicationServiceInterface;
use Webify\Base\Domain\Service\Config\ConfigServiceInterface;
use Webify\Base\Domain\Service\Dependency\DependencyServiceInterface;
use Webify\Base\Infrastructure\Service\Application\WebApplicationServiceInterface;
use Webify\Base\Infrastructure\Service\Bootstrap\BaseWebBootstrapService;
use Webify\Base\Infrastructure\Service\Bootstrap\RegisterAdminRoutesBootstrapInterface;
use Webify\Base\Infrastructure\Service\Bootstrap\RegisterControllerNamespaceBootstrapInterface;
use Webify\Base\Infrastructure\Service\Bootstrap\RegisterDependenciesBootstrapInterface;
use Webify\User\Infrastructure\Service\Menu\PrimaryMenuItemService;
use yii\base\InvalidArgumentException;
use yii\base\InvalidConfigException;
use yii\i18n\PhpMessageSource;
use yii\web\AssetManager;

use function Webify\Base\Infrastructure\get_alias;
use function Webify\Base\Infrastructure\set_alias;

/**
 * WebBootstrapService is responsible for initializing and setting up the bootstrap process for the web application,
 * including registering required dependencies, routes and controllers.
 */
final class WebBootstrapService extends BaseWebBootstrapService implements RegisterDependenciesBootstrapInterface, RegisterAdminRoutesBootstrapInterface, RegisterControllerNamespaceBootstrapInterface
{
	/**
	 * The extension templates path.
	 */
	public const TEMPLATES_PATH = '@User/templates';

	public function __construct(
		DependencyServiceInterface $dependencyService,
		ConfigServiceInterface $configService,
	) {
		set_alias('@User', '@Extensions/ext-user');

		parent::__construct($dependencyService, $configService);
	}

	public function bootstrap(ApplicationServiceInterface $appService): void
	{
		if ($appService instanceof WebApplicationServiceInterface) {
			// register translations for the user extension.
			$appService->getApplication()->i18n->translations['user*'] = [
				'class'          => PhpMessageSource::class,
				'sourceLanguage' => 'en-US',
				'basePath'       => '@User/resources/translations',
			];

			/**
			 * @var PrimaryMenuViewInjectorService $primaryMenuInjector
			 */
			$primaryMenuInjector = $appService->getService(PrimaryMenuViewInjectorService::class);
			$assetsUrl           = $this->publishAssets($appService->getApplication()->assetManager);

			$primaryMenuInjector->register(new PrimaryMenuItemService($assetsUrl));
		}
	}

	public function dependencies(): array
	{
		return require get_alias('@User/config/dependencies.php');
	}

	public function adminRoutes(): array
	{
		return require get_alias('@User/config/admin/routes.php');
	}

	public function controllerNamespaces(): array
	{
		return [
			'Webify\User\Infrastructure\Presentation\Web\Controller',
			'Webify\User\Infrastructure\Presentation\Api\Controller',
			'Webify\User\Infrastructure\Presentation\Web\Controller\Admin',
		];
	}

	private function publishAssets(AssetManager $assetManager): string
	{
		try {
			$published = $assetManager->publish('@User/resources/assets');

			return $published[1];
		} catch (InvalidArgumentException|InvalidConfigException $exception) {
			throw new TranslatableRuntimeException(
				'Unable to publish user extension assets.',
				['directory' => '@User/resources/assets'],
				$exception->getCode(),
				$exception
			);
		}
	}
}
