<?php

namespace App\Entities;

use Database\Factories\HouseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class House.
 *
 * @package namespace App\Entities;
 */
class House extends Model implements Transformable
{
    use  HasFactory, TransformableTrait, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'category_id',
        'type_id',
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

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function commune()
    {
        return $this->belongsTo(Commune::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function type()
    {
        return $this->belongsTo(HouseType::class);
    }

    public function category()
    {
        return $this->belongsTo(HouseCategory::class);
    }

    public function amenities() {
        return $this->hasMany(HouseAmenity::class);
    }

    public function rules() {
        return $this->hasMany(HouseRule::class);
    }
}
