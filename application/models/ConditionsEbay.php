<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConditionsEbay extends Model {

    /**
     * Generated
     */
    use SoftDeletes;
    protected $table = 'conditions_ebay';
    protected $fillable = ['id', 'id_ebay', 'name', 'deleted_at'];
    protected $dates = ['deleted_at'];


    public function items() {
        return $this->hasMany(Item::class, 'conditions_id', 'id');
    }


}
