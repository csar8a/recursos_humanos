<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_consulta_ultima_sancion extends MX_Controller
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

        'modulos_usuario_sb' => getModulosDashboard($idRol,$idUsuario)["side"],
        'bar' => 'Consulta de Datos'
        );
        $this->load->view('V_consulta_ultima_sancion',$data);
    }


    public function buscarUltimaSancion(){

        try {
            $tipoDoc = $this->input->post('tipo_doc') != null ? $this->input->post('tipo_doc') : null;
            $numeroDoc = $this->input->post('numeroDoc') != null ? $this->input->post('numeroDoc') : null;
            
            /*$context  = stream_context_create(array('https' => array('header' => 'Accept: application/xml')));
            $url = 'https://ws3.pide.gob.pe/Rest/Mtc/UltimasSanciones?iTipoDocumento=.$tipoDoc.&sNumDocumento=.$numeroDoc.';
            $xml = file_get_contents($url, false, $context);*/
            
            $xml = '
            <soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
            <soap:Body>
               <GetDatosUltimasSancionesMTCResponse xmlns="http://wsdr.mtc.gob.pe/">
                <mensaje>
                    <dc>El administrado no posee sanciones.</dc>
                </mensaje>
               </GetDatosUltimasSancionesMTCResponse>
            </soap:Body>
            </soap:Envelope>';

            //$xml = preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', $xml);
            $doc = new DOMDocument();
            //$doc->preserveWhiteSpace = true;
            $doc->loadXML($xml);

            $mensaje = $doc->getElementsByTagName('dc')->item(0)->nodeValue;
            //log_message('error',print_r($mensaje,true));

            $data['html'] = '
            <h4>Datos Personales</h4><br>
            <div class="row">
                <div class="col-md-8">
                <b><span style="color:#063f5d">Estado: </span></b><span>' . $mensaje . '</span><br><br>
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