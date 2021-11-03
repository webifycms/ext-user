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
    private CreatePersonRequest $request;
    private PersonFactoryInterface $factory;
    private PersonRepository $repository;

    /**
     * @param CreatePersonRequest $request
     * @param PersonFactoryInterface $factory
     * @param PersonRepository $repository
     */
    public function __construct(
        CreatePersonRequest    $request,
        PersonFactoryInterface $factory,
        PersonRepository       $repository
    )
    {
        $this->request = $request;
        $this->factory = $factory;
        $this->repository = $repository;
    }

    /**
     * Execute the creation action.
     */
    public function execute()
    {
        $entity = $this->factory->build($this->request);
    }
}