<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Todociber
 * Date: 20/04/2017
 * Time: 12:06 PM
 */
class Api_Ebay
{
    private  $key_app = '';
    public function __construct()
    {
        global $key_app;
        $key_app='Alexande-TestJexa-PRD-008f655c9-0e4aab30';
    }
        /**
     * @param $seller = name of Seller to request information
     * @return bool|mixed
     * request information of profile Ebay for name Seller and return an Array or Boolean if dead
     */
    public function get_profile_seller($seller){
        global $key_app;
        $ch = curl_init("http://open.api.ebay.com/getShopping?callname=GetUserProfile&responseencoding=JSON&appid=".$key_app."&UserID=".$seller."&version=981");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        $response = curl_exec($ch);
        curl_close($ch);
        if(!$response) {
            return false;
        }else{
            $result= json_encode($response, true);
            $result = json_decode($result);
            $res = json_decode($result);
            return $res;
        }
    }

    public function get_items_for_seller($seller, $entiesPerPage, $pageNumber){

        define('XML_POST_URL', 'http://svcs.ebay.com/services/search/FindingService/v1');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, XML_POST_URL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->set_data_items($seller,$entiesPerPage,$pageNumber));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->set_headers_items());
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        $json = $this->Parse($result);
        $datos = json_decode($json);

        return $datos;

    }

    private function Parse ($xml) {
        $fileContents = str_replace(array("\n", "\r", "\t","@"), '', $xml);
        $fileContents = trim(str_replace('"', "'", $fileContents));
        $simpleXml = simplexml_load_string($fileContents);
        $json = json_encode($simpleXml);

        return $json;
    }

    private function set_data_items($seller,$entries,$pageNumber){
        $data ='
    <findItemsAdvancedRequest xmlns="http://www.ebay.com/marketplace/search/v1/services">
  <itemFilter>
    <name>Seller</name>     
    <value>'.$seller.'</value>
  </itemFilter>
  <paginationInput>
    <entriesPerPage>'.$entries.'</entriesPerPage>
    <pageNumber>'.$pageNumber.'</pageNumber>
  </paginationInput>
  <outputSelector>SellerInfo</outputSelector>
</findItemsAdvancedRequest>';

        return $data;
    }

    private function set_headers_items(){
        global $key_app;
        $headers = array(
            'Content-Type: text/xml',
            'X-EBAY-SOA-SECURITY-APPNAME: '.$key_app,
            'X-EBAY-SOA-OPERATION-NAME: findItemsAdvanced',
        );
        return $headers;
    }
}