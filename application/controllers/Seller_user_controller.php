<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Todociber
 * Date: 24/04/2017
 * Time: 12:31 PM
 */
class Seller_user_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $authUser = new AuthUser();
        $authUser = new AuthUser();
        if(!$authUser->is_seller()){
            redirect('login/logout');
        }

    }

    public function index(){
        $user = User::find($this->session->userdata('user_id'));
        $id =$user->profilesEbays[0]->id;
        $items = Item::where('Profiles_Ebay_id',$user->profilesEbays[0]->id)->get();
        $this->blade->view('Sellers.items',compact('items','id'));
    }

    public function items_details($id){
        $item = Item::find($id);
        $this->blade->view('Sellers.itemsDetails',compact('item'));
    }
}