<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentmethodsEbay extends Model {

    /**
     * Generated
     */
    use SoftDeletes;
    protected $table = 'paymentMethods_ebay';
    protected $fillable = ['id', 'name_method', 'deleted_at'];
    protected $dates = ['deleted_at'];


    public function items() {
        return $this->hasMany(Item::class, 'paymentMethods_ebay_id', 'id');
    }


}
