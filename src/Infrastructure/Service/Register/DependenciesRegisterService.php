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

use Webify\Base\Infrastructure\Service\Register\Dependencies\DependenciesRegisterService as AbstractDependenciesRegisterService;

use function Webify\Base\Infrastructure\get_alias;

/**
 * The service class to register dependencies for the User extension.
 */
final class DependenciesRegisterService extends AbstractDependenciesRegisterService
{
	/**
	 * @return array<string, mixed>
	 */
	public function getDependencies(): array
	{
		return require get_alias('@User/config/dependencies.php');
	}
}
