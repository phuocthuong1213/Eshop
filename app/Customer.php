<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'tbl_customer';
    protected $primaryKey = 'customer_id';
    protected $guarded = []; 

    public function orders() {                             #Khóa chính của bảng customer
        return $this->belongsToMany('App\Order', 'customer_id', 'customer_id');
                                    #Khóa ngoại của bảng order
    }
}
