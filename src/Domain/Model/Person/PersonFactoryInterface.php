<?php
declare(strict_types=1);

namespace OneCMS\User\Domain\Model\Person;

/**
 * Interface PersonFactoryInterface
 *
 * @package getonecms/user
 * @version 0.0.1
 * @since   0.0.1
 * @author  Mohammed Shifreen
 */
interface PersonFactoryInterface
{
    /**
     * @param mixed $request
     */
    public function build($request): Person;

//    /**
//     * @param mixed $state
//     * @return Person
//     */
//    public function buildFromState($state): Person;
}