<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_consulta_sunarp extends MX_Controller
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

        'modulos_usuario_sb' => getModulosDashboard($idRol, $idUsuario)["side"],
        'bar' => 'Consulta de Datos',
        );
        $this->load->view('V_consulta_sunarp',$data);
    }

    public function buscarSUNARP()
    {
        try {
            $razonsocial = $this->input->post('razonsocial') != null ? $this->input->post('razonsocial') : null;
            $context = stream_context_create(array('https' => array('header' => 'Accept: application/xml')));
            //$url = 'https://ws5.pide.gob.pe/Rest/Reniec/Consultar?nuDniConsulta=' . $razonsocial . '&nuDniUsuario=42442984&nuRucUsuario=20131369639&password=42442984';
           // $url = 'https://ws3.pide.gob.pe/Rest/Sunarp/PJRazonSocial?razonSocial='.$razonsocial.'';
            //$xml = file_get_contents($url, false, $context);
            $doc = new DOMDocument();
            $xml = '
            <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
            <soapenv:Header>
                <ns2:personaJuridica xmlns:ns2="http://controller.pide.sunarp.gob.pe/">
                    <resultado>
                        <zona>ZONA REGISTRAL IX - LIMA</zona>
                        <oficina>LIMA</oficina>
                        <partida>02323478</partida>
                        <tomo>000009</tomo>
                        <folio>000173</folio>
                        <tipo>ASOCIACIONES</tipo>
                        <denominacion>ASOCIACION CASA GRANDINA JUAN GILDEMEISTER</denominacion>
                    </resultado>
                    <resultado>
                        <zona>ZONA REGISTRAL VII - HUARAZ</zona>
                        <oficina>CHIMBOTE</oficina>
                        <partida>02007532</partida>
                        <ficha>0000000749</ficha>
                        <tipo>ASOCIACIONES</tipo>
                        <denominacion>
        ASOCIACION DE COMERCIANTES MUELLE GILDEMEISTER LA CALETA
                        </denominacion>
                    </resultado>
                    <resultado>
                        <zona>ZONA REGISTRAL V - TRUJILLO</zona>
                        <oficina>TRUJILLO</oficina>
                        <partida>11191487</partida>
                        <tipo>ASOCIACIONES</tipo>
                        <denominacion>
        ASOCIACION DE INQUILINOS DE LA BENEFICENCIA PUBLICA DE TRUJILLO JUAN S. GILDEMEISTER Y OTROS
                        </denominacion>
                    </resultado>
                    <resultado>
                        <zona>ZONA REGISTRAL V - TRUJILLO</zona>
                        <oficina>HUAMACHUCO</oficina>
                        <partida>11013067</partida>
                        <tipo>ASOCIACIONES</tipo>
                        <denominacion>ASOCIACION DE TRANSPORTISTAS GILDEMEISTER</denominacion>
                    </resultado>
                    <resultado>
                        <zona>ZONA REGISTRAL IX - SEDE LIMA</zona>
                        <oficina>LIMA</oficina>
                        <partida>11324196</partida>
                        <tipo>
        PODERES OTORGADOS POR SOCIEDADES CONSTITUIDAS O SUCURSALES ESTABLECIDAS EN EL EXTRANJERO
                        </tipo>
                        <denominacion>AUTOMOTORES GILDEMEISTER S.A</denominacion>
                    </resultado>
                    <resultado>
                        <zona>ZONA REGISTRAL IX - SEDE LIMA</zona>
                        <oficina>LIMA</oficina>
                        <tipo>SOCIEDADES ANONIMAS</tipo>
                        <denominacion>AUTOMOTORES GILDEMEISTER S.A</denominacion>
                    </resultado>
                    <resultado>
                        <zona>ZONA REGISTRAL IX - LIMA</zona>
                        <oficina>LIMA</oficina>
                        <tipo>SOCIEDADES ANONIMAS</tipo>
                        <denominacion>AUTOMOTORES GILDEMEISTER-PERU S.A.</denominacion>
                    </resultado>
                    <resultado>
                        <zona>ZONA REGISTRAL IX - LIMA</zona>
                        <oficina>LIMA</oficina>
                        <tipo>SOCIEDADES ANONIMAS</tipo>
                        <denominacion>AUTOMOTORES GILDEMEISTER-PERU S.A.</denominacion>
                    </resultado>
                    <resultado>
                        <zona>ZONA REGISTRAL IX - SEDE LIMA</zona>
                        <oficina>LIMA</oficina>
                        <partida>11473969</partida>
                        <tipo>SOCIEDADES ANONIMAS</tipo>
                        <denominacion>AUTOMOTORES GILDEMEISTER-PERU S.A.</denominacion>
                    </resultado>
                    <resultado>
                        <zona>ZONA REGISTRAL IX - SEDE LIMA</zona>
                        <oficina>LIMA</oficina>
                        <tipo>
        PODERES OTORGADOS POR SOCIEDADES CONSTITUIDAS O SUCURSALES ESTABLECIDAS EN EL EXTRANJERO
                        </tipo>
                        <denominacion>AUTOMOTORES GILDEMEISTER-PERU S.A.</denominacion>
                    </resultado>
                    <resultado>
                        <zona>ZONA REGISTRAL V - TRUJILLO</zona>
                        <oficina>TRUJILLO</oficina>
                        <partida>03143160</partida>
                        <tomo>000003</tomo>
                        <folio>000213</folio>
                        <tipo>ASOCIACIONES</tipo>
                        <denominacion>CLUB DEPORTIVO AUGUSTO GILDEMEISTER</denominacion>
                    </resultado>
                    <resultado>
                        <zona>ZONA REGISTRAL V - TRUJILLO</zona>
                        <oficina>TRUJILLO</oficina>
                        <tipo>ASOCIACIONES</tipo>
                        <denominacion>CLUB DEPORTIVO AUGUSTO GILDEMEISTER SAUSAL</denominacion>
                    </resultado>
                    <resultado>
                        <zona>ZONA REGISTRAL V - TRUJILLO</zona>
                        <oficina>HUAMACHUCO</oficina>
                        <partida>11005806</partida>
                        <tipo>ORGANIZACIONES SOCIALES DE BASE</tipo>
                        <denominacion>COMEDOR POPULAR AUTOGESTIONARIO GILDEMEISTER</denominacion>
                    </resultado>
                    <resultado>
                        <zona>ZONA REGISTRAL IX - SEDE LIMA</zona>
                        <oficina>LIMA</oficina>
                        <partida>11655950</partida>
                        <tipo>EMPRESAS INDIVIDUALES DE RESPONSABILIDAD LIMITADA</tipo>
                        <denominacion>FELIPE MAYSER GILDEMEISTER EIRL</denominacion>
                    </resultado>
                    <resultado>
                        <zona>ZONA REGISTRAL IX - LIMA</zona>
                        <oficina>LIMA</oficina>
                        <partida>02328917</partida>
                        <tomo>000001</tomo>
                        <folio>000017</folio>
                        <tipo>FUNDACIONES</tipo>
                        <denominacion>FUNDACION GILDEMEISTER</denominacion>
                    </resultado>
                    <resultado>
                        <zona>ZONA REGISTRAL IX - LIMA</zona>
                        <oficina>LIMA</oficina>
                        <partida>02010593</partida>
                        <tipo>FUNDACIONES</tipo>
                        <denominacion>FUNDACION PEDRO DE OSMA GILDEMEISTER</denominacion>
                    </resultado>
                    <resultado>
                        <zona>ZONA REGISTRAL IX - SEDE LIMA</zona>
                        <oficina>LIMA</oficina>
                        <tipo>
        PODERES OTORGADOS POR SOCIEDADES CONSTITUIDAS O SUCURSALES ESTABLECIDAS EN EL EXTRANJERO
                        </tipo>
                        <denominacion>FUNDACION PEDRO Y ANGELICA DE OSMA GILDEMEISTER</denominacion>
                    </resultado>
                    <resultado>
                        <zona>ZONA REGISTRAL IX - LIMA</zona>
                        <oficina>LIMA</oficina>
                        <partida>02009110</partida>
                        <ficha>0000002020</ficha>
                        <tipo>FUNDACIONES</tipo>
                        <denominacion>FUNDACION PEDRO Y ANGELICA DE OSMA GILDEMEISTER</denominacion>
                    </resultado>
                    <resultado>
                        <zona>ZONA REGISTRAL IX - LIMA</zona>
                        <oficina>LIMA</oficina>
                        <tipo>
        PODERES OTORGADOS POR SOCIEDADES CONSTITUIDAS O SUCURSALES ESTABLECIDAS EN EL EXTRANJERO
                        </tipo>
                        <denominacion>GILDEMEISTER & CIA S.A.</denominacion>
                    </resultado>
                    <resultado>
                        <zona>ZONA REGISTRAL IX - LIMA</zona>
                        <oficina>LIMA</oficina>
                        <partida>01710796</partida>
                        <ficha>0000002308</ficha>
                        <tipo>SOCIEDADES CIVILES </tipo>
                        <denominacion>
        GILDEMEISTER & GILDEMEISTER ABOGADOS SOCIEDAD CIVIL
                        </denominacion>
                    </resultado>
                    <resultado>
                        <zona>ZONA REGISTRAL VII - HUARAZ</zona>
                        <oficina>CHIMBOTE</oficina>
                        <partida>07032520</partida>
                        <tomo>000042</tomo>
                        <folio>000003</folio>
                        <tipo>EMPRESAS INDIVIDUALES DE RESPONSABILIDAD LIMITADA</tipo>
                        <denominacion>GILDEMEISTER CASTILLO E.I.R.L.</denominacion>
                    </resultado>
                    <resultado>
                        <zona>ZONA REGISTRAL IX - LIMA</zona>
                        <oficina>LIMA</oficina>
                        <partida>00019321</partida>
                        <ficha>0000123088</ficha>
                        <tipo>SOCIEDADES ANONIMAS</tipo>
                        <denominacion>GILDEMEISTER INTER SPORT</denominacion>
                    </resultado>
                    <resultado>
                        <zona>ZONA REGISTRAL IX - LIMA</zona>
                        <oficina>LIMA</oficina>
                        <partida>11923355</partida>
                        <tipo>SOCIEDADES ANONIMAS</tipo>
                        <denominacion>GILDEMEISTER TRADING S.A.C.</denominacion>
                    </resultado>
                    <resultado>
                        <zona>ZONA REGISTRAL IX - SEDE LIMA</zona>
                        <oficina>LIMA</oficina>
                        <partida>11038562</partida>
                        <tipo>SOCIEDADES ANONIMAS</tipo>
                        <denominacion>GILDEMEISTER Y CO. S.A.</denominacion>
                    </resultado>
                    <resultado>
                        <zona>ZONA REGISTRAL IX - LIMA</zona>
                        <oficina>LIMA</oficina>
                        <partida>02433176</partida>
                        <tomo>000169</tomo>
                        <folio>000101</folio>
                        <tipo>SOCIEDADES ANONIMAS</tipo>
                        <denominacion>KLOSE Y GILDEMEISTER SOCIEDAD ANONIMA</denominacion>
                    </resultado>
                    <resultado>
                        <zona>ZONA REGISTRAL IX - LIMA</zona>
                        <oficina>LIMA</oficina>
                        <partida>11303127</partida>
                        <tipo>SOCIEDADES ANONIMAS</tipo>
                        <denominacion>KLOSE Y GILDEMEISTER SOCIEDAD ANONIMA CERRADA</denominacion>
                    </resultado>
                    <resultado>
                        <zona>ZONA REGISTRAL IX - LIMA</zona>
                        <oficina>LIMA</oficina>
                        <partida>03024917</partida>
                        <ficha>0000120291</ficha>
                        <tomo>000120</tomo>
                        <folio>000295</folio>
                        <tipo>SOCIEDADES ANONIMAS</tipo>
                        <denominacion>MATIAS GILDEMEISTER S.A.</denominacion>
                    </resultado>
                    <resultado>
                        <zona>ZONA REGISTRAL IX - LIMA</zona>
                        <oficina>LIMA</oficina>
                        <partida>06000356</partida>
                        <tomo>000001</tomo>
                        <folio>000139</folio>
                        <tipo>SOCIEDADES CIVILES </tipo>
                        <denominacion>
        MATIAS GILDEMEISTER Y COMPAQIA SOCIEDAD CIVIL DE RESPONSABILIDAD LIMITADA
                        </denominacion>
                    </resultado>
                    <resultado>
                        <zona>ZONA REGISTRAL IX - LIMA</zona>
                        <oficina>LIMA</oficina>
                        <partida>02447843</partida>
                        <tipo>SOCIEDADES MERCANTILES/COLECTIVAS</tipo>
                        <denominacion>MATIAS GILDEMEISTER Y COMPAÑIA SCRL V</denominacion>
                    </resultado>
                    <resultado>
                        <zona>ZONA REGISTRAL V - TRUJILLO</zona>
                        <oficina>TRUJILLO</oficina>
                        <partida>03146457</partida>
                        <ficha>0000001853</ficha>
                        <tipo>ASOCIACIONES</tipo>
                        <denominacion>SOCIEDAD DE TIRO JUAN GILDEMEISTER SUCURSAL N 271</denominacion>
                    </resultado>
                </ns2:personaJuridica>
            </soapenv:Header>
            <soapenv:Body>
                <rpcOp:buscarPJRazonSocialResponse xmlns:rpcOp="http://controller.pide.sunarp.gob.pe/"
                    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"/>
            </soapenv:Body>
        </soapenv:Envelope>';

            $xml = preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', $xml);

            $doc->preserveWhiteSpace = false;
            $doc->loadXML($xml);
            $i = 0;
            

            //envio de datos
            $usuario = $this->session->userdata('s_nombreUsuario');
            $ip = $this->input->ip_address();
            $consulta = "CONSULTA PIDE SUNARP";
            $entrada= "Razon social:".$razonsocial;

            
            $datos_pide = array(
                'USUARIO'          => $usuario,
                'TXTIPCONSULTA'      => $ip,
                'TXTCONSULTAPIDE'         => $consulta,
                'DATOSENTRADA'     => $entrada,
                'DATOSSSALIDA'           => strval($xml)
            );

           $data = $this->M_utils->insertarPideConsulta($datos_pide);
           $busqueda =  $data['codigo'];

            //envio de datos

            $data['html'] = "";

            $data['html'] .= '
            <b><span style="color:#063f5d;">Código de Búsqueda: </span></b><span  style="text-transform: capitalize">' .$busqueda.'</span></span><br>
            <table class="table">
            <tr>
                <th>#</th>
                <th>Zona</th>
                <th>Oficina</th>
                <th>Partida</th>
                <th>Ficha</th>
                <th>N°  Tomo </th>
                <th>N°  Folio </th>
                <th>Tipo de persona</th>
                <th>Denominación o Razón Social</th>
            </tr>
            ';

            //Cada bloque se trae aca
            while ($sunarp = $doc->getElementsByTagName("resultado")->item($i)) {
                $data['html'] .= '<tr>';

                //Evaluar si no es nulo
                $zona = $sunarp->getElementsByTagName('zona')->item(0);
                isset($zona) ? $zona = $zona->nodeValue : $zona = "--";

                $oficina = $sunarp->getElementsByTagName('oficina')->item(0);
                isset($oficina) ? $oficina = $oficina->nodeValue : $oficina = "--";

                $partida = $sunarp->getElementsByTagName('partida')->item(0);
                isset($partida) ? $partida = $partida->nodeValue : $partida = "--";

                $ficha = $sunarp->getElementsByTagName('ficha')->item(0);
                isset($ficha) ? $ficha = $ficha->nodeValue : $ficha = "--";

                $tomo = $sunarp->getElementsByTagName('tomo')->item(0);
                isset($tomo) ? $tomo = $tomo->nodeValue : $tomo = "--";

                $folio = $sunarp->getElementsByTagName('folio')->item(0);
                isset($folio) ? $folio = $folio->nodeValue : $folio = "--";

                $tipo = $sunarp->getElementsByTagName('tipo')->item(0);
                isset($tipo) ? $tipo = $tipo->nodeValue : $tipo = "--";

                $denominacion = $sunarp->getElementsByTagName('denominacion')->item(0);
                isset($denominacion) ? $denominacion = $denominacion->nodeValue : $denominacion = "--";

                

                //Formatear tabla

                $data['html'] .= '
                        <td>'. $i .'</td>
                        <td>'. $zona .'</td>
                        <td>'. $oficina .'</td>
                        <td>'. $partida .'</td>
                        <td>'. $ficha .'</td>
                        <td>'. $tomo .'</td>
                        <td>'. $folio .'</td>
                        <td>'. $tipo .'</td>
                        <td>'. $denominacion .'</td>
                    ';

                $data['html'] .= '</tr>';
                $i++;
            }
            
            $data['html'] .= '</table>';

            $data['error'] = EXIT_SUCCESS;
            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}
