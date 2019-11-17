<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_consulta_ultima_licencia extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('utils');
        $this->load->model('M_utils');

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
        $this->load->view('V_consulta_ultima_licencia',$data);
    }

    public function buscarUltimaLicencia(){

        try {
            $tipoDoc = $this->input->post('tipo_doc') != null ? $this->input->post('tipo_doc') : null;
            $numeroDoc = $this->input->post('numeroDoc') != null ? $this->input->post('numeroDoc') : null;
            
            /*
            $context  = stream_context_create(array('https' => array('header' => 'Accept: application/xml')));
            $url = 'https://ws3.pide.gob.pe/Rest/Mtc/UltimaLicencia?iTipoDocumento='.$tipoDoc.'&sNumDocumento='.$numeroDoc;
            $xml = file_get_contents($url, false, $context);*/

            
        
    
            $xml = '
            <soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
            <soap:Body>
               <GetDatosUltimaLicenciaMTCResponse xmlns="http://wsdr.mtc.gob.pe/">
                <return>
                <coResultado>0000</coResultado>
                
                <datosPersona>
                    <TIPO_DOC>2</TIPO_DOC>
                     <NUM_DOCUMENTO>07836030</NUM_DOCUMENTO>
                     <NUM_LICENCIA>Q07836030</NUM_LICENCIA>
                     <CATEGORIA>A IIb</CATEGORIA>
                     <APE_PATERNO>CHOCCE</APE_PATERNO>
                     <APE_MATERNO>AGUILAR</APE_MATERNO>
                     <NOMBRE>FILOMENO</NOMBRE>
                     <RESTRICCION>CON LENTES</RESTRICCION>
                     <FECREV>23/11/2019</FECREV>
                     <FECEXP>19/05/1998</FECEXP>
                     <ESTADO>Vigente</ESTADO>
                </datosPersona>
                <deResultado>Consulta realizada correctamente</deResultado>
                </return>
                </GetDatosUltimaLicenciaMTCResponse>
            </soap:Body>
            </soap:Envelope>';

            $doc = new DOMDocument();
            $doc->loadXML($xml);

             //envio de datos
             $usuario = $this->session->userdata('s_nombreUsuario');
             $ip = $this->input->ip_address();
             $consulta = "CONSULTA PIDE ULTIMA LICENCIA";
             $entrada= "Tipo de Doc :".$tipoDoc.",Numero de doc :".$numeroDoc;
 
             
              $datos_pide = array(
                 'USUARIO'          => $usuario,
                 'TXTIPCONSULTA'      => $ip,
                 'TXTCONSULTAPIDE'         => $consulta,
                 'DATOSENTRADA'     => $entrada,
                 'DATOSSSALIDA'           => strval($xml)
             );
 
             $data = $this->M_utils->insertarPideConsulta($datos_pide);
             //$mac = exec('getmac');
          
            $string=exec('getmac');
            $mac=substr($string, 0, 17); 
             
             //envio de datos

            $data['html'] = '
            <h4>Datos Personales</h4><br>
            <b><span style="color:#063f5d">MAC:</span></b><span>'.$mac.'</span><br><br>
            <div class="row">
                <div class="col-md-8">
                <b><span style="color:#063f5d">Tipo de Documento: </span></b><span>' . $doc->getElementsByTagName('TIPO_DOC')->item(0)->nodeValue . '</span><br><br>
                <b><span style="color:#063f5d">N&uacute;mero de Documento: </span></b><span>' . $doc->getElementsByTagName('NUM_DOCUMENTO')->item(0)->nodeValue . '</span><br><br>
                <b><span style="color:#063f5d">N&uacute;mero de Licencia: </span></b><span>' . $doc->getElementsByTagName('NUM_LICENCIA')->item(0)->nodeValue . '</span><br><br>
                <b><span style="color:#063f5d">Categor&iacute;a: </span></b><span>' . $doc->getElementsByTagName('CATEGORIA')->item(0)->nodeValue . '</span><br><br>
                <b><span style="color:#063f5d">Apellido Paterno: </span></b><span>' . $doc->getElementsByTagName('APE_PATERNO')->item(0)->nodeValue . '</span><br><br>
                <b><span style="color:#063f5d">Apellido Materno: </span></b><span>' . $doc->getElementsByTagName('APE_MATERNO')->item(0)->nodeValue . '</span><br><br>
                <b><span style="color:#063f5d">Nombre: </span></b><span>' . $doc->getElementsByTagName('NOMBRE')->item(0)->nodeValue . '</span><br><br>
                <b><span style="color:#063f5d">Restricci&oacute;n: </span></b><span>' . $doc->getElementsByTagName('RESTRICCION')->item(0)->nodeValue . '</span><br><br>
                <b><span style="color:#063f5d">Fecha de Rev.: </span></b><span>' . $doc->getElementsByTagName('FECREV')->item(0)->nodeValue . '</span><br><br>
                <b><span style="color:#063f5d">Fecha de Exp.: </span></b><span>' . $doc->getElementsByTagName('FECEXP')->item(0)->nodeValue . '</span><br><br>
                <b><span style="color:#063f5d">Estado: </span></b><span>' . $doc->getElementsByTagName('ESTADO')->item(0)->nodeValue . '</span><br><br>
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