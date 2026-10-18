<?php

/**
 * The file is part of the "webifycms/ext-user", WebifyCMS extension package.
 *
 * @see https://webifycms.com/extension/user
 *
 * @copyright Copyright (c) 2023 - Present WebifyCMS
 * @license https://webifycms.com/license
 * @author Mohammed Shifreen <mshifreen@gmail.com>
 */
declare(strict_types=1);

namespace Webify\User\Infrastructure\Extension;

use Webify\Base\Domain\ValueObject\TemplatePath;
use Webify\Base\Infrastructure\Contract\{AssetsProviderInterface, ExtensionInterface};
use Webify\User\Infrastructure\Provider\UserService;

/**
 * The user extension.
 */
final readonly class UserExtension implements ExtensionInterface
{
	/**
	 * @var string the root path of the extension
	 */
	private string $rootPath;

	/**
	 * The constructor.
	 */
	public function __construct()
	{
		$this->rootPath = dirname(__DIR__, 3);
	}

	/**
	 * {@inheritDoc}
	 */
	public function getId(): string
	{
		return 'webifycms-user';
	}

	/**
	 * {@inheritDoc}
	 */
	public function getName(): string
	{
		return 'WebifyCMS User Extension';
	}

	/**
	 * {@inheritDoc}
	 */
	public function getProviders(): array
	{
		return [
			new UserService(),
		];
	}

	/**
	 * {@inheritDoc}
	 */
	public function getVersion(): string
	{
		return '0.2.0-beta';
	}

	/**
	 * {@inheritDoc}
	 */
	public function getSlug(): string
	{
		return 'webifycms-user';
	}

	/**
	 * {@inheritDoc}
	 */
	public function getTemplatePath(): TemplatePath
	{
		return TemplatePath::fromString($this->rootPath . DIRECTORY_SEPARATOR . 'templates');
	}

	/**
	 * {@inheritDoc}
	 */
	public function getAssetsProvider(): ?AssetsProviderInterface
	{
		return null;
	}
}
