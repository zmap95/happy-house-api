<?php

namespace App\Repositories;

use App\Entities\Room;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface RoomAmenityRepository.
 *
 * @package namespace App\Repositories;
 */
interface RoomAmenityRepository extends RepositoryInterface
{
    public function findIdAmenityByRoom(int $roomId);
}
