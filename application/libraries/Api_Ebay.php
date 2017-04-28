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
        $this->CI =& get_instance();
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

    /**
     * @param $seller
     * @param $entiesPerPage
     * @param $pageNumber
     * @return mixed
     */
    private function get_items_for_seller($seller, $entiesPerPage, $pageNumber){

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

    /**
     * @param $xml= result for Api Ebay in XML
     * @return string = result information in JSON format
     */
    private function Parse ($xml) {
        $fileContents = str_replace(array("\n", "\r", "\t","@"), '', $xml);
        $fileContents = trim(str_replace('"', "'", $fileContents));
        $simpleXml = simplexml_load_string($fileContents);
        $json = json_encode($simpleXml);
        return $json;
    }

    /**
     * @param $seller = Seller username from ebay
     * @param $entries = Numbers of items per page
     * @param $pageNumber = Number of page for Apply
     * @return string = structure data for send ebay
     */
    private function set_data_items($seller, $entries, $pageNumber){
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

    /**
     * @return array = headers format for send ebay
     */
    private function set_headers_items(){
        global $key_app;
        $headers = array(
            'Content-Type: text/xml',
            'X-EBAY-SOA-SECURITY-APPNAME: '.$key_app,
            'X-EBAY-SOA-OPERATION-NAME: findItemsAdvanced',
        );
        return $headers;
    }

    /**
     * @param $seller = Seller username from Ebay
     * @param $id = local id of Profile_Ebay table
     * @internal $itemsExisting = deleting all old items for  this seller
     * @return bool = Returns correct or incorrect execution
     */
    public function get_items($seller, $id){
        $this->CI =& get_instance();
        $itemsEbay = $this->get_items_for_seller($seller,"100","1");
        if($itemsEbay->ack=="Success")
        {
            $itemsExisting= Item::where('Profiles_Ebay_id',$id)->get();
            foreach ($itemsExisting as $itemExisting)
            {
                $itemExisting->forceDelete();
            }
            try{
                $this->insert_items($itemsEbay,$id);
            }catch (Exception $e){

            }

            if($itemsEbay->paginationOutput->totalPages>1)
            {
                $itemsEbay = $this->get_items_for_seller($seller,"100","2");
                if($itemsEbay->ack=="Success")
                {
                    $this->insert_items($itemsEbay,$id);
                }
            }
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * @param $itemsEbay  = items object from Api Ebay
     * @param $id = local id of Profile_Ebay table
     */
    private function insert_items($itemsEbay, $id){
        foreach ($itemsEbay->searchResult->item as $item)
        {

                $category = CategoryEbay::where('id_ebay',$item->primaryCategory->categoryId)->first();
                if(count($category)==0)
                {
                    $category= new CategoryEbay();
                    $category->fill([
                        "id_ebay"=>$item->primaryCategory->categoryId,
                        "name_ebay"=>$item->primaryCategory->categoryName
                    ]);
                    $category->save();
                }
                $paymentMethod = PaymentmethodsEbay::where('name_method',$item->paymentMethod)->first();
                if(count($paymentMethod)==0)
                {
                    $paymentMethod = new PaymentmethodsEbay();
                    $paymentMethod->fill([
                        "name_method"=>$item->paymentMethod
                    ]);
                    $paymentMethod->save();
                }
                $conditions = ConditionsEbay::where('id_ebay',$item->condition->conditionId)->first();
                if(count($conditions)==0 && $item->condition->conditionId!=NULL && $item->condition->conditionDisplayName !=NULL )
                {
                    $conditions = new ConditionsEbay();
                    $conditions->fill([
                        "id_ebay"=>$item->condition->conditionId,
                        "name"=>$item->condition->conditionDisplayName
                    ]);
                    $conditions->save();
                }
                $saveItem = new Item();
                $gallery ='none';
                try{
                    $gallery = $item->galleryURL;
                }catch (Exception $e){
                    $gallery = "none";
                }
                if($gallery ==NULL OR $gallery ==''){
                    $gallery ="none";
                }
                $saveItem->fill([
                    "itemId"                        =>  $item->itemId,
                    "title"                         =>  $item->title,
                    "globalId"                      =>  $item->globalId,
                    "category_ebay_id"              =>  $category->id,
                    "galleryURL"                    =>  $gallery,
                    "viewItemURL"                   =>  $item->viewItemURL,
                    "paymentMethods_ebay_id"        =>  $paymentMethod->id,
                    "currentPrice"                  =>  $item->sellingStatus->currentPrice,
                    "convertedCurrentPrice"         =>  $item->sellingStatus->convertedCurrentPrice,
                    "sellingState"                  =>  $item->sellingStatus->sellingState,
                    "timeLeft"                      =>  $item->sellingStatus->timeLeft,
                    "bestOfferStatus"               =>  $item->listingInfo->bestOfferEnabled,
                    "buyItNowStatus"                =>  $item->listingInfo->buyItNowAvailable,
                    "itemscol"                      =>  $item->location,
                    "startTime"                     =>  $item->listingInfo->startTime,
                    "endTime"                       =>  $item->listingInfo->endTime,
                    "listingType"                   =>  $item->listingInfo->listingType,
                    "gift"                          =>  $item->listingInfo->gift,
                    "returnsStatus"                 =>  $item->returnsAccepted,
                    "conditions_id"                 =>  $conditions->id|| 1,
                    "isMultiVariationListingStatus" =>  $item->isMultiVariationListing,
                    "topRatedListingStatus"         =>  $item->topRatedListing,
                    "Profiles_Ebay_id"              =>  $id,
                ]);
                $saveItem->save();


        }


    }

}