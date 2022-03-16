<?php

namespace App\Entities;

use App\Services\UploadService;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Room.
 *
 * @package namespace App\Entities;
 */
class Room extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    protected $attributes = [
      'status' => 'active'
    ];
    protected $dateFormat = 'Y-m-d H:i:s';

    public function roomAmenities() {
        return $this->hasMany(RoomAmenity::class);
    }

    public function roomPictures() {
        return $this->hasMany(RoomPicture::class);
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($room) { // before delete() method call this
            $room->roomAmenities()->delete();
            $room->roomPictures()->delete();
            $uploadService = app(UploadService::class);
            $uploadService->deleteDirectory('room-' . $room->id);
        });
    }
}
