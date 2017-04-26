<?php

/**
 * Created by PhpStorm.
 * User: Todociber
 * Date: 18/04/2017
 * Time: 01:37 AM
 */
class Migration_create_address_data extends CI_Migration
{
    public function up()
    {
        $sql = file_get_contents("world.sql");
        $sqls = explode(';', $sql);
        array_pop($sqls);

        foreach($sqls as $statement){
            $statment = $statement . ";";
            $this->db->query($statement);
        }

        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (users_id) REFERENCES users(id)');
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (type_of_phones_id) REFERENCES type_of_phones(id)');
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (users_id) REFERENCES users(id)');
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (type_of_phones_id) REFERENCES type_of_phones(id)');
    }

    public function down()
    {
        $this->dbforge->drop_table('cities');
        $this->dbforge->drop_table('countries');
        $this->dbforge->drop_table('regions');

    }
}