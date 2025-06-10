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

namespace Webify\User\Infrastructure\Service\Administration;

use Webify\Base\Infrastructure\Service\Administration\PrimaryMenuItemsAdministrationServiceInterface;

use function Webify\Base\Infrastructure\administration_url;
use function Webify\Base\Infrastructure\url;

final class PrimaryMenuItemsAdministrationService implements PrimaryMenuItemsAdministrationServiceInterface
{
	public function __construct(private readonly string $assetsUrl) {}

	/**
	 * {@inheritDoc}
	 *
	 * TODO: Currently the Menu widget does not support img tag for icon, should replaced when the request is merged.
	 */
	public function getItems(): array
	{
		return [
			[
				'label'     => sprintf(
					'<img src="%s" alt="%s"><div>User Management</div>',
					url($this->assetsUrl . '/icons/user.svg'),
					'User Management'
				),
				'encode'    => false,
				'link'      => administration_url('user/index'),
				'position'  => 3,
			],
		];
	}
}
