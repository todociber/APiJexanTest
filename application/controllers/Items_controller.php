<?php

/**
 * Created by PhpStorm.
 * User: Todociber
 * Date: 22/04/2017
 * Time: 06:10 PM
 */
class Items_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if(!$this->authuser->is_admin())
        {
            redirect('login/logout');
        }
    }

    public function show_items($id)
    {
        $items = Item::where('Profiles_Ebay_id',$id)->get();
        $this->blade->view('Admin.items',compact('items','id'));
    }

    public function items_details($id)
    {
        $item = Item::find($id);
        $this->blade->view('Admin.itemsDetails',compact('item'));
    }


}