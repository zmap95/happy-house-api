<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class PriceListCollection.
 *
 * @package namespace App\Entities;
 */
class PriceList extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'price_list';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'fee_category_id',
        'unit_price'
    ];

}
