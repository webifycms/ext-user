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

namespace Webify\User\Infrastructure;

use Webify\Admin\Infrastructure\AdminModule;
use yii\base\Module;

/**
 * User module.
 */
class UserModule extends Module
{
	public string $basePath = '@User';

	public $layout = 'main';

	public $controllerNamespace = 'Webify\User\Infrastructure\Presentation\Admin\Controller';

	public function init(): void
	{
		parent::init();
		$this->setViewPath('@User/templates');
		$this->registerMenuItems();
	}

	/**
	 * Register user module's admin menu items.
	 */
	private function registerMenuItems(): void
	{
		/**
		 * @var AdminModule $module
		 */
		$module = $this->module;

		$module->menuService->addItems([
			[
				'label'    => 'Users',
				'icon'     => 'person-square',
				'route'    => ["/{$module->id}/user"],
				'position' => 1,
			],
		]);
	}
}
