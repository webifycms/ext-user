<?php

namespace Webify\User\Infrastructure\Persistence\Person\Repository;

use DateTimeInterface;
use Webify\User\Application\Person\Repository\PersonRepositoryInterface;
use Webify\User\Domain\Model\Person\Person;
use Webify\User\Infrastructure\Persistence\Person\Model\PersonModel;

/**
 * Class PersonRepository
 *
 * @package webifycms/user
 * @version 0.0.1
 * @since   0.0.1
 * @author  Mohammed Shifreen
 */
final class PersonRepository implements PersonRepositoryInterface
{
    /**
     * @param ?integer $id The id used to identify internally.
     */
    public function __construct(
        private readonly ?int $id = null
    ) {
    }

    /**
     * @inheritDoc
     */
    public function persist(Person $person): bool
    {
        $model = new PersonModel();

        if ($this->id !== null) {
            // $model should be fetched from db 
        }

        $model->uuid = $person->getId();
        $model->first_name = $person->getFirstName();
        $model->last_name = $person->getLastName();
        $model->created_at = $person->getTimestamp()->getCreatedAt()->format(PersonModel::DEFAULT_DATETIME_FORMAT);
        $model->updated_at = $person->getTimestamp()->getUpdatedAt()->format(PersonModel::DEFAULT_DATETIME_FORMAT);
        $model->trashed_at = $person->getRecycle()->getTrashedAt() instanceof DateTimeInterface ?
            $person->getRecycle()->getTrashedAt()->format(PersonModel::DEFAULT_DATETIME_FORMAT) : null;

        return $model->save(false);
    }

    /**
     * @inheritDoc
     */
    public function trash(Person $person): bool
    {
        return $this->model->save(false);
    }

    /**
     * @inheritDoc
     */
    public function restore(Person $person): bool
    {
        return $this->model->save(false);
    }

    /**
     * @inheritDoc
     */
    public function delete(Person $person): bool
    {
        return $this->model->delete();
    }
}
