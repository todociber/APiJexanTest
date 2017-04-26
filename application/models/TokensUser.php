<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TokensUser extends Model {

    /**
     * Generated
     */
    use SoftDeletes;
    protected $table = 'tokens_users';
    protected $fillable = ['id', 'token', 'users_id', 'deleted_at'];
    protected $dates = ['deleted_at'];


    public function user() {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }


}
