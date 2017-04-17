<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
	public function index()
	{
        $this->load->model('UsersModels');
        $this->load->model('TelephoneModels');
        $password = 'todociber';
        $hash = $this->bcrypt->hash_password($password);
        $NuevoUsuario = new UsersModels();
        $NuevoUsuario->fill([
           "email"=>$this->bcrypt->hash_password("Todociber"),
            "username"=>"todociberEsLaLey",
            "password"=>$hash
        ]);
        $NuevoUsuario->save();

        $usuarios = UsersModels::where('email','prueba@test1.com')->get();
        echo $usuarios->count();
		foreach ($usuarios as $usuario){
		    echo $usuario->email.'</br>';
		   foreach ($usuario->usuariosTelephone as $usuarioTelephone){
		       echo  $usuarioTelephone->direactions.'</br>';
           }
        }
	}
}
