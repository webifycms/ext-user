<?php
/**
 * The file is part of the "getonecms/ext-user", OneCMS extension package.
 *
 * @see https://getonecms.com/extension/user
 *
 * @license Copyright (c) 2022 OneCMS
 * @license https://getonecms.com/extension/user/license
 * @author Mohammed Shifreen <mshifreen@gmail.com>
 */
declare(strict_types=1);

namespace OneCMS\User;

use OneCMS\Base\Infrastructure\Service\Bootstrap\RegisterDependencyBootstrapInterface;
use OneCMS\Base\Infrastructure\Service\Bootstrap\WebBootstrapService;
use OneCMS\User\Domain\Service\HashServiceInterface;
use OneCMS\User\Infrastructure\Service\PasswordHash\HashService;
use OneCMS\User\Infrastructure\UserModule;

/**
 * {@inheritDoc}
 */
class WebBootstrap extends WebBootstrapService implements RegisterDependencyBootstrapInterface
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
