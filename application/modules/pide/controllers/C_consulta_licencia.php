<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_consulta_licencia extends MX_Controller
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
        $this->load->view('V_consulta_licencia',$data);
    }

    public function buscarLicencia()
    {
        try {
            $tipodoc = $this->input->post('tipodoc') != null ? $this->input->post('tipodoc') : null;
            $numdoc  = $this->input->post('numdoc')  != null ? $this->input->post('numdoc')  : null;
            /*
            $context = stream_context_create(array('https' => array('header' => 'Accept: application/xml')));
            $url = 'https://ws3.pide.gob.pe/Rest/Mtc/DatosLicencia?iTipoDocumento=.$tipodoc.&sNumDocumento=.$numdoc.';
            $xml = file_get_contents($url, false, $context);
            */
            $xml = '
            <soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
                <soap:Body>
                    <GetDatosLicenciaMTCResponse xmlns="http://tempuri.org/">
                        <CodigoRespuesta>0000</CodigoRespuesta>
                        <Licencia>
                            <TipoDoc>DNI</TipoDoc>
                            <NroDocumento>25331232</NroDocumento>
                            <Correlato>1</Correlato>
                            <NroLicencia>E25331232</NroLicencia>
                            <Categoria>A I</Categoria>
                            <ApellidoPaterno>BALTAZAR</ApellidoPaterno>
                            <ApellidoMaterno>ARTEAGA</ApellidoMaterno>
                            <Nombre>NELLY VICTORIA</Nombre>
                            <Departamento>ANCASH</Departamento>
                            <Provincia>CARHUAZ</Provincia>
                            <Distrito>ACOPAMPA</Distrito>
                            <Direccion>CARR. CARRETERA CENTRAL SN CAS. ACOPAMPA</Direccion>
                            <Fechaemision>10/11/2016</Fechaemision>
                            <Fechaexpedicion>10/11/2016</Fechaexpedicion>
                            <Fecharevalidacion>10/11/2018</Fecharevalidacion>
                            <Estadolicencia>Vigente</Estadolicencia>
                        </Licencia>
                    </GetDatosLicenciaMTCResponse>
                </soap:Body>
            </soap:Envelope>
            ';
            
            $xml = preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', $xml);
            $doc = new DOMDocument();
            $doc->preserveWhiteSpace = false;
            $doc->loadXML($xml);
            $data['html']  = "";
            $msj = $doc->getElementsByTagName('CodigoRespuesta')->item(0)->nodeValue;
            if($msj == 'MSJ01') {
                $data['html'] = 'El número de documento no cuenta con licencia de conducir';
            } else if($msj == 'MSJ02' || $msj == 'MSJ03') {
                $data['html'] = 'El servicio actualmente se encuentra inoperativo';
            } else {
                $data['html'] = '
                <h4>Datos de Licencia</h4><br>
                <div class="row">
                    <div class="col-md-8">
                        <b><span style="color:#063f5d;">Número de licencia: </span></b>
                        <span style="text-transform: capitalize">' . $doc->getElementsByTagName('NroLicencia')->item(0)->nodeValue . '</span><br><br>
                        <b><span style="color:#063f5d">Categoría: </span></b>
                        <span style="text-transform: capitalize">' . $doc->getElementsByTagName('Categoria')->item(0)->nodeValue . '</span><br><br>
                        <b><span style="color:#063f5d">Apellido Paterno: </span></b>
                        <span style="text-transform: capitalize">' . $doc->getElementsByTagName('ApellidoPaterno')->item(0)->nodeValue . '</span><br><br>
                        <b><span style="color:#063f5d">Apellido Materno: </span></b>
                        <span style="text-transform: capitalize">' . $doc->getElementsByTagName('ApellidoMaterno')->item(0)->nodeValue . '</span><br><br>
                        <b><span style="color:#063f5d">Nombre: </span></b>
                        <span style="text-transform: capitalize">' . $doc->getElementsByTagName('Nombre')->item(0)->nodeValue . '</span><br><br>
                        <b><span style="color:#063f5d">Departamento: </span></b>
                        <span style="text-transform: capitalize">' . $doc->getElementsByTagName('Departamento')->item(0)->nodeValue . '</span><br><br>
                        <b><span style="color:#063f5d">Provincia: </span>
                        </b><span style="text-transform: capitalize">' . $doc->getElementsByTagName('Provincia')->item(0)->nodeValue . '</span><br><br>
                        <b><span style="color:#063f5d">Distrito: </span>
                        </b><span style="text-transform: capitalize">' . $doc->getElementsByTagName('Distrito')->item(0)->nodeValue . '</span><br><br>
                        <b><span style="color:#063f5d">Dirección: </span>
                        </b><span style="text-transform: capitalize">' . $doc->getElementsByTagName('Direccion')->item(0)->nodeValue . '</span><br><br>
                        <b><span style="color:#063f5d">Fecha de emisión: </span>
                        </b><span style="text-transform: capitalize">' . $doc->getElementsByTagName('Fechaemision')->item(0)->nodeValue . '</span><br><br>
                        <b><span style="color:#063f5d">Fecha de expedición: </span>
                        </b><span style="text-transform: capitalize">' . $doc->getElementsByTagName('Fechaexpedicion')->item(0)->nodeValue . '</span><br><br>
                        <b><span style="color:#063f5d">Fecha de revalidación: </span>
                        </b><span style="text-transform: capitalize">' . $doc->getElementsByTagName('Fecharevalidacion')->item(0)->nodeValue . '</span><br><br>
                        <b><span style="color:#063f5d">Estado de licencia: </span>
                        </b><span style="text-transform: capitalize">' . $doc->getElementsByTagName('Estadolicencia')->item(0)->nodeValue . '</span><br><br>
                    </div>
                </div>';
            }
            $data['error'] = EXIT_SUCCESS;
            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}
