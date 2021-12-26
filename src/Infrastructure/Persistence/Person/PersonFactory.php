<?php
declare(strict_types=1);

namespace OneCMS\User\Infrastructure\Persistence\Person;

use OneCMS\Base\Domain\ValueObject\Timestamp;
use OneCMS\Base\Domain\ValueObject\Uuid;
use OneCMS\User\Application\Request\Person\CreatePersonRequest;
use OneCMS\User\Domain\Model\Person\Person;
use OneCMS\User\Domain\Model\Person\PersonFactoryInterface;
use OneCMS\User\Domain\Model\Person\PersonId;
use OneCMS\Base\Domain\Service\IdentityServiceInterface;
use OneCMS\Base\Domain\Service\UuidServiceInterface;

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
     * @var IdentityServiceInterface
     */
    private IdentityServiceInterface $identityService;
    /**
     * @var UuidServiceInterface
     */
    private UuidServiceInterface $uuidService;

    /**
     * @param IdentityServiceInterface $identityService
     * @param UuidServiceInterface $uuidService
     */
    public function __construct(IdentityServiceInterface $identityService, UuidServiceInterface $uuidService)
    {
        $this->identityService = $identityService;
        $this->uuidService = $uuidService;
    }

    /**
     * @param CreatePersonRequest $request
     * @return Person
     */
    public function build($request): Person
    {
        return new Person(
            new PersonId($this->identityService),
            new Uuid($this->uuidService),
            $request->getFirstName(),
            $request->getLastName(),
            new Timestamp()
        );
    }
}
