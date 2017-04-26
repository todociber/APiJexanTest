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
        $authUser = new AuthUser();
        if(!$authUser->is_admin()){
            redirect('login/logout');
        }
    }

    public function show_items($id){
        $items = Item::where('Profiles_Ebay_id',$id)->get();
        $this->blade->view('Admin.items',compact('items','id'));
    }

    public function items_details($id){
        $item = Item::find($id);
        $this->blade->view('Admin.itemsDetails',compact('item'));
    }

    public function get_items(){
        $apiEbay = new Api_Ebay();
        $items = $apiEbay->get_items_for_seller("bestserviceguys","100","1");
        if($items->paginationOutput->totalPages>1){
            $items2= $apiEbay->get_items_for_seller("bestserviceguys","100","2");
        }

        echo $items->paginationOutput->totalPages;

    }
    public function getItemPage($id){
        $apiEbay = new Api_Ebay();
        $items = $apiEbay->get_items_for_seller("bestserviceguys","200",$id);

        echo "page Number: ".$id."</br>";
    }
}