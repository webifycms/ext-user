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

use Webify\Base\Infrastructure\Service\Register\Translations\TranslationsRegisterService as AbstractTranslationsRegisterService;
use yii\i18n\PhpMessageSource;

/**
 * The service class to register translations for the User extension.
 */
final class TranslationsRegisterService extends AbstractTranslationsRegisterService
{
	public function getCategory(): string
	{
		return 'user';
	}

	/**
	 * @return array{
	 *     class: string,
	 *     sourceLanguage: string,
	 *     basePath: string
	 * }
	 */
	public function getConfigurations(): array
	{
		return [
			'class'          => PhpMessageSource::class,
			'sourceLanguage' => 'en-US',
			'basePath'       => '@User/resources/translations',
		];
	}
}
