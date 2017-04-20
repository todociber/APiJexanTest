<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Todociber
 * Date: 20/04/2017
 * Time: 12:06 AM
 */
class Api_Ebay
{
    public function __construct()
    {
    }


    public function get_profile_seller($seller){
        $ch = curl_init("http://open.api.ebay.com/getShopping?callname=GetUserProfile&responseencoding=JSON&appid=Alexande-TestJexa-PRD-008f655c9-0e4aab30&UserID=".$seller."&version=981");
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
}