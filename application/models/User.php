<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class User extends Model {

    /**
     * Generated
     */
    use SoftDeletes;
    protected $table = 'users';
    protected $fillable = ['id', 'email', 'password', 'name', 'lastname', 'reset_password_status','type_user_id', 'deleted_at'];
    protected $dates = ['deleted_at'];


    public function zipcodes() {
        return $this->belongsToMany(Zipcode::class, 'addresses', 'users_id', 'zipcodes_id');
    }

    public function typeOfPhones() {
        return $this->belongsToMany(TypeOfPhone::class, 'users_phones', 'users_id', 'type_of_phones_id');
    }

    public function addresses() {
        return $this->hasMany(Address::class, 'users_id', 'id');
    }

    public function profilesEbays() {
        return $this->hasMany(ProfilesEbay::class, 'users_id', 'id');
    }

    public function usersPhones() {
        return $this->hasMany(UsersPhone::class, 'users_id', 'id');
    }
    public function typesUser() {
        return $this->belongsTo(TypesUser::class, 'type_user_id', 'id');
    }

    public function tokensUsers() {
        return $this->hasMany(TokensUser::class, 'users_id', 'id');
    }

}
