<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'tbl_product';
    protected $primaryKey = 'product_id';
    protected $guarded = []; 
    
    public function brand() {
        return $this->belongsTo('App\Brand', 'brand_id', 'brand_id');
    }
    
    public function Category() {
        return $this->belongsTo('App\Category', 'category_id', 'category_id');
    }
}
