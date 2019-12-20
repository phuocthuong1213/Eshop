<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'tbl_payment';
    protected $primaryKey = 'id';
    protected $guarded = []; 
    public function order() {
        return $this->hasOne('App\Order', 'payment_id', 'id');
    }
}
