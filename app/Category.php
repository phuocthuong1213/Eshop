<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Brand;

class Category extends Model
{
    protected $table = 'tbl_category';
    protected $primaryKey = 'category_id';
    protected $guarded = []; 
    
    public function brands() {
        return $this->hasMany('App\Brand', 'category_id', 'category_id');
    }

    public function products() {
        return $this->hasMany('App\Product', 'category_id', 'category_id');
    }
}
