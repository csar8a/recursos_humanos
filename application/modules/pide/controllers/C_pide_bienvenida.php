<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_pide_bienvenida extends MX_Controller {
    
    function __construct()
    {
        parent::__construct();
        $this->load->helper('utils');
        $sesionU = $this->session->userdata('s_nombreUsuario');
        if (empty($sesionU)) {
            redirect('login');
        }
    }

	public function index()
	{
        $idRol = $this->session->userdata('s_roles');
        $idUsuario = $this->session->userdata('s_idUsuario');
        $data = array(
            
            'modulos_usuario_sb' => getModulosDashboard($idRol,$idUsuario)["side"]
        );
        $this->load->view('V_pide_bienvenida',$data);
    }
}
