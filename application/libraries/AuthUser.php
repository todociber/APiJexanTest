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
        $CI = & get_instance();
        $this->CI =& get_instance();
    }

    /**
     * @return bool
     * return if user is Auth or not
     */
    public function AuthCheck()
    {
        $CI = & get_instance();
        $usuarios = $CI->session->userdata('user_id');
        if($usuarios != NULL)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function Route_check_permission()
    {
        $CI = & get_instance();
        $CI->session->userdata('user_id');
    }

    /**
     * @return bool
     * return true if users singin is an Admin of system
     */
    public function is_admin(){
        try{
            $CI = & get_instance();
            $usuarios = $CI->session->userdata('user_type');
            if($usuarios == 1){
                return true;
            }else{
                return false;
            }
        }catch (Exception $e){
            return false;
        }

    }
    public function is_seller(){
        $CI = & get_instance();
        $usuarios = $CI->session->userdata('user_type');
        if($usuarios == 2){
            return true;
        }else{
            return false;
        }
    }


    /**
     *Depending on the role of the user, a default redirection is assigned
     */
    public function redirector(){
        $CI = & get_instance();
        $usuarios = $CI->session->userdata('user_type');
        if($usuarios == 1){
            redirect('sellers');
        }elseif ($usuarios==2){
            redirect('myItems');
        }
    }
}