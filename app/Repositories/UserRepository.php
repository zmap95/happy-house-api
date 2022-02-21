<?php

namespace App\Repositories;

/**
 * Interface UserRepository.
 *
 * @package namespace App\Repositories;
 */
interface UserRepository extends BaseRepository
{
    public function findByPhoneOrEmail(string $phoneOrEmail);
}
