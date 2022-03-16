<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class HouseAmenity.
 *
 * @package namespace App\Entities;
 */
class HouseAmenity extends Model implements Transformable
{
    use SoftDeletes, TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['house_id', 'name', 'icon', 'is_common'];
    protected $attributes = [
        'is_common' => 'common'
    ];

}
