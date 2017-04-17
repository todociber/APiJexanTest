<?php

/**
 * Created by PhpStorm.
 * User: Todociber
 * Date: 15/04/2017
 * Time: 11:05 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

use Philo\Blade\Blade;

class BladeController extends CI_Controller
{
    protected $blade;
    protected $views = APPPATH . '/views';
    protected  $cache = APPPATH . '/cache';

    public function __construct()
    {
        parent::__construct();

    }

    public function index(){
       // $this->load->view('LayoutAdmin.blade.php');
        //echo $this->blade->view('CasaCorredoraLayout');
        $this->blade->view('CasaCorredoraLayout');
    }
}