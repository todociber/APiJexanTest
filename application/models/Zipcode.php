<?php

use Illuminate\Database\Eloquent\Model;

class Zipcode extends Model {

    /**
     * Generated
     */

    protected $table = 'zipcodes';
    protected $fillable = ['ID', 'ZIP', 'City', 'State', 'County', 'Type'];



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
