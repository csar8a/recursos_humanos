<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_consulta_papeletas extends MX_Controller
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
        $this->load->view('V_consulta_papeletas',$data);
    }

public function buscarPapeletas(){
  
    try{
        $tipoDoc = $this->input->post('tipo_doc') != null ? $this->input->post('tipo_doc') : null;
        $numeroDoc = $this->input->post('numeroDoc') != null ? $this->input->post('numeroDoc') : null;
        /*
        $context = stream_context_create(array('https' => array('header' => 'Accept: application/xml')));
        $url = 'https://ws3.pide.gob.pe/Rest/Mtc/DatosPapeletas?iTipoDocumento=.$tipoDoc.&sNumDocumento=.$numeroDoc.';
        $xml = file_get_contents($url, false, $context);
        */
        $xml = '
            <soap:envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
            <soap:body>
                <getdatospapeletasmtcresponse xmlns="http://wsdr.mtc.gob.pe/">
                    <getdatospapeletasmtcresult>
                        <xs:schema xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns="" xmlns:msdata="urn:schemas-microsoft-com:xml-msdata" xmlns:msprop="urn:schemas-microsoft-com:xml-msprop" id="NewDataSet">
                        <xs:element name="NewDataSet" msdata:isdataset="true" msdata:maindatatable="Table" msdata:usecurrentlocale="true">
                            <xs:complextype>
                                <xs:choice minoccurs="0" maxoccurs="unbounded">
                                    <xs:element name="Table" msprop:refcursorname="REFCursor">
                                    <xs:complextype>
                                        <xs:sequence>
                                            <xs:element name="COD_ADMINISTRADO" msprop:oradbtype="112" type="xs:int" minoccurs="0">
                                                <xs:element name="NUM_INFRACCION" msprop:oradbtype="107" type="xs:decimal" minoccurs="0">
                                                <xs:element name="COD_ENTIDAD" msprop:oradbtype="112" type="xs:int" minoccurs="0">
                                                    <xs:element name="ENTIDAD" msprop:oradbtype="126" type="xs:string" minoccurs="0">
                                                        <xs:element name="PAPELETA" msprop:oradbtype="126" type="xs:string" minoccurs="0">
                                                            <xs:element name="DAT_FECHA_FIRME" msprop:oradbtype="106" type="xs:dateTime" minoccurs="0">
                                                            <xs:element name="VAR_NRO_RESOLUCION" msprop:oradbtype="126" type="xs:string" minoccurs="0">
                                                                <xs:element name="FALTA" msprop:oradbtype="126" type="xs:string" minoccurs="0">
                                                                    <xs:element name="FEC_INFRACCION" msprop:oradbtype="126" type="xs:string" minoccurs="0">
                                                                        <xs:element name="FEC_FIRME" msprop:oradbtype="126" type="xs:string" minoccurs="0">
                                                                        <xs:element name="PUNTOS_x0020_FIRMES" msprop:oradbtype="107" type="xs:decimal" minoccurs="0">
                                                                            <xs:element name="P._x0020_PROCESO" msprop:oradbtype="107" type="xs:decimal" minoccurs="0">
                                                                                <xs:element name="ESTADO" msprop:oradbtype="126" type="xs:string" minoccurs="0">
                                                                                    <xs:element name="TIPOPIT" msprop:oradbtype="126" type="xs:string" minoccurs="0" />
                                                                                </xs:element>
                                                                            </xs:element>
                                                                        </xs:element>
                                                                        </xs:element>
                                                                    </xs:element>
                                                                </xs:element>
                                                            </xs:element>
                                                            </xs:element>
                                                        </xs:element>
                                                    </xs:element>
                                                </xs:element>
                                                </xs:element>
                                            </xs:element>
                                        </xs:sequence>
                                    </xs:complextype>
                                    </xs:element>
                                </xs:choice>
                            </xs:complextype>
                        </xs:element>
                        </xs:schema>
                        <diffgr:diffgram xmlns:diffgr="urn:schemas-microsoft-com:xml-diffgram-v1" xmlns:msdata="urn:schemas-microsoft-com:xml-msdata">
                        <newdataset xmlns="">
                            <cod_administrado>709652</cod_administrado>
                            <num_infraccion>22576082</num_infraccion>
                            <cod_entidad>112</cod_entidad>
                            <entidad>SAT LIMA</entidad>
                            <papeleta>12056309</papeleta>
                            <dat_fecha_firme>2017-11-21T00:00:00-05:00</dat_fecha_firme>
                            <var_nro_resolucion>17605601476075</var_nro_resolucion>
                            <falta>G41</falta>
                            <fec_infraccion>18/05/2017</fec_infraccion>
                            <fec_firme>21/11/2017</fec_firme>
                            <puntos_x0020_firmes>20</puntos_x0020_firmes>
                            <p._x0020_proceso>0</p._x0020_proceso>
                            <estado>FIRME</estado>
                            <tipopit>G</tipopit>
                            <table diffgr:id="Table1" msdata:roworder="0" />
                            <cod_administrado>709652</cod_administrado>
                            <num_infraccion>22577660</num_infraccion>
                            <cod_entidad>112</cod_entidad>
                            <entidad>SAT LIMA</entidad>
                            <papeleta>12056526</papeleta>
                            <dat_fecha_firme>2017-11-21T00:00:00-05:00</dat_fecha_firme>
                            <var_nro_resolucion>17605601476076</var_nro_resolucion>
                            <falta>G47</falta>
                            <fec_infraccion>17/05/2017</fec_infraccion>
                            <fec_firme>21/11/2017</fec_firme>
                            <puntos_x0020_firmes>20</puntos_x0020_firmes>
                            <p._x0020_proceso>0</p._x0020_proceso>
                            <estado>FIRME</estado>
                            <tipopit>G</tipopit>
                            <table diffgr:id="Table2" msdata:roworder="1" />
                            <cod_administrado>709652</cod_administrado>
                            <num_infraccion>22499993</num_infraccion>
                            <cod_entidad>112</cod_entidad>
                            <entidad>SAT LIMA</entidad>
                            <papeleta>12038477</papeleta>
                            <dat_fecha_firme>2017-06-03T00:00:00-05:00</dat_fecha_firme>
                            <var_nro_resolucion>17605601423474</var_nro_resolucion>
                            <falta>G58</falta>
                            <fec_infraccion>18/04/2017</fec_infraccion>
                            <fec_firme>03/06/2017</fec_firme>
                            <puntos_x0020_firmes>20</puntos_x0020_firmes>
                            <p._x0020_proceso>0</p._x0020_proceso>
                            <estado>FIRME</estado>
                            <tipopit>G</tipopit>
                            <table diffgr:id="Table3" msdata:roworder="2" />
                            <cod_administrado>709652</cod_administrado>
                            <num_infraccion>16436301</num_infraccion>
                            <cod_entidad>112</cod_entidad>
                            <entidad>SAT LIMA</entidad>
                            <papeleta>10063859</papeleta>
                            <var_nro_resolucion>21805602856639</var_nro_resolucion>
                            <falta>L05</falta>
                            <fec_infraccion>11/07/2012</fec_infraccion>
                            <puntos_x0020_firmes>0</puntos_x0020_firmes>
                            <p._x0020_proceso>5</p._x0020_proceso>
                            <estado>EN PROCESO</estado>
                            <tipopit>L</tipopit>
                            <table diffgr:id="Table4" msdata:roworder="3" />
                            <cod_administrado>709652</cod_administrado>
                            <num_infraccion>14022607</num_infraccion>
                            <cod_entidad>29</cod_entidad>
                            <entidad>MUNICIPALIDAD DE CALLAO</entidad>
                            <papeleta>00291056B</papeleta>
                            <var_nro_resolucion>056891-2011</var_nro_resolucion>
                            <falta>G29</falta>
                            <fec_infraccion>23/02/2011</fec_infraccion>
                            <puntos_x0020_firmes>0</puntos_x0020_firmes>
                            <p._x0020_proceso>20</p._x0020_proceso>
                            <estado>EN PROCESO</estado>
                            <tipopit>G</tipopit>
                            <table diffgr:id="Table5" msdata:roworder="4" />
                        </newdataset>
                        </diffgr:diffgram>
                    </getdatospapeletasmtcresult>
                </getdatospapeletasmtcresponse>
            </soap:body>
            </soap:envelope>
       
        ';
        
            
        $xml = preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', $xml);        
        $doc = new DOMDocument();
        $doc->preserveWhiteSpace = false;
        $doc->loadXML($xml);
        $i = 0;
        $data['html'] = '';
        $data['html'] .= '
        <table class="table" style="font-size:80%">
            <tr>
                <th>#</th>
                <th>N° de Infracción</th>
                <th>Código de Entidad</th>
                <th>Entidad</th>
                <th>Papeleta</th>
                <th>Fecha Firme</th>
                <th>Falta</th>
                <th>Número de Resolución</th>
                <th>Fecha de Infracción</th>
                <th>Fecha Firme</th>
                <th>Puntos x0020 Firmes</th>
                <th>Puntos x0020 Proceso</th>
                <th>Estado</th>
                <th>Tipo PIT</th>
            </tr>   
        ';
        /*
        log_message('error',print_r($doc->getElementsByTagName("cod_administrado"),true));
        return;*/

        while ($doc->getElementsByTagName("cod_administrado")->item($i)) {   
            
            $data['html'] .= '<tr>';
    

            $numInfraccion = $doc->getElementsByTagName('num_infraccion')->item($i);
            isset($numInfraccion) ? $numInfraccion = $numInfraccion->nodeValue : $numInfraccion = "--";

            $codEntidad = $doc->getElementsByTagName('cod_entidad')->item($i);
            isset($codEntidad) ? $codEntidad = $codEntidad->nodeValue : $codEntidad = "--";

            $entidad = $doc->getElementsByTagName('entidad')->item($i);
            isset($entidad) ? $entidad = $entidad->nodeValue : $entidad = "--";

            $papeleta = $doc->getElementsByTagName('papeleta')->item($i);
            isset($papeleta) ? $papeleta = $papeleta->nodeValue : $papeleta = "--";

            $datFechaFirme = $doc->getElementsByTagName('dat_fecha_firme')->item($i);
            isset($datFechaFirme) ? $datFechaFirme = $datFechaFirme->nodeValue : $datFechaFirme = "--";

            $nroResolucion = $doc->getElementsByTagName('var_nro_resolucion')->item($i);
            isset($nroResolucion) ? $nroResolucion = $nroResolucion->nodeValue : $nroResolucion = "--";
            
            $falta = $doc->getElementsByTagName('falta')->item($i);
            isset($falta) ? $falta = $falta->nodeValue : $falta = "--";

            $fechaInfraccion = $doc->getElementsByTagName('fec_infraccion')->item($i);
            isset($fechaInfraccion) ? $fechaInfraccion = $fechaInfraccion->nodeValue : $fechaInfraccion = "--";

            $fechaFirme = $doc->getElementsByTagName('fec_firme')->item($i);
            isset($fechaFirme) ? $fechaFirme = $fechaFirme->nodeValue : $fechaFirme = "--";

            $puntosFirmes = $doc->getElementsByTagName('puntos_x0020_firmes')->item($i);
            isset($puntosFirmes) ? $puntosFirmes = $puntosFirmes->nodeValue : $puntosFirmes = "--";

            $PProceso = $doc->getElementsByTagName('p._x0020_proceso')->item($i);
            isset($PProceso) ? $PProceso = $PProceso->nodeValue : $PProceso = "--";

            $estado = $doc->getElementsByTagName('estado')->item($i);
            isset($estado) ? $estado = $estado->nodeValue : $estado = "--";

            $TipoPit = $doc->getElementsByTagName('tipopit')->item($i);
            isset($TipoPit) ? $TipoPit = $TipoPit->nodeValue : $TipoPit = "--";
    
            //error_log(print_r($MTC,true));
            
            
            $data['html'] .= '
                    <td>'. ($i+1) .'</td>
                    <td>'. $numInfraccion .'</td>
                    <td>'. $codEntidad .'</td>
                    <td>'. $entidad .'</td>
                    <td>'. $papeleta .'</td>
                    <td>'. $datFechaFirme .'</td>
                    <td>'. $nroResolucion .'</td>
                    <td>'. $falta .'</td>
                    <td>'. $fechaInfraccion .'</td>
                    <td>'. $fechaFirme .'</td>
                    <td>'. $puntosFirmes .'</td>
                    <td>'. $PProceso .'</td>
                    <td>'. $estado .'</td>
                    <td>'. $TipoPit .'</td>
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