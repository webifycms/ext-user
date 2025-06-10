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

namespace Webify\User\Infrastructure\Service\Register;

use Webify\Base\Infrastructure\Service\Register\Routes\AdminRoutesRegisterServiceInterface;
use Webify\Base\Infrastructure\Service\Register\Routes\RoutesRegisterService;

use function Webify\Base\Infrastructure\get_alias;

/**
 * The service class to register admin routes for the User extension.
 */
final class AdminRoutesRegisterService extends RoutesRegisterService implements AdminRoutesRegisterServiceInterface
{
	public function getRoutes(): array
	{
		return require get_alias('@User/config/admin/routes.php');
	}
}
