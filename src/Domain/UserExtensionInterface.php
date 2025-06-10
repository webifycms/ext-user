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

namespace Webify\User\Domain;

use Webify\Base\Domain\ExtensionInterface;

interface UserExtensionInterface extends ExtensionInterface
{
	/**
	 * The extension name.
	 */
	public const NAME = 'User';

	/**
	 * The extension version.
	 */
	public const VERSION = '0.0.1';

	/**
	 * The extension templates path.
	 */
	public const TEMPLATES_PATH = '@User/templates';

	/**
	 * The extension assets path.
	 */
	public const ASSETS_PATH = '@User/resources/assets';
}
