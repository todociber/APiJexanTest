<?php

/**
 * Created by PhpStorm.
 * User: Todociber
 * Date: 17/04/2017
 * Time: 12:19 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');
class MigrationsController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     *functions for run Migrations and create tables in databases
     *insert data in tables
     */
    public function index()
    {
        $this->load->library('migration');
         if(!$this->migration->version(13)){
            echo "error";
        }else{
            echo "success";
        }

    }
}