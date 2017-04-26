<?php

/**
 * Created by PhpStorm.
 * User: Todociber
 * Date: 18/04/2017
 * Time: 11:57 AM
 */
class Migration_create_items extends CI_Migration
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
                "itemId" => array(
                    "type" => "VARCHAR",
                    "constraint" => 100
                ),
                "title" => array(
                    "type" => "VARCHAR",
                    "constraint" => 100
                ),
                "globalId" => array(
                    "type" => "VARCHAR",
                    "constraint" => 100
                ),
                "category_ebay_id" => array(
                    'type' => 'int',
                    'constraint' => 100,
                    'unsigned' => TRUE,
                    'null' => FALSE,
                ),
                "galleryURL" => array(
                    "type" => "VARCHAR",
                    "constraint" => 100
                ),
                "viewItemURL" => array(
                    "type" => "VARCHAR",
                    "constraint" => 500
                ),
                "paymentMethods_ebay_id" => array(
                    'type' => 'int',
                    'constraint' => 100,
                    'unsigned' => TRUE,
                    'null' => FALSE,
                ),
                "currentPrice" => array(
                    "type" => "VARCHAR",
                    "constraint" => 100
                ),
                "convertedCurrentPrice" => array(
                    "type" => "VARCHAR",
                    "constraint" => 100
                ),
                "sellingState" => array(
                    "type" => "VARCHAR",
                    "constraint" => 100
                ),
                "timeLeft" => array(
                    "type" => "VARCHAR",
                    "constraint" => 100
                ),
                "bestOfferStatus" => array(
                    "type" => "VARCHAR",
                    "constraint" => 100
                ),
                "buyItNowStatus" => array(
                    "type" => "VARCHAR",
                    "constraint" => 100
                ),
                "itemscol" => array(
                    "type" => "VARCHAR",
                    "constraint" => 100
                ),
                "startTime" => array(
                    "type" => "VARCHAR",
                    "constraint" => 100
                ),
                "endTime" => array(
                    "type" => "VARCHAR",
                    "constraint" => 100
                ),
                "listingType" => array(
                    "type" => "VARCHAR",
                    "constraint" => 100
                ),
                "gift" => array(
                    "type" => "VARCHAR",
                    "constraint" => 100
                ),
                "returnsStatus" => array(
                    "type" => "VARCHAR",
                    "constraint" => 100
                ),
                "conditions_id" => array(
                    'type' => 'int',
                    'constraint' => 100,
                    'unsigned' => TRUE,
                    'null' => FALSE,
                ),
                "isMultiVariationListingStatus" => array(
                    "type" => "VARCHAR",
                    "constraint" => 100
                ),
                "topRatedListingStatus" => array(
                    "type" => "VARCHAR",
                    "constraint" => 100
                ),
                "Profiles_Ebay_id" => array(
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
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (Profiles_Ebay_id) REFERENCES profiles_ebay(id)');
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (category_ebay_id) REFERENCES category_ebay(id)');
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (paymentMethods_ebay_id) REFERENCES paymentMethods_ebay(id)');
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (conditions_id) REFERENCES conditions_ebay(id)');
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('items');
    }

    public function down()
    {

        $this->dbforge->drop_table('items');

    }
}