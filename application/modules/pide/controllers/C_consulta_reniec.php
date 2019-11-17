<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_consulta_reniec extends MX_Controller
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
        $this->load->view('V_consulta_reniec',$data);
    }

    public function buscarPersona()
    {

        try {
            $dni = $this->input->post('dni') != null ? $this->input->post('dni') : null;
            /*$context  = stream_context_create(array('https' => array('header' => 'Accept: application/xml')));
            $url = 'https://ws5.pide.gob.pe/Rest/Reniec/Consultar?nuDniConsulta='.$dni.'&nuDniUsuario=42442984&nuRucUsuario=20131369639&password=42442984';
            $xml = file_get_contents($url, false, $context);*/
            $xml = '
                    <S:Envelope xmlns:S="http://schemas.xmlsoap.org/soap/envelope/">
                    <S:Body>
                    <w:consultarResponse xmlns:w="http://ws.reniec.gob.pe/">
                    <return>
                    <coResultado>0000</coResultado>
                    <datosPersona>
                    <apPrimer>VALENCIA</apPrimer>
                    <apPrimer>V1</apPrimer>
                    <apSegundo>CRUZADO</apSegundo>
                    <direccion>
                    AV. CANTA CALLAO KM. 6 EX FUNDO LA TABOADA DEPTO. 101 EDIFICIO K CONDOMINIO CIUDAD NUEVA
                    </direccion>
                    <estadoCivil>CASADO </estadoCivil>
                    <foto>
                    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
                    </foto>
                    <prenombres>MAURO ENRIQUE</prenombres>
                    <restriccion>NINGUNA</restriccion>
                    <ubigeo>CALLAO/CALLAO</ubigeo>
                    </datosPersona>
                    <deResultado>Consulta realizada correctamente</deResultado>
                    </return>
                    </w:consultarResponse>
                    </S:Body>
                    </S:Envelope>';
            $doc = new DOMDocument();
            

            $doc->loadXML($xml);
            $logodata = $doc->getElementsByTagName('foto')->item(0)->nodeValue;
            $dir = $doc->getElementsByTagName('direccion')->item(0)->nodeValue;
            $xx = trim($dir);
            

            $data['html'] = '
            <h4>Datos Personales</h4><br>
            <div class="row">
                <div class="col-md-8">
                    <b><span style="color:#063f5d;">Nombres: </span></b><span style="text-transform: capitalize">' . $doc->getElementsByTagName('prenombres')->item(0)->nodeValue . '</span></span><br><br>
                    <b><span style="color:#063f5d">Apellido paterno: </span></b><span style="text-transform: capitalize">' . $doc->getElementsByTagName('apPrimer')->item(0)->nodeValue . '</span><br><br>
                    <b><span style="color:#063f5d">Apellido materno: </span></b><span style="text-transform: capitalize">' . $doc->getElementsByTagName('apSegundo')->item(0)->nodeValue . '</span><br><br>
                    <b><span style="color:#063f5d">Direcci&oacute;n: </span></b><span>' . $xx . '</span><br><br>
                    <b><span style="color:#063f5d">Ubicaci&oacute;n: </span></b><span style="text-transform: capitalize">' . $doc->getElementsByTagName('ubigeo')->item(0)->nodeValue . '</span><br><br>
                    <b><span style="color:#063f5d">Estado civil: </span></b><span style="text-transform: capitalize">' . $doc->getElementsByTagName('estadoCivil')->item(0)->nodeValue . '</span><br><br>
                    <b><span style="color:#063f5d">Restricci&oacute;n: </span></b><span style="text-transform: capitalize">' . $doc->getElementsByTagName('restriccion')->item(0)->nodeValue . '</span><br><br>
                </div>
                <div class="col-md-4 text-center">
                        <span style="display: inline-block;height: 100%;vertical-align: middle;"></span>
                        <img align="center" src="data:image/gif;base64,' . $logodata . '" />
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
