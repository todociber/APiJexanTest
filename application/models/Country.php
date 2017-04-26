<?php

use Illuminate\Database\Eloquent\Model;

class Country extends Model {

    /**
     * Generated
     */

    protected $table = 'countries';
    protected $fillable = ['id', 'name', 'code'];



    public function cities() {
        return $this->hasMany(City::class, 'country_id', 'id');
    }

    public function regions() {
        return $this->hasMany(Region::class, 'country_id', 'id');
    }


}
