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

use Webify\Base\Infrastructure\Service\Register\Controllers\ControllerNamespaceRegisterService as AbstractControllerNamespaceRegisterService;

/**
 * The service class to register controller namespaces for the User extension.
 */
final class ControllerNamespaceRegisterService extends AbstractControllerNamespaceRegisterService
{
	public function getNamespaces(): array
	{
		return [
			'Webify\User\Infrastructure\Presentation\Web\Controller\Admin',
		];
	}
}
