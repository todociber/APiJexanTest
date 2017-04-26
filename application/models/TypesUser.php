<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypesUser extends Model {

    /**
     * Generated
     */
    use SoftDeletes;
    protected $table = 'types_users';
    protected $fillable = ['id', 'type', 'deleted_at'];
    protected $dates = ['deleted_at'];


    public function users() {
        return $this->hasMany(User::class, 'type_user_id', 'id');
    }


}
