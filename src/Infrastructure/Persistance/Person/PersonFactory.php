<?php
declare(strict_types=1);

namespace OneCMS\User\Infrastructure\Persistance\Person;

use OneCMS\Base\Domain\ValueObject\Uuid;
use OneCMS\Base\Infrastructure\Persistence\Service\DatabaseIdService;
use OneCMS\Base\Infrastructure\Service\Uuid\UuidService;
use OneCMS\User\Domain\Model\Person\Person;
use OneCMS\User\Domain\Model\Person\PersonFactoryInterface;
use OneCMS\User\Domain\Model\Person\PersonRequestInterface;
use OneCMS\User\Domain\ValueObject\PersonId;

/**
 * Class PersonFactory
 *
 * @package getonecms/user
 * @version 0.0.1
 * @since   0.0.1
 * @author  Mohammed Shifreen
 */
final class PersonFactory implements PersonFactoryInterface
{
    /**
     * @var DatabaseIdService
     */
    private DatabaseIdService $databaseIdService;
    private UuidService $uuidService;

    /**
     * @param DatabaseIdService $databaseIdService
     */
    public function __construct(DatabaseIdService $databaseIdService, UuidService $uuidService)
    {
        $this->databaseIdService = $databaseIdService;
        $this->uuidService = $uuidService;
    }

    /**
     * @inheritDoc
     */
    public function build(PersonRequestInterface $request): Person
    {
        return new Person(
            new PersonId($this->databaseIdService),
            new Uuid($this->uuidService),

        );
    }

    /**
     * @inheritDoc
     */
    public function buildFromState($state): Person
    {
        // TODO: Implement buildFromState() method.
    }
}