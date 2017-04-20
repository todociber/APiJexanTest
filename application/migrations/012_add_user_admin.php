<?php

/**
 * Created by PhpStorm.
 * User: Todociber
 * Date: 18/04/2017
 * Time: 12:54 PM
 */
class Migration_add_user_admin extends CI_Migration
{
    public function up()
    {
        $typeUser = new TypesUser();
        $typeUser->fill([
            "type"=>"Administrator"
        ]);
        $typeUser->save();
        $typeUser = new TypesUser();
        $typeUser->fill([
            "type"=>"Seller"
        ]);
        $typeUser->save();

        $typePhone = new TypeOfPhone();
        $typePhone->fill([
            "type"=>"Seller"
        ]);
        $typePhone->save();
        $password = 'todociber';
        $hash = $this->bcrypt->hash_password($password);

        $NuevoUsuario = new User();
        $NuevoUsuario->fill([
            "id"=>1,
            "email"=>"alexlaley10@gmail.com",
            "password"=>$hash,
            "name"=>"Alexander Leonardo",
            "lastname"=>"Domínguez Pascacio",
            "reset_password_status"=>0,
            "type_user_id"=>1
        ]);
        $NuevoUsuario->save();

    }

    public function down()
    {

        $NuevoUsuario = User::find(1);
        $NuevoUsuario->forceDelete();
    }
}