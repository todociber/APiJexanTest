<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_category_ebay extends CI_Migration
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
                "id_ebay" => array(
                    "type" => "VARCHAR",
                    'unique' => TRUE,
                    "constraint" => 100
                ),
                "name_ebay" => array(
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
        $this->dbforge->create_table('category_ebay');
    }

    public function down()
    {
        //eliminamos la tabla users
        $this->dbforge->drop_table('category_ebay');

    }
}