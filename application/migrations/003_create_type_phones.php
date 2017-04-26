<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_type_phones extends CI_Migration
{
    public function up()
    {

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

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('type_of_phones');
    }

    public function down()
    {

        $this->dbforge->drop_table('type_of_phones');

    }
}