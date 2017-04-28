<?php
/**
 * Created by PhpStorm.
 * User: Todociber
 * Date: 19/04/2017
 * Time: 11:35 AM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Sellers_controller
 */
class Sellers_controller extends CI_Controller
{
    /**
     * Sellers_controller constructor.
     * Protected all functions in controller for users role = Administrator
     */
    public function __construct()
    {
        parent::__construct();

        if(!$this->authuser->is_admin()){
            redirect('login/logout');
        }
    }

    /**
     *index for Sellers_controller
     * return view for list all sellers
     * @internal  $sellers = access to model ProfilesEbay for get all data Sellers in the system
     */
    public function index()
    {
        $sellers = ProfilesEbay::all();
        $this->blade->view('Admin.ShowSellers',compact('sellers'));
    }

    /**
     * return view for add new Sellers
     */
    public function new_seller()
    {

        $countries = Country::orderBy('name','ASC')->get();
        $this->blade->view('Admin.NewSeller',compact('countries'));
    }


    /**
     * save data from formulary for add new Sellers
     * first validate data
     * the function @$data_seller = data of user from Ebay Api (Only Profile info, not items)
     */
    public function save_new_seller()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|regex_match[/^([a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/]');
        $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|regex_match[/^([a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/]');
        $this->form_validation->set_rules('phoneNumber', 'Phone number', 'trim|required');
        $this->form_validation->set_rules('country', 'Country', 'trim|required|callback_comprobate_country_id');
        $this->form_validation->set_rules('countryName', 'Phone number', 'trim|required');
        $this->form_validation->set_rules('countryExtension', 'Phone number', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('userEbay', 'User Ebay', 'trim|required|callback_comprobate_seller_name');
        $this->form_validation->set_rules('zipcode', 'zipcode', 'trim|required');
        $this->form_validation->set_rules('cities', 'City ', 'trim|required');
        $this->form_validation->set_rules('addressLine1', 'Address Line 1', 'trim|required');
        $this->form_validation->set_rules('addressLine2', 'Address Line 2', 'trim');
        if (!$this->form_validation->run())
        {
            $countryFind = Country::where('id',$this->input->post('country'))->first();
            $this->session->set_flashdata('name',$this->input->post('name'));
            $this->session->set_flashdata('lastname',$this->input->post('lastname'));
            $this->session->set_flashdata('phoneNumber',$this->input->post('phoneNumber'));
            $this->session->set_flashdata('email',$this->input->post('email'));
            $this->session->set_flashdata('userEbay',$this->input->post('userEbay'));
            $this->session->set_flashdata('countryName',$this->input->post('countryName'));
            $this->session->set_flashdata('countryExtension',$this->input->post('countryExtension'));
            $this->session->set_flashdata('countryFind',$countryFind->id);
            $this->session->set_flashdata('cities',$this->input->post('cities'));
            $this->session->set_flashdata('regions',$this->input->post('regions'));
            $this->session->set_flashdata('zipcodes',$this->input->post('zipcode'));
            $this->session->set_flashdata('addressLine1',$this->input->post('addressLine1'));
            $this->session->set_flashdata('addressLine2',$this->input->post('addressLine2'));
            $this->session->set_flashdata('errors', validation_errors());
            redirect('sellers/new');
        }
        else
        {
            $infoSeller = new Api_Ebay();
            $data_seller =$infoSeller->get_profile_seller($this->input->post('userEbay'));
            if($data_seller!=FALSE)
            {
             if($data_seller->Ack=='Success')
             {
                 $this->load->library('Token_generator');
                 $tokenGenerator = new Token_generator();
                 $hash = $this->bcrypt->hash_password($tokenGenerator->tokens_generator());
                $newUser = new User();
                $newUser->fill([
                    "email"=>$this->input->post('email'),
                    "password"=>$hash,
                    "name"=>$this->input->post('name'),
                    "lastname"=>$this->input->post('lastname'),
                    "resete_password_status"=>1,
                    "type_user_id"=>2
                ]);
                $newUser->save();
                $phoneUser = new UsersPhone();
                $phoneUser->fill([
                   "number_phone"=> $this->input->post('phoneNumber'),
                    "country_code"=>$this->input->post('countryName'),
                    "country_extension"=>$this->input->post('countryExtension'),
                    "users_id"=>$newUser->id,
                    "type_of_phones_id"=>1,
                ]);
                $phoneUser->save();

                $addresUser = new AddressUser();
                $addresUser->fill([
                    "Address_line_one"=>$this->input->post('addressLine1'),
                    "Address_line_two"=>$this->input->post('addressLine2'),
                    "zipcode"=>$this->input->post('zipcode'),
                    "city_id"=>$this->input->post('cities'),
                    "users_id"=>$newUser->id
                ]);
                $addresUser->save();

                $tokenUser = new TokensUser();
                $tokenUser->fill([
                    "token"=>$tokenGenerator->tokens_generator(),
                    "users_id"=>$newUser->id
                ]);
                $tokenUser->save();
                $profileEbay = new ProfilesEbay();
                if($data_seller->User->NewUser==true)
                {
                    $ebayNewUser =0;
                }else{
                    $ebayNewUser =1;
                }
                if($data_seller->User->Status =="Confirmed")
                {
                    $ebayStatusConfirmed =0;
                }else{
                    $ebayStatusConfirmed =1;
                }
                $profileEbay->fill([
                    "username"=>$data_seller->User->UserID,
                    "New_User"=>$ebayNewUser,
                    "Status_Confirmed"=>$ebayStatusConfirmed,
                    "RegistrationDate"=>$data_seller->User->RegistrationDate,
                    "RegistrationSite"=>$data_seller->User->RegistrationSite,
                    "SellerBusiness_Type"=>$data_seller->User->SellerBusinessType,
                    "SellerItemsURL"=>$data_seller->User->SellerItemsURL,
                    "FeedbackDetailsURL"=>$data_seller->User->FeedbackDetailsURL,
                    "PositiveFeedbackPercent"=>$data_seller->User->PositiveFeedbackPercent,
                    "users_id"=>$newUser->id
                ]);
                $profileEbay->save();
                $this->api_ebay->get_items($profileEbay->username,$profileEbay->id);
                $this->send_email($newUser->email,$newUser->name,"Account Activate",$tokenUser->token);
                 $this->session->set_flashdata('success', "Successfully Registered User");
                 redirect('sellers/new');
             }
             else
             {
             $countryFind = Country::where('id',$this->input->post('country'))->first();
            $this->session->set_flashdata('name',$this->input->post('name'));
            $this->session->set_flashdata('lastname',$this->input->post('lastname'));
            $this->session->set_flashdata('phoneNumber',$this->input->post('phoneNumber'));
            $this->session->set_flashdata('email',$this->input->post('email'));
            $this->session->set_flashdata('userEbay',$this->input->post('userEbay'));
            $this->session->set_flashdata('countryName',$this->input->post('countryName'));
            $this->session->set_flashdata('countryExtension',$this->input->post('countryExtension'));
            $this->session->set_flashdata('countryFind',$countryFind->id);
            $this->session->set_flashdata('cities',$this->input->post('cities'));
            $this->session->set_flashdata('regions',$this->input->post('regions'));
            $this->session->set_flashdata('zipcodes',$this->input->post('zipcode'));
            $this->session->set_flashdata('addressLine1',$this->input->post('addressLine1'));
            $this->session->set_flashdata('addressLine2',$this->input->post('addressLine2'));
            $this->session->set_flashdata('errors', 'Users Ebay Invalid');
                 redirect('sellers/new');
             }
            }

        }
    }

     /**
     * @return bool
     * Check to Avoid Repeat Users
     */
    public function comprobate_seller_name()
    {
        $seller = $this->input->post('userEbay');
        $sellerFind = ProfilesEbay::where('username',$seller)->get();
        if (count($sellerFind)>0)
        {
            $this->form_validation->set_message('comprobate_seller_name', 'Ebay user already registered');
            return FALSE;
        } else
        {
            return true;
        }
    }

    /**
     * @return bool = Check if the country exists in the local database
     */
    public function comprobate_country_id()
    {
        $country = $this->input->post('country');
        $countryFind = Country::where('id',$country)->get();
        if (count($countryFind)==0)
        {
            $this->form_validation->set_message('comprobate_country_id', 'country is invalid');
            return FALSE;
        } else
        {
            return true;
        }
    }

    /**
     * @param $email = Destination Email Address
     * @param $name = Name of user in the Email
     * @param $topic = Topic for Email
     * @param $token = Token for reset Password
     * @return bool = if true send Succseful or false en case contrary
     */
    private function send_email($email, $name, $topic, $token)
    {

        $this->load->library('email');


        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.gmail.com';
        $config['smtp_port'] = '465';



        $config["smtp_user"] = 'comentario.csjb@gmail.com';

        $config["smtp_pass"] = 'c0m3nt4r105';

        $config['mailtype'] = 'html';

        $config['charset'] = 'utf-8';

        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from('comentario.csjb@gmail.com', 'Alexander Dominguez');

        $this->email->to($email, $name);
        $this->email->subject($topic);
        $mensaje = '<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Set Password</title>
</head>
<body>
<table cellspacing="0" cellpadding="0" border="0" width="100%">
    <tr>
        <td class="navbar navbar-inverse" align="center">
            <!-- This setup makes the nav background stretch the whole width of the screen. -->
            <table width="650px" cellspacing="0" cellpadding="3" class="container">
                <tr class="navbar navbar-inverse">

                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td bgcolor="#FFFFFF" align="center">
            <table width="650px" cellspacing="0" cellpadding="3" class="container">
                <br>
                    <td><h2><b>'. $name.'</b></h2></td></br>
                    <p> The account has been created in the following link you can establish a password</p></br>
                    <td colspan="4"><a class="brand" href="'.base_url().'login/token/'.$token.'">Set Password</a></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td bgcolor="#FFFFFF" align="center">
            <table width="650px" cellspacing="0" cellpadding="3" class="container">
                <tr>
                    <td>
                        <hr>
                        <p>Jexan TestBackend - 2017</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>';

        $this->email->message($mensaje);
        return  $this->email->send();



    }

    /**
     * @param $id = Ebay Profiles ID
     * @internal $seller = reference to Model ProfilesEbay and function "find" for search data
     */
    public function seller_details($id)
    {
        $seller = ProfilesEbay::find($id);
        if(count($seller)==0)
        {
            $authUser = new AuthUser();
            $authUser->redirector();
        }
        $this->blade->view('Admin.DetailsSellers',compact('seller'));
    }

    /**
     * @param $id = id of Seller to Edit Information
     *  Get data for seller and returns view with data value in the inputs
     */
    public function seller_edit_view($id)
    {
        $seller = ProfilesEbay::find($id);
        if(count($seller)==0)
        {
            $authUser = new AuthUser();
            $authUser->redirector();
        }

        $countries = Country::orderBy('name','ASC')->get();
        if(empty($_SESSION['errors'])){
            $this->session->set_flashdata('countryName',$seller->user->usersPhones[0]->country_code);
            $this->session->set_flashdata('countryExtension',$seller->user->usersPhones[0]->country_extension);
            $this->session->set_flashdata('countryFind',$seller->user->addressUsers[0]->city->region->country->id);
            $this->session->set_flashdata('zipcode',$seller->user->addressUsers[0]->zipcode);
            $this->session->set_flashdata('name',$seller->user->name);
            $this->session->set_flashdata('lastname',$seller->user->lastname);
            $this->session->set_flashdata('phoneNumber',$seller->user->usersPhones[0]->number_phone);
            $this->session->set_flashdata('cities',$seller->user->addressUsers[0]->city->id);
            $this->session->set_flashdata('regions',$seller->user->addressUsers[0]->city->region->id);
            $this->session->set_flashdata('email',$seller->user->email);
            $this->session->set_flashdata('userEbay',$seller->username);
            $this->session->set_flashdata('addressLine1',$seller->user->addressUsers[0]->Address_line_one);
            $this->session->set_flashdata('addressLine2',$seller->user->addressUsers[0]->Address_line_two);
        }
        $this->blade->view('Admin.EditSeller',compact('seller','countries','id'));
    }


    /**
     * @param $id = id for save information of seller
     * @internal $searchUserComprobate = check if other they have the same email
     *@internal  $searchProfileComprobate = check if other they have the same username
     */
    public function save_seller_edit($id)
    {

        $this->form_validation->set_rules('country', 'Country', 'trim|required|callback_comprobate_country_id');
        $this->form_validation->set_rules('countryName', 'Phone number', 'trim|required');
        $this->form_validation->set_rules('countryExtension', 'Phone number', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('userEbay', 'User Ebay', 'trim|required');
        $this->form_validation->set_rules('name', 'Name', 'required|regex_match[/^([a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/]');
        $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|regex_match[/^([a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/]');
        $this->form_validation->set_rules('phoneNumber', 'Phone number', 'trim|required');
        $this->form_validation->set_rules('zipcode', 'zipcode', 'trim|required');
        $this->form_validation->set_rules('addressLine1', 'Address Line 1', 'trim|required');
        $this->form_validation->set_rules('addressLine2', 'Address Line 2', 'trim');
        if (!$this->form_validation->run())
        {
            $countryFind = Country::where('id',$this->input->post('country'))->first();
            $this->session->set_flashdata('name',$this->input->post('name'));
            $this->session->set_flashdata('lastname',$this->input->post('lastname'));
            $this->session->set_flashdata('phoneNumber',$this->input->post('phoneNumber'));
            $this->session->set_flashdata('email',$this->input->post('email'));
            $this->session->set_flashdata('userEbay',$this->input->post('userEbay'));
            $this->session->set_flashdata('countryName',$this->input->post('countryName'));
            $this->session->set_flashdata('countryExtension',$this->input->post('countryExtension'));
            $this->session->set_flashdata('countryFind',$countryFind->id);
            $this->session->set_flashdata('cities',$this->input->post('cities'));
            $this->session->set_flashdata('regions',$this->input->post('regions'));
            $this->session->set_flashdata('zipcodes',$this->input->post('zipcode'));
            $this->session->set_flashdata('addressLine1',$this->input->post('addressLine1'));
            $this->session->set_flashdata('addressLine2',$this->input->post('addressLine2'));
            $this->session->set_flashdata('errors', validation_errors());
           redirect('sellers/edit/'.$id);
        }
        else
        {
            $profileEbay= ProfilesEbay::find($id);
            $searchUserComprobate = User::where('id','!=',$profileEbay->user->id)->where('email',$this->input->post('email'))->get();
            $searchProfileComprobate = ProfilesEbay::where('username',$this->input->post('userEbay'))->where('id','!=',$id)->get();
            $infoSeller = new Api_Ebay();
            $data_seller =$infoSeller->get_profile_seller($this->input->post('userEbay'));
            if($data_seller!=FALSE && count($searchProfileComprobate)==0 && count($searchUserComprobate)==0)
            {
                if($data_seller->Ack=='Success')
                {
                    $this->load->library('Token_generator');
                    $tokenGenerator = new Token_generator();

                    $newUser =$profileEbay->user;
                    $newUser->fill([
                        "email"=>$this->input->post('email'),
                        "name"=>$this->input->post('name'),
                        "lastname"=>$this->input->post('lastname'),
                        "resete_password_status"=>1,
                        "type_user_id"=>2
                    ]);
                    $newUser->save();
                    $phoneUser = $profileEbay->user->usersPhones[0];
                    $phoneUser->fill([
                        "number_phone"=> $this->input->post('phoneNumber'),
                        "country_code"=>$this->input->post('countryName'),
                        "country_extension"=>$this->input->post('countryExtension'),
                        "users_id"=>$newUser->id,
                        "type_of_phones_id"=>1,
                    ]);
                    $phoneUser->save();
                    $addressUser = $profileEbay->user->addressUsers[0];
                    $addressUser->fill([
                        "Address_line_one"=>$this->input->post('addressLine1'),
                        "Address_line_two"=>$this->input->post('addressLine2'),
                        "zipcode"=>$this->input->post('zipcode'),
                        "city_id"=>$this->input->post('cities'),
                        "users_id"=>$newUser->id
                    ]);
                    $addressUser->save();

                    if($data_seller->User->NewUser==true)
                    {
                        $ebayNewUser =0;
                    }else{
                        $ebayNewUser =1;
                    }
                    if($data_seller->User->Status =="Confirmed")
                    {
                        $ebayStatusConfirmed =0;
                    }else{
                        $ebayStatusConfirmed =1;
                    }
                    $profileEbay->fill([
                        "username"=>$data_seller->User->UserID,
                        "New_User"=>$ebayNewUser,
                        "Status_Confirmed"=>$ebayStatusConfirmed,
                        "RegistrationDate"=>$data_seller->User->RegistrationDate,
                        "RegistrationSite"=>$data_seller->User->RegistrationSite,
                        "SellerBusiness_Type"=>$data_seller->User->SellerBusinessType,
                        "SellerItemsURL"=>$data_seller->User->SellerItemsURL,
                        "FeedbackDetailsURL"=>$data_seller->User->FeedbackDetailsURL,
                        "PositiveFeedbackPercent"=>$data_seller->User->PositiveFeedbackPercent,
                        "users_id"=>$newUser->id
                    ]);
                    $profileEbay->save();
                    $this->api_ebay->get_items($profileEbay->username,$profileEbay->id);
                    $this->session->set_flashdata('success', "Successfully Edition User");
                    redirect('sellers/edit/'.$id);
                }
                else
                {
                    $countryFind = Country::where('id',$this->input->post('country'))->first();
                    $this->session->set_flashdata('name',$this->input->post('name'));
                    $this->session->set_flashdata('lastname',$this->input->post('lastname'));
                    $this->session->set_flashdata('phoneNumber',$this->input->post('phoneNumber'));
                    $this->session->set_flashdata('email',$this->input->post('email'));
                    $this->session->set_flashdata('userEbay',$this->input->post('userEbay'));
                    $this->session->set_flashdata('countryName',$this->input->post('countryName'));
                    $this->session->set_flashdata('countryExtension',$this->input->post('countryExtension'));
                    $this->session->set_flashdata('countryFind',$countryFind->id);
                    $this->session->set_flashdata('cities',$this->input->post('cities'));
                    $this->session->set_flashdata('regions',$this->input->post('regions'));
                    $this->session->set_flashdata('zipcodes',$this->input->post('zipcode'));
                    $this->session->set_flashdata('addressLine1',$this->input->post('addressLine1'));
                    $this->session->set_flashdata('addressLine2',$this->input->post('addressLine2'));
                    $this->session->set_flashdata('errors', "Email or Username al ready register or are invalid");
                    redirect('sellers/edit/'.$id);
                }
            }else{
                $countryFind = Country::where('id',$this->input->post('country'))->first();
                $this->session->set_flashdata('name',$this->input->post('name'));
                $this->session->set_flashdata('lastname',$this->input->post('lastname'));
                $this->session->set_flashdata('phoneNumber',$this->input->post('phoneNumber'));
                $this->session->set_flashdata('email',$this->input->post('email'));
                $this->session->set_flashdata('userEbay',$this->input->post('userEbay'));
                $this->session->set_flashdata('countryName',$this->input->post('countryName'));
                $this->session->set_flashdata('countryExtension',$this->input->post('countryExtension'));
                $this->session->set_flashdata('countryFind',$countryFind->id);
                $this->session->set_flashdata('cities',$this->input->post('cities'));
                $this->session->set_flashdata('regions',$this->input->post('regions'));
                $this->session->set_flashdata('zipcodes',$this->input->post('zipcode'));
                $this->session->set_flashdata('addressLine1',$this->input->post('addressLine1'));
                $this->session->set_flashdata('addressLine2',$this->input->post('addressLine2'));
                $this->session->set_flashdata('errors', "Email or Username al ready register or are invalid");
                redirect('sellers/edit/'.$id);
            }

        }
    }

    /**
     * @param $id = id for delete seller
     */
    public function delete_seller($id)
    {
        $seller = ProfilesEbay::find($id);
        if(count($seller)>0)
        {
                $seller->user->delete();
                foreach ($seller->items as $item)
                {
                    $item->delete();
                }
                $seller->delete();
                $this->session->set_flashdata('success', "Delete user successfully");

        }
        else
        {
             $this->session->set_flashdata('error', "Error in Delete User");
        }
        redirect('sellers/');
    }

    /**
     *Function to list deleted sellers
     * @internal onlyTrashed = only register deleted
     */
    public function list_restore_sellers()
    {
        $sellers = ProfilesEbay::onlyTrashed()->with(array('user'=>function ($query){
            $query->onlyTrashed();
        },'items'=>function($query){
            $query->onlyTrashed();
        }))->get();
        $this->blade->view('Admin.RestoreSellers',compact('sellers'));
    }

    /**
     * @param $id = Profiles Ebay id for restore register
     */
    public function restore_seller($id)
    {
        $seller = ProfilesEbay::onlyTrashed()->with(array('user'=>function ($query){
            $query->onlyTrashed();
        },'items'=>function($query){
            $query->onlyTrashed();
        }))->where('id',$id)->first();
        if(count($seller)>0)
        {
            $seller->user->restore();
            foreach ($seller->items as $item){
                $item->restore();
            }
            $seller->restore();
            $this->session->set_flashdata('info', "Restore user succefull");
        }else{
            $this->session->set_flashdata('error', "Error in restore User");
        }
        redirect('sellers/restore');


    }

    /**
     * @param $id = ProfilesEbay id for update yours items
     */
    public function update_items_list($id)
    {
        $seller = ProfilesEbay::find($id);
        if($this->api_ebay->get_items($seller->username,$seller->id))
        {
            $this->session->set_flashdata('success', "Update items successfully");
        }
        else
        {
            $this->session->set_flashdata('errors', "Error in Update items");
        }
        redirect('/items/list/'.$id);
    }

    /**
     * @param $id = Country id for search regions
     */
    public function get_regions($id)
    {
        try {
            $regions = Region::where('country_id',$id)->selectRaw('CONCAT(name, ", code: ", code) AS name, id')->orderBy('name','ASC')->get();
            if (count($regions) > 0)
            {
                echo json_encode($regions, 200);
            }
            else
            {
                echo json_encode(['error' => 'Data not found'], 450);
            }
        } catch (Exception $e) {
            echo json_encode(['error' => 'Error Conection'], 450);
        }
    }

    /**
     * @param $idRegion = Region id for search cities
     */
    public function get_city_regions($idRegion)
    {
        try {
            $citys = City::where('region_id',$idRegion)->select('name', 'id')->get();
            if (count($citys) > 0)
            {
                echo json_encode($citys, 200);
            }
            else
            {
                echo json_encode(['error' => 'Data not found'], 450);
            }
        } catch (Exception $e) {
            echo json_encode(['error' => 'Error Conection'.$e], 450);
        }
    }


}