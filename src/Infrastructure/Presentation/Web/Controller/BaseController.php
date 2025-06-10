<?php

/**
 * The file is part of the "webifycms/ext-user", WebifyCMS extension package.
 *
 * @see https://webifycms.com/extension/user
 *
 * @copyright Copyright (c) 2023 WebifyCMS
 * @license https://webifycms.com/extension/user/license
 * @author Mohammed Shifreen <mshifreen@gmail.com>
 */
declare(strict_types=1);

namespace Webify\User\Infrastructure\Presentation\Web\Controller;

use Webify\Base\Infrastructure\Presentation\Web\Controller\WebController;
use Webify\User\Domain\UserExtensionInterface;

/**
 * Base controller class for this extension, it helps to set templates path and template theme support.
 */
class BaseController extends WebController
{
	public function init(): void
	{
		$this->layout = UserExtensionInterface::TEMPLATES_PATH . '/layouts/main.php';

		$this->setViewPath(UserExtensionInterface::TEMPLATES_PATH);
		$this->addThemeSupport(
			[
				$this->getViewPath() => '@Theme/templates/admin/user',
			]
		);
		parent::init();
	}
}
