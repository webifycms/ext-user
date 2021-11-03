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
     * @param Person $person
     * @return mixed
     */
    public function persist(Person $person);

    /**
     * Trash user.
     *
     * @param Person $person
     * @return mixed
     */
    public function trash(Person $person);

    /**
     * Restore user from trash.
     *
     * @param Person $person
     * @return void
     */
    public function restore(Person $person);

    /**
     * Delete user.
     * Note: This will permanently delete the user.
     *
     * @param Person $person
     * @return void
     */
    public function delete(Person $person);
}
