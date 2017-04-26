<?php

use Illuminate\Database\Eloquent\Model;

class City extends Model {

    /**
     * Generated
     */

    protected $table = 'cities';
    protected $fillable = ['id', 'region_id', 'country_id', 'latitude', 'longitude', 'name'];



    public function country() {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function region() {
        return $this->belongsTo(Region::class, 'region_id', 'id');
    }

    public function users() {
        return $this->belongsToMany(User::class, 'address_user', 'city_id', 'users_id');
    }

    public function addressUsers() {
        return $this->hasMany(AddressUser::class, 'city_id', 'id');
    }


}
