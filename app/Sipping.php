<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sipping extends Model
{
    protected $table = 'tbl_shipping';
    protected $primaryKey = 'shipping_id';
    protected $guarded = []; 
    public function order() {
        return $this->hasOne('App\Order', 'shipping_id', 'shipping_id');
    }
}
