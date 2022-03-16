<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface RoomPictureRepository.
 *
 * @package namespace App\Repositories;
 */
interface RoomPictureRepository extends RepositoryInterface
{
    public function findPictureByRoom(int $roomId);
}
