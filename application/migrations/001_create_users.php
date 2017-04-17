<?php

/**
 * Created by PhpStorm.
 * User: Todociber
 * Date: 16/04/2017
 * Time: 12:17 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_users extends CI_Migration
{

    public function up()
    {
        //creamos la estructura de una tabla con un
        //id autoincremental, un campo varchar para el username
        //y otro para el passwords también varchar
        $this->dbforge->add_field(
            array(
                "id"		=>		array(
                    "type"				=>		"INT",
                    "constraint"		=>		11,
                    "unsigned"			=>		TRUE,
                    "auto_increment"	=>		TRUE,

                ),
                "email" => array(
                  "type" => "VARCHAR",
                    'unique' => TRUE,
                    "constraint" => 100
                ),
                "username"	=>		array(
                    "type"				=>		"VARCHAR",
                    "constraint"		=>		100,
                ),
                "password"	=>		array(
                    "type"				=>		"VARCHAR",
                    "constraint"		=>		250,
                ),
            )
        );

        $this->dbforge->add_key('id', TRUE);//establecemos id como primary_key
        $this->dbforge->create_table('users');//creamos la tabla users
    }

    public function down()
    {
        //eliminamos la tabla users
        $this->dbforge->drop_table('users');

    }
}