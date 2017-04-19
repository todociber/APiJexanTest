<?php

/**
 * Created by PhpStorm.
 * User: Todociber
 * Date: 18/04/2017
 * Time: 11:28 AM
 */
class Migration_create_addresses extends CI_Migration
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
            "Address_line_one" => array(
                "type" => "VARCHAR",
                "constraint" => 100
            ),
            "Address_line_two" => array(
                "type" => "VARCHAR",
                "constraint" => 100
            ),
            "zipcodes_id" => array(
                'type' => 'int',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => FALSE,
            ),
            "users_id" => array(
                'type' => 'int',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => FALSE,
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
    $this->dbforge->add_field("CONSTRAINT FOREIGN KEY (zipcodes_id) REFERENCES zipcodes(ID)");

    $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (users_id) REFERENCES users(id)');

    $this->dbforge->add_key('id', TRUE);//establecemos id como primary_key
    $this->dbforge->create_table('addresses');//creamos la tabla users
}

    public function down()
    {
        //eliminamos la tabla users
        $this->dbforge->drop_table('addresses');

    }
}