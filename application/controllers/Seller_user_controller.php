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
    /**
     * Seller_user_controller constructor.
     * Access is granted only to sellers
     */
    public function __construct()
    {
        parent::__construct();

        if(!$this->authuser->is_seller()){
            redirect('login/logout');
        }

    }

    /**
     * return listing of all items for login seller
     */
    public function index()
    {
        $user = User::find($this->session->userdata('user_id'));
        $id =$user->profilesEbays[0]->id;
        $items = Item::where('Profiles_Ebay_id',$user->profilesEbays[0]->id)->get();
        $this->blade->view('Sellers.items',compact('items','id'));
    }

    /**
     * @param $id = id item from local database
     */
    public function items_details($id)
    {
        $item = Item::find($id);
        $this->blade->view('Sellers.itemsDetails',compact('item'));
    }

    /**
     * update all items for login seller
     */
    public function update_items_list()
    {
        $user = User::find($this->session->userdata('user_id'));
        $seller = ProfilesEbay::find($user->profilesEbays[0]->id);
        if($this->api_ebay->get_items($seller->username,$seller->id))
        {
            $this->session->set_flashdata('success', "Update items successfully");
        }
        else
        {
            $this->session->set_flashdata('errors', "Error in Update items");
        }
        redirect('myItems');
    }
}