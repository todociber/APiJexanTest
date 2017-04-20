<?php

/**
 * Created by PhpStorm.
 * User: Todociber
 * Date: 16/04/2017
 * Time: 11:32 AM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Login_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('blade');
        $authUser = new AuthUser();
        $authUser->redirector();
    }

    public function index(){

        $this->blade->view('Login',compact(validation_errors()));
    }

    public function sign_in(){

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');

        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('email',$this->input->post('email'));
            $this->session->set_flashdata('errors', validation_errors());
           redirect('login');
        }
        else
        {
            $email  = $this->input->post('email');
            $password = $this->input->post('password');
            $user = User::where('email',$email)->first();
            if ($this->bcrypt->check_password($password, $user->password))
            {
                $datasession = array(
                    'user_id'  => $user->id,
                    'user_type' => $user->type_user_id
                );
                $this->session->set_userdata($datasession);
                if($user->type_user_id==1){
                    redirect('sellers');
                }
                echo "OK".var_dump($this->session->userdata('user_type'));
            }
            else
            {
                $this->session->set_flashdata('errors', "Incorrect data");
                redirect('login');
            }
        }
    }

    public function reset_password(){
        $this->blade->view('ResetPassword',compact(validation_errors()));
    }

    public function token($token){
        $token = TokensUser::where('token',$token)->first();
        if(count($token)==0)
        {
            $this->session->set_flashdata('errors', "Incorrect data");
            redirect('login');
        }
        $this->blade->view('ChangePassword',compact(validation_errors(),'token'));
    }

    public function token_change($token){
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('passwordConfirm', 'Password Confirmation', 'required|matches[password]|min_length[6]');

        if ($this->form_validation->run() == FALSE)
        {

            $this->session->set_flashdata('errors', validation_errors());
            redirect('login/token/'.$token);
        }
        $token = TokensUser::where('token',$token)->first();
        if(count($token)!=0)
        {
            $user = User::find($token->users_id);
            $password = $this->input->post('password');
            $hash = $this->bcrypt->hash_password($password);
            $user->fill([
                "password"=>$hash,
            ]);
            $user->save();
            $tokens = TokensUser::where('users_id',$user->id)->get();
            foreach ($tokens as $token) {
                $token->delete();
            }
            $this->session->set_flashdata('info', "Password Challenge");
            redirect('login');
        }else
        {
            $this->session->set_flashdata('error', "Invalid Token");
            redirect('login');
        }


    }

    public function generate_reset(){
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        if ($this->form_validation->run() == FALSE)
        {

            $this->session->set_flashdata('errors', validation_errors());
            redirect('login/reset_password');
        }
        $tokenGenerator = new Token_generator();
        $token = $tokenGenerator->tokens_generator();
        $email  = $this->input->post('email');
        $usuario = User::where('email',$email)->first();
        if($usuario->id!=NULL)
        {
            $emailSend= $this->send_email($usuario->email,$usuario->name,'Reset Password',$token);
            if($emailSend)
            {
                $tokenSave = new TokensUser();
                $tokenSave->fill([
                    "token" =>$token,
                    "users_id"=>$usuario->id
                ]);
                $tokenSave->save();
                $this->session->set_flashdata('success', "Successfully Sent Email");
                redirect('login/reset_password');
            }
            else
             {
                $this->session->set_flashdata('error', "Error Sent Email");
                redirect('login/reset_password');
            }


        }else{
            $this->session->set_flashdata('error', "Invalid Email");
            redirect('login/reset_password');
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
    <title>Reset Password</title>
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
                    <p> With the following link you can reset your password</p></br>
                    <td colspan="4"><a class="brand" href="'.base_url().'login/token/'.$token.'">Reset Password</a></td>
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