<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_sav extends MX_Controller {
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_sav');
        $this->load->helper('utils');
        $this->load->libraries(['Utilities']);
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
            'combo_categoria'    => getCategorias(),
            'combo_medio'        => getComboByParametro('MEDIO'),
            'combo_distritos'    => getComboByParametro('DISTRITO'),
            'combo_tipodoc'      => getComboByParametro('TIPODOC'),
            'modulos_usuario_sb' => getModulosDashboard($idRol,$idUsuario)["side"],
            'bar' => 'Servicio de Atención al vecino'
        );
        $this->load->view('V_sav',$data);
    }
    
    public function insertarServicio()
    {
        $data['error'] = EXIT_ERROR;

        try {
            $tipo_doc            = $this->input->post('tipodoc');
            $doc                 = $this->input->post('doc');
            $nombres             = $this->input->post('nombres');
            $ape_paterno         = $this->input->post('paterno');
            $ape_materno         = $this->input->post('materno');
            $telefono            = $this->input->post('telefono');
            $correo              = $this->input->post('correo');
            $distrito            = $this->input->post('distrito');
            $viaPublica          = $this->input->post('viaPublica');
            $urbanizacion        = $this->input->post('urbanizacion');
            $numero              = $this->input->post('numero');
            $interior            = $this->input->post('interior');
            $manzana             = $this->input->post('manzana');
            $lote                = $this->input->post('lote');
                        
            $ip                  = $this->input->ip_address();
            $codigo              = $this->utilities->randomStringLower(6);
            
            $categoria    = $this->input->post('categoria');
            $subcategoria = $this->input->post('subcategoria');
            $medio        = $this->input->post('medio');
            $tema         = $this->input->post('tema');
            $desc         = $this->input->post('desc');

            $datos_persona = array(
                'TIPODOCUMENTO'    => intval($tipo_doc),
                'TXTDOCUMENTO'     => $doc,
                'TXTNOMPERSONA'    => $nombres,
                'TXTAPEPATERNO'    => $ape_paterno,
                'TXTAPEMATERNO'    => $ape_materno,
                'TXTTELEFONO'      => $telefono,
                'TXTCORREO'        => $correo,
                'TXTIPREGISTRO'    => $ip,
                'FLGTRABAJADOR'    => FLG_PERSONA_VECINO,
                'IDDISTRITO'       => intval($distrito),
                'TXTVIAPUBLICA'    => $viaPublica,
                'TXTURBANIZACION'  => $urbanizacion,
                'TXTNUMERO'        => $numero,
                'TXTINTERIOR'      => $interior,
                'TXTMANZANA'       => $manzana,
                'TXTLOTE'          => $lote
            );
            
            $datos_servicio = array(
                'TXTTEMA'        => $tema,
                'TXTDESCRIPCION' => $desc,
                'IDMEDIO'        => intval($medio),
                'IDCATEGORIA'    => intval($categoria),
                'IDSUBCATEGORIA' => intval($subcategoria)
            );

            $data = $this->M_sav->registrarServicio($datos_persona, $datos_servicio);
            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getReclamos()
    {
        try {
            $res = $this->M_sav->getReclamos();
            if($res['error'] != EXIT_SUCCESS) {
                log_message('error', print_r($res, TRUE));
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function send_email() {

        $this->load->library('email');
        $this->email->set_newline("\r\n");

        $this->email->from('munibe.dummy@gmail.com', 'munibe    ');
        $this->email->to('franco.condor.urp@gmail.com');
        $this->email->subject('Email test');

        $this->email->message('Email content');

        if($this->email->send()){
            log_message('error','success');
            return 'success';
        } else {
            log_message('error',$this->email->print_debugger());
            return 'error';
        }
    }

    public function getSubcategorias() {
        $data['error'] = EXIT_ERROR;
        try {
            $categoria   = $this->input->post('categoria');
            
            $data['html'] = getSubcategorias($categoria);
            $data['error'] = EXIT_SUCCESS;
            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
