<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class UsersPhone extends Model {

    /**
     * Generated
     */
    use SoftDeletes;
    protected $table = 'users_phones';
    protected $fillable = ['id', 'number_phone', 'users_id', 'type_of_phones_id', 'deleted_at'];
    protected $dates = ['deleted_at'];


    public function user() {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function typeOfPhone() {
        return $this->belongsTo(TypeOfPhone::class, 'type_of_phones_id', 'id');
    }


}
