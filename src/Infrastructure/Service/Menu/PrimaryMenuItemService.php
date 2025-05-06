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

namespace Webify\User\Infrastructure\Service\Menu;

use Webify\Admin\Infrastructure\Service\Menu\PrimaryMenuItemServiceInterface;

use function Webify\Base\Infrastructure\administration_url;
use function Webify\Base\Infrastructure\url;

/**
 * Service class to register primary menu items for the user extension.
 */
final class PrimaryMenuItemService implements PrimaryMenuItemServiceInterface
{
	public function __construct(private readonly string $assetsBaseUrl) {}

	/**
	 * {@inheritDoc}
	 *
	 * TODO: Currently the Menu widget does not support img tag for icon, should replaced when the request is merged.
	 */
	public function items(): array
	{
		return [
			[
				'label'     => sprintf(
					'<img src="%s" alt="%s"><div>User Management</div>',
					url($this->assetsBaseUrl . '/icons/user.svg'),
					'User Management'
				),
				'encode'    => false,
				'link'      => administration_url('user/index'),
				'position'  => 3,
			],
		];
	}
}
