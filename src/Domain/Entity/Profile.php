<?php
declare(strict_types=1);

namespace Webify\User\Domain\Entity;

use Webify\User\Domain\ValueObject\PersonId;

/**
 * Class Profile
 *
 * @package webifycms/user
 * @version 0.0.1
 * @since   0.0.1
 * @author  Mohammed Shifreen
 */
final class Profile
{
    public function __construct(private readonly PersonId $userId, private readonly array $data)
    {
    }

    /**
     * Get the value of userId
     *
     * @return  PersonId
     */
    public function getUserId(): PersonId
    {
        return $this->userId;
    }

    /**
     * Set information
     *
     * @param mixed $value
     */
    public function set(string $name, $value = null): void
    {
        $this->data[$name] ?? $value;
    }

    /**
     * Get information
     *
     * @return mixed
     */
    public function get(string $name)
    {
        return $this->data[$name];
    }
}
