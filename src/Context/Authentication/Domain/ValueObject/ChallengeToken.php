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

namespace Webify\User\Context\Authentication\Domain\ValueObject;

use Webify\Base\Domain\Exception\SecureTokenGenerationFailedException;
use Webify\Base\Domain\ValueObject\SecureToken;
use Webify\User\Context\Authentication\Domain\Exception\{ChallengeTokenGenerationFailedException, InvalidChallengeTokenException};

/**
 * Challenge token value object.
 *
 * Represents a secure token used for authentication challenges.
 */
final readonly class ChallengeToken extends SecureToken implements ChallengeSecretInterface
{
	/**
	 * Overrides the parent method to handle the exception to make a domain-specific one.
	 *
	 * @throws ChallengeTokenGenerationFailedException
	 */
	public static function generate(): static
	{
		try {
			return parent::generate();
		} catch (SecureTokenGenerationFailedException $exception) {
			throw ChallengeTokenGenerationFailedException::create($exception);
		}
	}

	/**
	 * Throws an exception for an invalid challenge token.
	 */
	public function throwException(string $value): never
	{
		throw InvalidChallengeTokenException::forInvalidToken($value);
	}

	/**
	 * {@inheritDoc}
	 */
	public function verify(ChallengeSecretInterface $secret): bool
	{
		if (!$secret instanceof self) {
			return false;
		}

		return $this->equals($secret);
	}
}
