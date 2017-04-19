<?php
/**
 * Created by PhpStorm.
 * User: Todociber
 * Date: 19/04/2017
 * Time: 11:35 AM
 */

defined('BASEPATH') OR exit('No direct script access allowed');
class Sellers_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->blade->view('Admin.ShowSellers');
    }

    public function newSeller(){
        $zipcodes = Zipcode::all();
        $this->blade->view('Admin.NewSeller',compact('zipcodes'));
    }

    public function get_zipcodes(){
        if(!empty($this->input->get("q"))){
            $zip = $this->input->get("q");
            $zicodes = Zipcode::Where('ZIP', 'like', '%' . $zip . '%')
                ->orWhere('City', 'like', '%' . $zip . '%')
                ->orWhere('State', 'like', '%' . $zip . '%')
                ->orWhere('County', 'like', '%' . $zip . '%')
                ->selectRaw('CONCAT( ZIP ," ", City, " ", State," ",County ) as text, id')->get();

            $db_prueba = $this->load->database('prueba', TRUE);
            $query = $db_prueba->query("Select id, zip as text from zipcodes where id =1");

            $zicodes= $query->result_array();

            echo json_encode($zicodes);
        }


    }
}