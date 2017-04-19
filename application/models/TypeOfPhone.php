<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class TypeOfPhone extends Model {

    /**
     * Generated
     */
    use SoftDeletes;
    protected $table = 'type_of_phones';
    protected $fillable = ['id', 'type', 'deleted_at'];
    protected $dates = ['deleted_at'];


    public function users() {
        return $this->belongsToMany(User::class, 'users_phones', 'type_of_phones_id', 'users_id');
    }

    public function usersPhones() {
        return $this->hasMany(UsersPhone::class, 'type_of_phones_id', 'id');
    }


}
