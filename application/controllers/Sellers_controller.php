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
        $authUser = new AuthUser();
        if(!$authUser->is_admin()){
            redirect('login/logout');
        }
    }

    public function index()
    {
        $sellers = ProfilesEbay::all();
        $this->blade->view('Admin.ShowSellers',compact('sellers'));
    }

    public function new_seller(){
        $zipcodes = Zipcode::all();
        $this->blade->view('Admin.NewSeller',compact('zipcodes'));
    }

    public function get_zipcodes(){
        if(!empty($this->input->get("q")))
        {
            $zip = $this->input->get("q");
            $zicodes = Zipcode::Where('ZIP', 'like', '%' . $zip . '%')
                ->orWhere('City', 'like', '%' . $zip . '%')
                ->orWhere('State', 'like', '%' . $zip . '%')
                ->orWhere('County', 'like', '%' . $zip . '%')
                ->selectRaw('CONCAT( ZIP ," ", City, " ", State," ",County ) as text, id')->get();

            echo json_encode($zicodes);
        }
    }

    public function save_new_seller(){
        $this->form_validation->set_rules('name', 'Name', 'required|regex_match[/^([a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/]');
        $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|regex_match[/^([a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/]');
        $this->form_validation->set_rules('phoneNumber', 'Phone number', 'trim|required|exact_length[12]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('userEbay', 'User Ebay', 'trim|required|alpha_numeric_spaces|callback_comprobate_seller_name');
        $this->form_validation->set_rules('zipcodes', 'City', 'trim|required|is_natural_no_zero|callback_comprobate_zipcode_validator');
        $this->form_validation->set_rules('addressLine1', 'Address Line 1', 'trim|required');
        $this->form_validation->set_rules('addressLine2', 'Address Line 2', 'trim');
        if (!$this->form_validation->run())
        {
            $this->session->set_flashdata('name',$this->input->post('name'));
            $this->session->set_flashdata('lastname',$this->input->post('lastname'));
            $this->session->set_flashdata('phoneNumber',$this->input->post('phoneNumber'));
            $this->session->set_flashdata('email',$this->input->post('email'));
            $this->session->set_flashdata('userEbay',$this->input->post('userEbay'));
            $this->session->set_flashdata('zipcodes',$this->input->post('zipcodes'));
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
                    "users_id"=>$newUser->id,
                    "type_of_phones_id"=>1,
                ]);
                $phoneUser->save();
                $addressUser = new Address();
                $addressUser->fill([
                    "Address_line_one"=>$this->input->post('addressLine1'),
                    "Address_line_two"=>$this->input->post('addressLine2'),
                    "zipcodes_id"=>$this->input->post('zipcodes'),
                    "users_id"=>$newUser->id
                ]);
                $addressUser->save();
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
                $this->send_email($newUser->email,$newUser->name,"Account Activate",$tokenUser->token);
                 $this->session->set_flashdata('success', "Successfully Registered User");
                 redirect('sellers/new');
             }
             else
             {
                 $this->session->set_flashdata('name',$this->input->post('name'));
                 $this->session->set_flashdata('lastname',$this->input->post('lastname'));
                 $this->session->set_flashdata('phoneNumber',$this->input->post('phoneNumber'));
                 $this->session->set_flashdata('email',$this->input->post('email'));
                 $this->session->set_flashdata('userEbay',$this->input->post('userEbay'));
                 $this->session->set_flashdata('zipcodes',$this->input->post('zipcodes'));
                 $this->session->set_flashdata('addressLine1',$this->input->post('addressLine1'));
                 $this->session->set_flashdata('addressLine2',$this->input->post('addressLine2'));
                 $this->session->set_flashdata('errors', "Error obtaining Seller Information");
                 redirect('sellers/new');
             }
            }

        }
    }

    public function comprobate_zipcode_validator() {
        $zipcode = $this->input->post('zipcodes');
        $zipcodeFind = Zipcode::find($zipcode);

        if (count($zipcodeFind)==0)
        {
            $this->form_validation->set_message('comprobate_zipcode_validator', 'City is invalid');
            return FALSE;
        } else
        {
            return true;
        }
    }
    public function comprobate_seller_name() {
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

    private function send_email($email,$nombre,$asunto,$token){

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

        $this->email->to($email, $nombre);
        $this->email->subject($asunto);
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
                    <td><h2><b>'. $nombre.'</b></h2></td></br>
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
}