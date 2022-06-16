<?php

declare(strict_types=1);

namespace OneCMS\User\Domain\Model\Person;

use OneCMS\Base\Domain\Service\Uuid\UuidServiceInterface;

/**
 * Class PersonId
 *
 * @package getonecms/ext-user
 * @version 0.0.1
 * @since   0.0.1
 * @author  Mohammed Shifreen
 */
final class PersonId
{
    /**
     * @var string
     */
    private readonly string $value;

    /**
     * PersonId constructor.
     *
     * @param UuidServiceInterface $uuidService
     */
    public function __construct(UuidServiceInterface $uuidService)
    {
        $this->value = $uuidService->toString();
    }

    /**
     * Returns the ID as string.
     *
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }
}
