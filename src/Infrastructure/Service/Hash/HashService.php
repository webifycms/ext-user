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

namespace Webify\User\Infrastructure\Service\Hash;

use Webify\User\Domain\Service\HashServiceInterface;
use yii\base\Security;

/**
 * Hash service implementation that depends on Yii framework security component.
 */
final class HashService implements HashServiceInterface
{
	/**
	 * The object constructor.
	 */
	public function __construct(private readonly Security $securityComponent) {}

	public function generateHash(string $string): string
	{
		return $this->securityComponent->generatePasswordHash($string);
	}

	public function validatesHash(string $string, string $hash): bool
	{
		return $this->securityComponent->validatePassword($string, $hash);
	}
}
