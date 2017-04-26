<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryEbay extends Model {

    /**
     * Generated
     */
    use SoftDeletes;
    protected $table = 'category_ebay';
    protected $fillable = ['id', 'id_ebay', 'name_ebay', 'deleted_at'];
    protected $dates = ['deleted_at'];


    public function items() {
        return $this->hasMany(Item::class, 'category_ebay_id', 'id');
    }


}
