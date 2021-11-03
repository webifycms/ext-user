<?php

namespace OneCMS\User\Infrastructure\Persistance\Person;

use OneCMS\User\Domain\Model\Person\Person;
use OneCMS\User\Domain\Model\Person\PersonRepositoryInterface;

/**
 * Class PersonRepository
 *
 * @package getonecms/user
 * @version 0.0.1
 * @since   0.0.1
 * @author  Mohammed Shifreen
 */
final class PersonRepository implements PersonRepositoryInterface
{

    /**
     * @inheritDoc
     */
    public function persist(Person $person)
    {
        // TODO: Implement persist() method.
    }

    /**
     * @inheritDoc
     */
    public function trash(Person $person)
    {
        // TODO: Implement trash() method.
    }

    /**
     * @inheritDoc
     */
    public function restore(Person $person)
    {
        // TODO: Implement restore() method.
    }

    /**
     * @inheritDoc
     */
    public function delete(Person $person)
    {
        // TODO: Implement delete() method.
    }
}