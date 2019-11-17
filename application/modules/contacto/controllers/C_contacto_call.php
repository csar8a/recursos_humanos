<?php 
//(defined('BASEPATH')) OR exit('No direct script access allowed');

class C_contacto_call extends MX_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_contacto_call');
        $this->load->helper('utils');
        $sesionU = $this->session->userdata('s_nombreUsuario');
        if (empty($sesionU)) {
            redirect('login');
        }
    }
    
    public function index()
    {
        /*$idRol = $this->session->userdata('s_roles');
        $idUsuario = $this->session->userdata('s_idUsuario');
        $idarea  = $this->session->userdata('s_area');
        $data = array(
            'modulos_usuario_sb' => getModulosDashboard($idRol,$idUsuario)["side"],
            'bar'          => 'Contacto y Sugerencias',
            'combo_area'   => getAreas($idarea),
            'tb_contactos' => $this->cargarDatosContacto()
        );*/
        $data['idcontacto'] = $_GET['id'];
        $data['llamada']    = $_GET['tel'];
        $data['codigo']    = $_GET['codigo'];
        $fecha = $_GET['fec'];
        $fecha = strval($fecha{1}.$fecha{2}.'/'.$fecha{3}.$fecha{4}.'/'.$fecha{5}.$fecha{6}.$fecha{7}.$fecha{8});
        
        $time = $_GET['time'];
        $time = strval($time{1}.$time{2}.':'.$time{3}.$time{4});
        $data['fecha']      = $fecha.' '.$time;
        $this->load->view('contacto/V_contacto_call', $data);
    }

    function guardarContacto(){
        $data['error'] = EXIT_ERROR; 
        
        try {
            $id    = $this->input->post('idcontacto');
            if($id == null){
                echo json_encode($data);return;
            }

            $pat  = $this->input->post('paterno');
            $mat  = $this->input->post('materno');
            $nom  = $this->input->post('nombres');
            $est  = $this->input->post('estado');
            $msj  = $this->input->post('mensaje');
            $asun = $this->input->post('asunto');
            
            
            $data     = $this->M_contacto_call->guardarContacto($id, $pat, $mat, $nom, $est, $msj, $asun);
            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}
