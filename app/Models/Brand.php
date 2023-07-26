<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    /**
     *  Setup
     */

    protected $table = 'brand';
    protected $primaryKey = 'brandID';
    public $timestamps = false;

    /**
     *  Relationship
     */

    /**
     *  Function
     */

}
