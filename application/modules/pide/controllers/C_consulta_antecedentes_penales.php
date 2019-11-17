<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_consulta_antecedentes_penales extends MX_Controller
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
        $this->load->view('V_consulta_antecedentes_penales',$data);
    }

    public function buscarAntecedentesPenales()
    {

        try {
            $dni = $this->input->post('dni') != null ? $this->input->post('dni') : null;

            $nombre = $this->input->post('name') != null ? $this->input->post('name') : null;
            $nombre = str_replace(" ", "%20", $nombre);

            $ap = $this->input->post('ap') != null ? $this->input->post('ap') : null;
            $ap = str_replace(" ", "%20", $ap);

            $am = $this->input->post('am') != null ? $this->input->post('am') : null;
            $am = str_replace(" ", "%20", $am);

            $motivo = $this->input->post('motivo') != null ? $this->input->post('motivo') : null;
            $motivo = str_replace(" ", "%20", $motivo);

            $segname = $this->input->post('segname') ;

            if($segname != null) {
                $segname = str_replace(" ", "%20", $segname);
            } else {
                $segname = "";
            }

            $tername = $this->input->post('tername') ;

            if($tername != null) {
                $tername = str_replace(" ", "%20", $tername);
            } else {
                $tername = "";
            }

            $context = stream_context_create(array('https' => array('header' => 'Accept: application/xml')));
            $url = 'https://ws3.pide.gob.pe/Rest/PJ/APenales?xApellidoPaterno='.$ap.'&xApellidoMaterno='.$am.'&xNombre1='.$nombre.'&xNombre2='.$segname.'&xNombre3='.$tername.'&xDni='.$dni.'&xMotivoConsulta='.$motivo.'&xProcesoEntidadConsultante=00001-2015-0-0901-JR-PE-01&xRucEntidadConsultante=20131369639&xIpPublica=1.1.1.1&xDniPersonaConsultante=42442984&xAudNombrePC=PCMAURO&xAudIP=1.1.1.1&xAudNombreUsuario=JMAURO&xAudDireccionMAC=8C-DC-D4-39-8D-A9';
            $xml = utf8_encode(file_get_contents($url, false, $context));
            
            $doc = new DOMDocument();
            $doc->loadXML($xml);

            $data['html'] = '
            <div class="row">
                <div class="col-md-8">
                    <b><span style="color:#063f5d;">Resultado: </span></b><span>' . $dni . '</span></span><br><br>
                    <b><span style="color:#063f5d;">Resultado: </span></b><span>' . $doc->getElementsByTagName('xMensajeRespuesta')->item(0)->nodeValue . '</span></span><br><br>
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
