<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Address extends Model {

    /**
     * Generated
     */
    use SoftDeletes;
    protected $table = 'addresses';
    protected $fillable = ['id', 'Address_line_one', 'Address_line_two', 'zipcodes_id', 'users_id', 'deleted_at'];
    protected $dates = ['deleted_at'];


    public function zipcode() {
        return $this->belongsTo(Zipcode::class, 'zipcodes_id', 'ID');
    }

    public function user() {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }


}
