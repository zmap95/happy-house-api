<?php

namespace App\Entities;

use Database\Factories\ContractFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Contract.
 *
 * @package namespace App\Entities;
 */
class Contract extends Model implements Transformable
{
    use  HasFactory, TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    protected static function newFactory()
    {
        return ContractFactory::new();
    }
}
