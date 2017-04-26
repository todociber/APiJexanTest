<?php

/**
 * Created by PhpStorm.
 * User: Todociber
 * Date: 24/04/2017
 * Time: 05:49 PM
 */
class Migration_create_address_user extends CI_Migration
{
 public function up(){
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
             "zipcode" => array(
                 "type" => "VARCHAR",
                 "constraint" => 100,
                 'null' => TRUE,
             ),
             "city_id" => array(
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
     $this->dbforge->add_field("CONSTRAINT FOREIGN KEY (city_id) REFERENCES cities(id)");
     $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (users_id) REFERENCES users(id)');
     $this->dbforge->add_key('id', TRUE);
     $this->dbforge->create_table('address_user');
 }
    public function down()
    {

        $this->dbforge->drop_table('address_user');

    }
}