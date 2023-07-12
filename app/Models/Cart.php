<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    /**
     *  Setup
     */

    protected $table = 'cart';
    protected $primaryKey = 'Email';
    protected $fillable = [
        'Email',
        'productCode',
        'productBrand',
        'quantity'
    ];
    public $timestamps = false;

    /**
     *  Relationship
    */

    public function user(){
        return $this->hasOne(User::class, 'Email');
    }

}
