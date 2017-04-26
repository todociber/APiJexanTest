<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_users extends CI_Migration
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
                "email" => array(
                    "type" => "VARCHAR",
                    'unique' => TRUE,
                    "constraint" => 100
                ),
                "password"	=>		array(
                    "type"				=>		"VARCHAR",
                    "constraint"		=>		250,
                ),
                "name"	=>		array(
                    "type"				=>		"VARCHAR",
                    "constraint"		=>		100,
                ),
                "lastname"	=>		array(
                    "type"				=>		"VARCHAR",
                    "constraint"		=>		100,
                ),
                "reset_password_status"	=>		array(
                    "type"				=>		"BOOLEAN",
                    "default"           =>      0
                ),
                "type_user_id" => array(
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
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (type_user_id) REFERENCES types_users(id)');
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('users');
    }

    public function down()
    {

        $this->dbforge->drop_table('users');

    }
}