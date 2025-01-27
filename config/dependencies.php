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

use Webify\User\Domain\Service\HashServiceInterface;
use Webify\User\Infrastructure\Service\Hash\HashService;
use yii\di\Container;

use function Webify\Base\Infrastructure\dependency;

/**
 * @var Container $container
 */
$container = dependency()->getContainer();

return [
	'definitions' => [
		HashServiceInterface::class => HashService::class,
	],
	'singletons' => [],
];
