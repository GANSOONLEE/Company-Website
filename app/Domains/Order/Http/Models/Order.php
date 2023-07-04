<?php

namespace App\Domains\Order\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model{

    protected $table = 'order';

    /**
     *  primary key can't duplicated value
     */
    protected $primaryKey = 'orderID';

}