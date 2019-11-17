<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_consulta_PCM extends MX_Controller
{

    public function __construct()
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
            'modulos_usuario_sb' => getModulosDashboard($idRol, $idUsuario)["side"],
            'bar' => 'Consulta de Datos',
        );
        $this->load->view('V_consulta_PCM', $data);
    }

    public function enviarMensaje()
    {

        try {
            $usuario = '';
            $keyws = '';
            $celular = $this->input->post('celular') != null ? $this->input->post('celular') : null;
            $mensaje = $this->input->post('mensaje') != null ? $this->input->post('mensaje') : null;

            $soapclient = new SoapClient('http://ws3.pide.gob.pe/services/PcmSms?wsdl');
            $param = array('usuario' => $usuario,'keyws' => $keyws,'celular' => $celular,'mensaje' => $mensaje);
            $response = $soapclient->Soap.envioSMS($param);

            $data['html'] = '
            <div class="row">
                <div class="col-md-12"> 
                    <b><span style="color:#063f5d;">Respuesta: </span></b><span>' . $response->return . '</span></span><br><br>
                </div>
            </div>
            ';

            $data['error'] = EXIT_SUCCESS;
            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
