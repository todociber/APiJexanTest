<?php

/**
 * Created by PhpStorm.
 * User: Todociber
 * Date: 16/04/2017
 * Time: 11:32 AM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class LoginController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('UsersModels');

    }

    public function index(){
        // $this->load->view('LayoutAdmin.blade.php');
        //echo $this->blade->view('CasaCorredoraLayout');
        $this->blade->view('Login');
    }

    public function ingresar(){
        $email  = $this->input->post('email');
        $password = $this->input->post('password');


        $erros = array(
            "Email requerido",
            "Contraseña incorrecta",
            "Prueba de Errores"
        );
        $this->session->set_flashdata('errors', $erros);
            redirect('login');
            // $this->load->view('vlogin',$data);

    }
}