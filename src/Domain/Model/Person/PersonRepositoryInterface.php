<?php
declare(strict_types=1);

namespace OneCMS\User\Domain\Model\Person;

/**
 * Class PersonRepositoryInterface
 *
 * @package getonecms/user
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
    public function persist(Person $person);

    /**
     * Trash user.
     *
     * @return mixed
     */
    public function trash(PersonId $personId);

    /**
     * Restore user from trash.
     *
     * @return void
     */
    public function restore(PersonId $personId);

    /**
     * Delete user.
     * Note: This will permanently delete the user.
     *
     * @return void
     */
    public function delete(PersonId $personId);
}
