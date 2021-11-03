<?php
declare(strict_types=1);

namespace OneCMS\User\Domain\ValueObject;

use OneCMS\Base\Domain\Service\IdenitityServiceInterface;

/**
 * Class AccountId
 *
 * @package getonecms/user
 * @version 0.0.1
 * @since   0.0.1
 * @author  Mohammed Shifreen
 */
final class AccountId
{
    /**
     * @var string
     */
    private string $value;

    /**
     * AccountId constructor.
     *
     * @param IdenitityServiceInterface $identity
     */
    public function __construct(IdenitityServiceInterface $identity)
    {
        $this->value = (string) $identity->getId();
    }

    /**
     * Get the value of value
     *
     * @return  string
     */
    public function getValue(): string
    {
        return $this->value;
    }
}
