<?php
declare(strict_types=1);

namespace OneCMS\User\Application\Action\Person;

use OneCMS\User\Application\Request\Person\CreatePersonRequest;
use OneCMS\User\Domain\Model\Person\PersonFactoryInterface;
use OneCMS\User\Infrastructure\Persistance\Person\PersonRepository;

/**
 * Class ActionPersonCreate
 *
 * @package getonecms/user
 * @version 0.0.1
 * @since   0.0.1
 * @author  Mohammed Shifreen
 */
final class CreatePersonAction
{
    /**
     * @param CreatePersonRequest $request
     * @param PersonFactoryInterface $factory
     * @param PersonRepository $repository
     */
    public function __construct(private readonly CreatePersonRequest    $request, private readonly PersonFactoryInterface $factory, private readonly PersonRepository       $repository)
    {
    }

    /**
     * Execute the action.
     */
    public function execute()
    {
        $entity = $this->factory->build($this->request);

        $this->repository->persist($entity);
    }
}
