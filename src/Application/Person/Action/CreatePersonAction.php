<?php

declare(strict_types=1);

namespace Webify\User\Application\Person\Action;

use Webify\Base\Domain\Service\Uuid\UuidServiceInterface;
use Webify\User\Application\Person\Request\CreatePersonRequest;
use Webify\User\Application\Person\Factory\PersonFactory;
use Webify\User\Application\Person\Repository\PersonRepositoryInterface;

/**
 * Class CreatePersonAction
 *
 * @package webifycms/user
 * @version 0.0.1
 * @since   0.0.1
 * @author  Mohammed Shifreen
 */
final class CreatePersonAction
{
    /**
     * The constructor
     *
     * @param PersonRepositoryInterface $repository
     * @param UuidServiceInterface $uuidService
     */
    public function __construct(
        private readonly PersonRepositoryInterface $repository,
        private readonly UuidServiceInterface $uuidService
    ) {
    }

    /**
     * Execute the action.
     */
    public function execute(CreatePersonRequest $request)
    {
        $entity = (new PersonFactory($this->uuidService))->build([
            'firstName' => $request->getFirstName(),
            'lastName' => $request->getLastName()
        ]);

        $this->repository->persist($entity);
    }
}
