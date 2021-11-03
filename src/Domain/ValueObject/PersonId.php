<?php
declare(strict_types=1);

namespace OneCMS\User\Domain\ValueObject;

use OneCMS\Base\Domain\Service\IdentityServiceInterface;

/**
 * Class PersonId
 *
 * @package getonecms/user
 * @version 0.0.1
 * @since   0.0.1
 * @author  Mohammed Shifreen
 */
final class PersonId
{
    
    /**
     * @var string
     */
    private string $value;
    
    /**
     * PersonId constructor.
     *
     * @param IdentityServiceInterface $identityService
     */
    public function __construct(IdentityServiceInterface $identityService)
    {
        $this->value = (string) $identityService->getId();
    }
    
    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }
}
