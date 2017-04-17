<?php


use Illuminate\Database\Eloquent\Model as Eloquent;

class UsersModels extends Eloquent{
    protected $table = 'users';
    protected $fillable = ['id', 'email', 'username', 'password'];
    public $timestamps = false;
    public function usuariosTelephone() {
        return $this->hasMany(TelephoneModels::class, 'idUser', 'id');
    }

}