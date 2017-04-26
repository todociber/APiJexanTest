<?php

/**
 * Created by PhpStorm.
 * User: Todociber
 * Date: 18/04/2017
 * Time: 11:35 AM
 */
class Migration_create_users_phones extends CI_Migration
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
                "number_phone" => array(
                    "type" => "VARCHAR",
                    "constraint" => 100
                ),
                "country_code" => array(
                    "type" => "VARCHAR",
                    "constraint" => 100
                ),
                "country_extension" => array(
                    "type" => "VARCHAR",
                    "constraint" => 100
                ),
                "users_id" => array(
                    'type' => 'int',
                    'constraint' => 100,
                    'unsigned' => TRUE,
                    'null' => FALSE,
                ),
                "type_of_phones_id" => array(
                    'type' => 'int',
                    'constraint' => 100,
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
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (users_id) REFERENCES users(id)');
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (type_of_phones_id) REFERENCES type_of_phones(id)');
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('users_phones');
    }

    public function down()
    {

        $this->dbforge->drop_table('users_phones');

    }
}