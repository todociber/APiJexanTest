<?php

/**
 * Created by PhpStorm.
 * User: Todociber
 * Date: 20/04/2017
 * Time: 12:58 AM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Logout_Controller extends CI_Controller
{

    /**
     *function for close session for users Signed
     */
    public function logout(){
        $datasession = array(
            'user_id'  =>"",
            'user_type' =>""
        );
        $this->session->set_userdata($datasession);
        redirect('/');
    }

}