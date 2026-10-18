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

namespace Webify\User\Context\Authentication\Domain\Repository;

use Webify\User\Context\Authentication\Domain\Entity\Challenge;
use Webify\User\Context\Authentication\Domain\Exception\ChallengeNotFoundException;
use Webify\User\Context\Authentication\Domain\ValueObject\ChallengeId;
use Webify\User\Domain\ValueObject\UserId;

/**
 * ChallengeRepositoryInterface defines the contract for an authentication challenge repository.
 */
interface ChallengeRepositoryInterface
{
	/**
	 * Get an authentication challenge by its ID.
	 *
	 * @throws ChallengeNotFoundException if the challenge with the given ID is not found
	 */
	public function getById(ChallengeId $id): Challenge;

	/**
	 * Get an authentication challenge by its user ID.
	 *
	 * @throws ChallengeNotFoundException if the challenge with the given user ID is not found
	 */
	public function getByUser(UserId $userId): Challenge;

	/**
	 * Persists the given authentication challenge object to the data store.
	 */
	public function persist(Challenge $challenge): void;

	/**
	 * Removes the specified authentication challenge from the data store.
	 */
	public function delete(Challenge $challenge): void;

	/**
	 * Removes all stale authentication challenges (expired and verified) for the specified user.
	 */
	public function deleteStale(UserId $userId): void;
}
