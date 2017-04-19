<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_type_phones extends CI_Migration
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
                "type" => array(
                    "type" => "VARCHAR",
                    "constraint" => 100
                ),
                "created_at"	=>		array(
                    "type"				=>		"TIMESTAMP",
                ),
                "updated_at"	=>		array(
                    "type"				=>		"TIMESTAMP",
                ),
                "deleted_at"	=>		array(
                    "type"				=>		"TIMESTAMP",
                    'null'              =>      TRUE,
                ),


            )
        );

        $this->dbforge->add_key('id', TRUE);//establecemos id como primary_key
        $this->dbforge->create_table('type_of_phones');//creamos la tabla users
    }

    public function down()
    {
        //eliminamos la tabla users
        $this->dbforge->drop_table('type_of_phones');

    }
}