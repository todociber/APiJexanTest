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

    public function index()
    {
        $this->load->library('migration');

        //this->migration->version(2)ejecutará el método up de
        //las migraciones 001 y 002 y el método down de las superiores
        if(!$this->migration->version(13)){
            echo "error";
        }else{
            echo "success";
        }

    }
}