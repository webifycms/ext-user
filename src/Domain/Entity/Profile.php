<?php
declare(strict_types=1);

namespace OneCMS\User\Domain\Entity;

use OneCMS\User\Domain\ValueObject\PersonId;

/**
 * Class Profile
 *
 * @package getonecms/user
 * @version 0.0.1
 * @since   0.0.1
 * @author  Mohammed Shifreen
 */
final class Profile
{
    private PersonId $userId;

    private array $data;

    public function __construct(PersonId $userId, array $data)
    {
        $this->userId = $userId;
        $this->data = $data;
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
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public function set(string $name, $value = null): void
    {
        $this->data[$name] ?? $value;
    }

    /**
     * Get information
     *
     * @param string $name
     * @return mixed
     */
    public function get(string $name)
    {
        return $this->data[$name];
    }
}
