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

namespace Webify\User\Test\Unit\Infrastructure\Extension;

use PHPUnit\Framework\Attributes\{CoversClass, CoversFunction, CoversMethod, Test};
use PHPUnit\Framework\TestCase;
use Webify\Base\Infrastructure\Contract\{ExtensionInterface, ServiceProviderInterface};
use Webify\User\Infrastructure\Extension\UserExtension;
use Webify\User\Infrastructure\Provider\UserService;

use function dirname;

/**
 * UserExtensionTest tests the extension entry point metadata.
 *
 * @internal
 */
#[CoversClass(UserExtension::class)]
#[CoversFunction('dirname')]
#[CoversMethod(UserExtension::class, 'getId')]
#[CoversMethod(UserExtension::class, 'getSlug')]
#[CoversMethod(UserExtension::class, 'getName')]
#[CoversMethod(UserExtension::class, 'getVersion')]
#[CoversMethod(UserExtension::class, 'getTemplatePath')]
#[CoversMethod(UserExtension::class, 'getProviders')]
#[CoversMethod(UserExtension::class, 'getAssetsProvider')]
final class UserExtensionTest extends TestCase
{
	/**
	 * @var UserExtension the user extension instance
	 */
	private UserExtension $extension;

	/**
	 * {@inheritdoc}
	 */
	protected function setUp(): void
	{
		$this->extension = new UserExtension();
	}

	/**
	 * The extension must satisfy the ext-base contract it is discovered through.
	 */
	#[Test]
	public function testImplementsExtensionInterface(): void
	{
		$this->assertInstanceOf(ExtensionInterface::class, $this->extension);
	}

	/**
	 * The id is the stable key the kernel discovers extensions by and resolves templates
	 * through, so it must not drift once anything depends on it.
	 *
	 * @see ExtensionInterface::getId()
	 */
	#[Test]
	public function testGetId(): void
	{
		$this->assertSame('webifycms-user', $this->extension->getId());
	}

	/**
	 * The slug is a URL-facing label rather than an identity, so it only mirrors the id here
	 * — nothing in ext-base keys a lookup off it.
	 *
	 * @see ExtensionInterface::getSlug()
	 */
	#[Test]
	public function testGetSlug(): void
	{
		$this->assertSame('webifycms-user', $this->extension->getSlug());
	}

	/**
	 * The display name is what a human reads in the admin, so it carries the package's full
	 * title rather than its machine name.
	 *
	 * @see ExtensionInterface::getName()
	 */
	#[Test]
	public function testGetName(): void
	{
		$this->assertSame('WebifyCMS User Extension', $this->extension->getName());
	}

	/**
	 * The version is a hand-maintained release marker, not a value derived from composer.json,
	 * so a release has to bump both in the same change.
	 *
	 * @see ExtensionInterface::getVersion()
	 */
	#[Test]
	public function testGetVersion(): void
	{
		$this->assertSame('0.2.0-beta', $this->extension->getVersion());
	}

	/**
	 * The extension lives in `src/Infrastructure/Extension`, so its root is three levels up
	 * and the templates directory sits beside `src`.
	 *
	 * @see ExtensionInterface::getTemplatePath()
	 */
	#[Test]
	public function testGetTemplatePathPointsAtThePackageTemplatesDirectory(): void
	{
		$path        = $this->extension->getTemplatePath()->toNative();
		$packageRoot = dirname(__DIR__, 4);

		$this->assertSame(
			$packageRoot . DIRECTORY_SEPARATOR . 'templates',
			$path,
			'the template path must resolve to <package root>/templates'
		);
		$this->assertDirectoryExists($path);
	}

	/**
	 * The three contexts each contribute definitions, so the extension yields the one
	 * provider that gathers them.
	 *
	 * @see ExtensionInterface::getProviders()
	 */
	#[Test]
	public function testGetProvidersYieldsTheContextProvider(): void
	{
		$providers = $this->extension->getProviders();

		$this->assertCount(1, $providers);
		$this->assertInstanceOf(UserService::class, $providers[0]);
	}

	/**
	 * Whatever is returned must be usable by the container, so guard the shape of the list.
	 *
	 * The contract admits either provider interface, and the container builder only
	 * registers definitions from the plain service provider — so that is the one the
	 * list is asserted against.
	 *
	 * @see ExtensionInterface::getProviders()
	 */
	#[Test]
	public function testGetProvidersOnlyYieldsServiceProviderInstances(): void
	{
		$this->assertContainsOnlyInstancesOf(
			ServiceProviderInterface::class,
			$this->extension->getProviders()
		);
	}

	/**
	 * The provider's definitions are what the container actually receives, so a
	 * provider that returned nothing would pass every test above while registering
	 * no definitions at all.
	 *
	 * Mirrors how the container builder consumes the list: only the plain service
	 * provider carries definitions, and a bootstrap provider is registered for its
	 * side effects instead.
	 *
	 * @see ExtensionInterface::getProviders()
	 */
	#[Test]
	public function testTheProvidersContributeDefinitions(): void
	{
		$definitions = [];

		foreach ($this->extension->getProviders() as $provider) {
			if (!$provider instanceof ServiceProviderInterface) {
				continue;
			}

			$definitions += $provider->getDefinitions();
		}

		$this->assertNotEmpty($definitions);
	}

	/**
	 * The extension ships no assets of its own — front-end assets come from the theme — so
	 * the contract's "nothing to publish" case is the correct answer here.
	 *
	 * @see ExtensionInterface::getAssetsProvider()
	 */
	#[Test]
	public function testGetAssetsProviderIsNull(): void
	{
		$this->assertNull($this->extension->getAssetsProvider());
	}
}
