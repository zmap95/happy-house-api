<?php

namespace App\Entities;

use Database\Factories\HouseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class House.
 *
 * @package namespace App\Entities;
 */
class House extends Model implements Transformable
{
    use  HasFactory, TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'category',
        'type',
        'address',
        'province_id',
        'district_id',
        'commune_id',
        'common_fee',
        'electricity_per_kwh',
        'water_per_block',
        'electricity_closing_date',
        'water_closing_date',
        'public_community_status',
        'status',
        'description',
        'user_id',
    ];

    protected static function newFactory()
    {
        return HouseFactory::new();
    }
}
