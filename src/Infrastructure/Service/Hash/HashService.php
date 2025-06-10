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

namespace Webify\User\Infrastructure\Service\Hash;

use Webify\Base\Domain\Exception\TranslatableRuntimeException;
use Webify\User\Domain\Service\HashServiceInterface;
use yii\base\Exception;
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

	/**
	 * @throws TranslatableRuntimeException
	 */
	public function generateHash(string $string): string
	{
		try {
			return $this->securityComponent->generatePasswordHash($string);
		} catch (Exception $e) {
			throw new TranslatableRuntimeException(
				'unable_to_generate_hash',
				['string' => $string],
				$e->getCode(),
				$e
			);
		}
	}

	public function validatesHash(string $string, string $hash): bool
	{
		return $this->securityComponent->validatePassword($string, $hash);
	}
}
