<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'tbl_brand';
    protected $primaryKey = 'brand_id';
    protected $guarded = [];   

    public function category() {
        return $this->belongsTo('App\Category', 'category_id', 'category_id');
    }

    public function products() {             #Khóa ngoại  #Khóa chính            
        return $this->hasMany('App\Product', 'brand_id', 'brand_id');
    }   
}
