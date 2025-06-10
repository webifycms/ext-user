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

use Webify\User\Domain\Service\HashServiceInterface;
use Webify\User\Infrastructure\Service\Hash\HashService;

use function Webify\Base\Infrastructure\app;

return [
	'definitions' => [
		HashServiceInterface::class => fn () => new HashService(app()->getSecurity()),
	],
	'singletons' => [],
];
