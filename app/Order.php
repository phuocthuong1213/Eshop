<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'tbl_order';
    protected $primaryKey = 'id';
    protected $guarded = []; 
    public function customer() {
        return $this->hasOne('App\Customer', 'customer_id', 'customer_id');
    }
    public function shipping() {
        return $this->hasOne('App\Sipping', 'shipping_id', 'shipping_id');
    }

    public function detailOrders() {
        return $this->hasMany('App\DetailOrder', 'order_id');
    }

    public function payment() {
        return $this->hasOne('App\Payment', 'payment_id', 'id');
    }
}
