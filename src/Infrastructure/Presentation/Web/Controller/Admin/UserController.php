<?php

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
