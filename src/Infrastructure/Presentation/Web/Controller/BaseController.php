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

namespace Webify\User\Infrastructure\Presentation\Web\Controller;

use Webify\Base\Infrastructure\Component\Theme\ThemeComponent;
use Webify\Base\Infrastructure\Presentation\Web\Controller\WebController;
use Webify\User\Infrastructure\Service\Bootstrap\WebBootstrapService;

/**
 * Base controller class for this extension, it helps to set templates path and template theme support.
 */
class BaseController extends WebController
{
	public function init(): void
	{
		$this->setViewPath(WebBootstrapService::TEMPLATES_PATH);
		$this->addThemeSupport();
		parent::init();
	}

	/**
	 * Add theme support for the templates.
	 */
	private function addThemeSupport(): void
	{
		$theme = $this->view->theme;

		if ($theme instanceof ThemeComponent) {
			$theme->addToPathMap(
				[
					$this->getViewPath() => '@Theme/templates/admin/user',
				]
			);
		}
	}
}
