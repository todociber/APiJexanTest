<?php

/**
 * Created by PhpStorm.
 * User: Todociber
 * Date: 27/04/2017
 * Time: 11:32 AM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class ProfileController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('AuthUser');
        if(!$this->authuser->AuthCheck())
        {
            //redirect('login/logout');
        }
    }

    public function profileAdmin()
    {
        if($this->authuser->is_admin()){
            $user = User::find($this->session->userdata('user_id'));
            $this->blade->view('Profile.ProfileAdmin',compact('user'));
        }
        else
        {
            redirect('login/logout');
        }
    }


    public function profileSeller()
    {
        if($this->authuser->is_seller()){
            $user = User::find($this->session->userdata('user_id'));
            $this->blade->view('Profile.ProfileSeller',compact('user'));
        }
        else
        {
            redirect('login/logout');
        }
    }


}