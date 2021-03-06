<?php

/**
 * Created by PhpStorm.
 * User: Todociber
 * Date: 18/04/2017
 * Time: 11:06 PM
 */
class Migration_create_tokens extends CI_Migration
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
                "token" => array(
                    "type" => "VARCHAR",
                    "constraint" => 500
                ),
                "users_id" => array(
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
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('tokens_users');

    }

    public function down()
    {


        $this->dbforge->drop_table('tokens_users');
    }
}