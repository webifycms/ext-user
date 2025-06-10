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

namespace Webify\User\Infrastructure\Presentation\Web\Controller\Admin;

use Webify\User\Infrastructure\Presentation\Web\Controller\BaseController;

final class UserController extends BaseController
{
	public function actionIndex(): string
	{
		return $this->render('user/index');
	}
}
