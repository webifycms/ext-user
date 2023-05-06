<?php

declare(strict_types=1);

namespace Webify\User\Application\Person\Repository;

use Webify\User\Domain\Model\Person\Person;

/**
 * Class PersonRepositoryInterface
 *
 * @package webifycms/user
 * @version 0.0.1
 * @since   0.0.1
 * @author  Mohammed Shifreen
 */
interface PersonRepositoryInterface
{
    /**
     * Persist user.
     *
     * @return mixed
     */
    public function persist(Person $person): bool;

    /**
     * Trash user.
     *
     * @return mixed
     */
    public function trash(Person $person): bool;

    /**
     * Restore user from trash.
     *
     * @return void
     */
    public function restore(Person $person): bool;

    /**
     * Permanently delete the user.
     *
     * @return void
     */
    public function delete(Person $person): bool;
}
