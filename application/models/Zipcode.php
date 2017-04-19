<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Zipcode extends Model {

    /**
     * Generated
     */
    use SoftDeletes;
    protected $table = 'zipcodes';
    protected $fillable = ['ID', 'ZIP', 'City', 'State', 'County', 'Type'];
    protected $dates = ['deleted_at'];


    public function users() {
        return $this->belongsToMany(User::class, 'addresses', 'zipcodes_id', 'users_id');
    }

    public function addresses() {
        return $this->hasMany(Address::class, 'zipcodes_id', 'ID');
    }

    public function items() {
        return $this->hasMany(Item::class, 'zipcodes_id', 'ID');
    }


}
