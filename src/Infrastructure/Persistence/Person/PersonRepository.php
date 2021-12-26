<?php

namespace OneCMS\User\Infrastructure\Persistence\Person;

use OneCMS\User\Domain\Model\Person\Person;
use OneCMS\User\Domain\Model\Person\PersonId;
use OneCMS\User\Domain\Model\Person\PersonRepositoryInterface;
use OneCMS\User\Infrastructure\Persistance\Person\Person as PersonModel;

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
    private PersonModel $model;

    public function __construct(PersonModel $model)
    {
        $this->model = $model;
    }

    /**
     * @inheritDoc
     */
    public function persist(Person $person): bool
    {
        $this->model->setEntity($person);

        return $this->model->save(false);
    }

    /**
     * @inheritDoc
     */
    public function trash(PersonId $personId)
    {
        return $this->model->save(false);
    }

    /**
     * @inheritDoc
     */
    public function restore(PersonId $personId)
    {
        return $this->model->save(false);
    }

    /**
     * @inheritDoc
     */
    public function delete(PersonId $personId)
    {
        return $this->model->delete();
    }
}
