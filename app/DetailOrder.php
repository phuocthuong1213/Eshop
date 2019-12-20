<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailOrder extends Model
{
    protected $table = 'tbl_order_detail';
    protected $primaryKey = 'id';
    protected $guarded = []; 
    public function order() {
        return $this->belongsTo('App\Order', 'order_id', 'id');
    }
}
