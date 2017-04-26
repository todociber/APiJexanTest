<?php

use Illuminate\Database\Eloquent\Model;

class Region extends Model {

    /**
     * Generated
     */

    protected $table = 'regions';
    protected $fillable = ['id', 'name', 'code', 'country_id'];



    public function country() {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function cities() {
        return $this->hasMany(City::class, 'region_id', 'id');
    }


}
