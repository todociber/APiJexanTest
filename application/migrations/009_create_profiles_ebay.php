<?php

/**
 * Created by PhpStorm.
 * User: Todociber
 * Date: 18/04/2017
 * Time: 11:43 AM
 */
class Migration_create_profiles_ebay extends CI_Migration
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
                "username" => array(
                    "type" => "VARCHAR",
                    "constraint" => 100
                ),
                "New_User_status" => array(
                    "type" => "BOOLEAN",
                    "default"=>0,
                ),
                "Status_Confirmed" => array(
                    "type" => "BOOLEAN",
                    "default"=>0,
                ),
                "RegistrationDate" => array(
                    "type" => "VARCHAR",
                    "constraint" => 100
                ),
                "RegistrationSite" => array(
                    "type" => "VARCHAR",
                    "constraint" => 100
                ),
                "SellerBusiness_Type" => array(
                    "type" => "VARCHAR",
                    "constraint" => 100
                ),
                "SellerItemsURL" => array(
                    "type" => "VARCHAR",
                    "constraint" => 100
                ),
                "FeedbackDetailsURL" => array(
                    "type" => "VARCHAR",
                    "constraint" => 100
                ),
                "PositiveFeedbackPercent" => array(
                    "type" => "VARCHAR",
                    "constraint" => 100
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
        $this->dbforge->create_table('profiles_ebay');
    }

    public function down()
    {

        $this->dbforge->drop_table('profiles_ebay');

    }
}