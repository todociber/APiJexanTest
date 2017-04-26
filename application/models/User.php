<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model {

    /**
     * Generated
     */
    use SoftDeletes;
    protected $table = 'users';
    protected $fillable = ['id', 'email', 'password', 'name', 'lastname', 'reset_password_status', 'type_user_id', 'deleted_at'];
    protected $dates = ['deleted_at'];


    public function typesUser() {
        return $this->belongsTo(TypesUser::class, 'type_user_id', 'id');
    }

    public function cities() {
        return $this->belongsToMany(City::class, 'address_user', 'users_id', 'city_id');
    }

    public function addressUsers() {
        return $this->hasMany(AddressUser::class, 'users_id', 'id');
    }

    public function profilesEbays() {
        return $this->hasMany(ProfilesEbay::class, 'users_id', 'id');
    }

    public function tokensUsers() {
        return $this->hasMany(TokensUser::class, 'users_id', 'id');
    }

    public function usersPhones() {
        return $this->hasMany(UsersPhone::class, 'users_id', 'id');
    }




}
