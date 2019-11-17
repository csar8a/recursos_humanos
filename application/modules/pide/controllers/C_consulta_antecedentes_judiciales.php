<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_consulta_antecedentes_judiciales extends MX_Controller
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
        $this->load->view('V_consulta_antecedentes_judiciales',$data);
    }

    public function buscarPersona()
    {

        try {
           /* $nombre = $this->input->post('nombre') != null ? $this->input->post('nombre') : null;
	    $nombre2 = str_replace(" ","%20",$nombre);

            $paterno = $this->input->post('paterno') != null ? $this->input->post('paterno') : null;
	    $paterno2 = str_replace(" ","%20",$paterno);

            $materno = $this->input->post('materno') != null ? $this->input->post('materno') : null;
	    $materno2 = str_replace(" ","%20",$materno);
            $context  = stream_context_create(array('https' => array('header' => 'Accept: application/xml')));
           $url = 'https://ws3.pide.gob.pe/Rest/Inpe/AJudiciales?apepat='.$paterno2.'&apemat='.$materno2.'&nombres='.$nombre2.'';
            $xml = file_get_contents($url, false, $context);*/
            $xml = '
            <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
            <soapenv:Body>
            <getAntecedenteJudicialResponse xmlns="http://endpoint.wsantjudiciales.inpe.gob.pe">
                <getAntecedenteJudicialReturn>No registra antecedentes judiciales</getAntecedenteJudicialReturn>
            </getAntecedenteJudicialResponse>
            </soapenv:Body>
            </soapenv:Envelope>';
            
            $doc = new DOMDocument();
            $doc->loadXML($xml);
            
            
            /* ESTA LINEA DEBE ESTAR DESPUES DE  <h4>Busqueda de Persona</h4><br> 
            <b><span style="color:#063f5d;">Persona Consutada : </span></b><span style="text-transform: capitalize">' .$nombre.' '.$paterno.' '.$materno. '</span></span><br><br>*/
            
            $data['html'] = '
            <h4>Busqueda de Persona</h4><br>
            <div class="row">
                <div class="col-md-8">
                    <b><span style="color:#063f5d;">Resultado: </span></b><span style="text-transform: capitalize">' . $doc->getElementsByTagName('getAntecedenteJudicialReturn')->item(0)->nodeValue. '</span></span><br><br>
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