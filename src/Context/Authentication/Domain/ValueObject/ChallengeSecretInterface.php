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

/**
 * The challenge secret interface.
 */
interface ChallengeSecretInterface
{
	/**
	 * Verifies the challenge provided by the user against the stored challenge.
	 */
	public function verify(self $secret): bool;
}
