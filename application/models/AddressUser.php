<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AddressUser extends Model {

    /**
     * Generated
     */
    use SoftDeletes;
    protected $table = 'address_user';
    protected $fillable = ['id', 'Address_line_one', 'Address_line_two', 'zipcode', 'city_id', 'users_id', 'deleted_at'];
    protected $dates = ['deleted_at'];


    public function city() {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }


}
