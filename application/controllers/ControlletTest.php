<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ControlletTest extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */

   public function __construct()
    {
        parent::__construct();
        $this->load->model('UsersModels');

    }

    public function index()
    {

        $this->blade->view('TestPantalla');
    }

    public function test($id)
    {

        define('XML_POST_URL', 'http://svcs.ebay.com/services/search/FindingService/v1');

        $theData ='<findItemsAdvancedRequest xmlns="http://www.ebay.com/marketplace/search/v1/services">
  <itemFilter>
    <name>Seller</name>
     
    <value>pollo_ambe</value>
  </itemFilter>
  <paginationInput>
    <entriesPerPage>'.$id.'</entriesPerPage>
    <pageNumber> 1 </pageNumber>
  </paginationInput>
  <outputSelector>SellerInfo</outputSelector>
</findItemsAdvancedRequest>';


        $headers = array(
            'Content-Type: text/xml',
            'X-EBAY-SOA-SECURITY-APPNAME: Alexande-TestJexa-PRD-008f655c9-0e4aab30',
            'X-EBAY-SOA-OPERATION-NAME: findItemsAdvanced',
           );


        /**
         * Initialize handle and set options
         */
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, XML_POST_URL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $theData);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

        /**
         * Execute the request
         */
        $result = curl_exec($ch);

        /**
         * Close the handle
         */
        curl_close($ch);

        /**
         * Output the results and time
         */
        header('Content-Type: application/json');
        $json = $this->Parse($result);
        $datos = json_decode($json);

        echo $json;

        /*$usuarios = UsersModels::all();
        $this->load->view('TestView',compact('id','usuarios'));*/
    }
    public function Parse ($xml) {

        $fileContents = str_replace(array("\n", "\r", "\t","@"), '', $xml);
        $fileContents = trim(str_replace('"', "'", $fileContents));
        $simpleXml = simplexml_load_string($fileContents);
        $json = json_encode($simpleXml);

        return $json;
    }
}