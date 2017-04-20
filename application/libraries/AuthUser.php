<?php

/**
 * Created by PhpStorm.
 * User: Todociber
 * Date: 20/04/2017
 * Time: 01:12 AM
 */
class AuthUser
{
    public function __construct()
    {

    }
    public function AuthCheck(){
        $CI = & get_instance();
        $usuarios = $CI->session->userdata('user_id');
        if($usuarios != NULL){
            return true;
        }else{
            return false;
        }
    }

    public function Route_check_permission(){
        $CI = & get_instance();
        $CI->session->userdata('user_id');
    }

    public function is_admin(){
        $CI = & get_instance();
        $usuarios = $CI->session->userdata('user_type');
        if($usuarios == 1){
            return true;
        }else{
            return false;
        }
    }


    public function redirector(){
        $CI = & get_instance();
        $usuarios = $CI->session->userdata('user_type');
        if($usuarios == 1){
            redirect('sellers');
        }elseif($usuarios==''){
            //redirect('login/logout');
        }
    }
}