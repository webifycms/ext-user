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

namespace Webify\User;

use Webify\Base\Infrastructure\Service\Bootstrap\RegisterDependencyBootstrapInterface;
use Webify\Base\Infrastructure\Service\Bootstrap\WebBootstrapService;
use Webify\User\Domain\Service\HashServiceInterface;
use Webify\User\Infrastructure\Service\PasswordHash\HashService;
use Webify\User\Infrastructure\UserModule;
use function Webify\Base\Infrastructure\set_alias;

/**
 * {@inheritDoc}
 */
final class WebBootstrap extends WebBootstrapService implements RegisterDependencyBootstrapInterface
{
	/**
	 * {@inheritdoc}
	 */
	public function init(): void
	{
		set_alias('@User', \dirname(__DIR__));

		$adminPath = $this->getApplicationService()->getAdministration()->getPath();

		$this->getApplication()->getModule($adminPath)->setModule('user', [
			'class' => UserModule::class,
		]);
		$this->registerAdminMenuItems($adminPath);
		$this->registerTranslations();
	}

	/**
	 * {@inheritDoc}
	 */
	public function dependencies(): array
	{
		return [
			HashServiceInterface::class => HashService::class,
		];
	}

	/**
	 * Register user extension's admin menu items.
	 */
	private function registerAdminMenuItems(string $adminPath): void
	{
		$this->getApplicationService()->getAdministration()->setMenuItems([
			[
				'label'    => 'Users',
				'icon'     => 'person-square',
				'route'    => ["/{$adminPath}/user"],
				'position' => 1,
			],
		]);
	}

	/**
	 * Register translations for user extension.
	 */
	private function registerTranslations(): void
	{
		$this->getApplication()->i18n->translations['user*'] = [
			'class'          => 'yii\i18n\PhpMessageSource',
			'sourceLanguage' => 'en-US',
			'basePath'       => '@User/resources/translations',
		];
	}
}
