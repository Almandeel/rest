<?php

namespace Modules\Restaurant\Models;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fees', 'name', 'phone', 'address', 'customer_id', 'order_id', 'driver_id'
    ];
}
