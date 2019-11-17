<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_consulta_sunedu_grados extends MX_Controller
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
        $this->load->view('V_consulta_sunedu_grados',$data);
    }

    public function buscarGrados()
    {
        try {
            $tipodoc = $this->input->post('tipodoc') != null ? $this->input->post('tipodoc') : null;
            $numdoc  = $this->input->post('numdoc')  != null ? $this->input->post('numdoc')  : null;
            $string=exec('getmac');
            $mac=substr($string, 0, 17); 
            
            

            $context = stream_context_create(array('https' => array('header' => 'Accept: application/xml')));
            $url = 'https://ws3.pide.gob.pe/Rest/Sunedu/Grados?usuario=ONGEI&clave=ONGEI&idEntidad=&fecha=&hora=&mac_wsServer='.$mac.'&ip_wsServer=&ip_wsUser=&nroDocIdentidad='.$numdoc;
            $xml = file_get_contents($url, false, $context);
                        
            $xml = preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', $xml);
            $doc = new DOMDocument();
            $doc->preserveWhiteSpace = false;
            $doc->loadXML($xml);
            $data['html']  = "";
            $msj = $doc->getElementsByTagName('cGenerico')->item(0)->nodeValue;
            if($msj != '00000') {
                $data['html'] = $doc->getElementsByTagName('dGenerica')->item(0)->nodeValue;
            } else {
                $data['html'] = '
                <h4>Datos de Grado</h4><br>
                <div class="row">
                    <div class="col-md-8">
                        <b><span style="color:#063f5d">Apellido Paterno: </span></b>
                        <span style="text-transform: capitalize">' . $doc->getElementsByTagName('apellidoPaterno')->item(0)->nodeValue . '</span><br><br>
                        <b><span style="color:#063f5d">Apellido Materno: </span></b>
                        <span style="text-transform: capitalize">' . $doc->getElementsByTagName('apellidoMaterno')->item(0)->nodeValue . '</span><br><br>
                        <b><span style="color:#063f5d">Nombre: </span></b>
                        <span style="text-transform: capitalize">' . $doc->getElementsByTagName('nombres')->item(0)->nodeValue . '</span><br><br>
                    </div>
                </div>';
                $data['html'] .= '
                    <table class="table">
                        <tr>
                            <th>#</th>
                            <th>Título</th>
                            <th>Título profesional</th>
                            <th>Universidad</th>
                            <th>País</th>
                            <th>Tipo de Institución</th>
                            <th>Tipo de Gestión</th>
                            <th>Fecha de emisión</th>
                            <th>Resolución</th>
                            <th>Fecha de resolución</th>
                        </tr>';

                $i = 0;
                while ($sunarp = $doc->getElementsByTagName("gtPersona")->item($i)) {
                    $data['html'] .= '<tr>';

                    //Evaluar si no es nulo
                    $abvrTitulo = $sunarp->getElementsByTagName('abreviaturaTitulo')->item(0);
                    if(isset($abvrTitulo)){
                        switch ($abvrTitulo->nodeValue) {
                            case 'B':
                                $abvrTitulo = "G. Bachiller"; break;
                            case 'T':
                                $abvrTitulo = "Título Profesional"; break;
                            case 'S':
                                $abvrTitulo = "Segunda Especialidad"; break;
                            case 'M':
                                $abvrTitulo = "G. Maestro"; break;
                            case 'D':
                                $abvrTitulo = "G. Doctor"; break;
                            default:
                                $abvrTitulo = "--";
                        }
                    } else {
                        $abvrTitulo = "--";
                    }

                    $tituloProfesional = $sunarp->getElementsByTagName('tituloProfesional')->item(0);
                    isset($tituloProfesional) ? $tituloProfesional = $tituloProfesional->nodeValue : $tituloProfesional = "--";

                    $universidad = $sunarp->getElementsByTagName('universidad')->item(0);
                    isset($universidad) ? $universidad = $universidad->nodeValue : $universidad = "--";

                    $pais = $sunarp->getElementsByTagName('pais')->item(0);
                    isset($pais) ? $pais = $pais->nodeValue : $pais = "--";

                    $tipoInstitucion = $sunarp->getElementsByTagName('tipoInstitucion')->item(0);
                    if(isset($tipoInstitucion)){
                        switch ($tipoInstitucion->nodeValue) {
                            case 'U':
                                $tipoInstitucion = "Universidad"; break;
                            case 'E':
                                $tipoInstitucion = "Escuela"; break;
                            case 'I':
                                $tipoInstitucion = "Instituto"; break;
                            default:
                                $tipoInstitucion = "--";
                        }
                    } else {
                        $tipoInstitucion = "--";
                    }

                    $tipoGestion = $sunarp->getElementsByTagName('tipoGestion')->item(0);
                    if(isset($tipoGestion)){
                        switch ($tipoGestion->nodeValue) {
                            case 'N':
                                $tipoGestion = "Nacional"; break;
                            case 'P':
                                $tipoGestion = "Privada"; break;
                            default:
                                $tipoGestion = "--";
                        }
                    } else {
                        $tipoGestion = "--";
                    }

                    $fechaEmision = $sunarp->getElementsByTagName('fechaEmision')->item(0);
                    isset($fechaEmision) ? $fechaEmision = $fechaEmision->nodeValue : $fechaEmision = "--";

                    $resolucion = $sunarp->getElementsByTagName('resolucion')->item(0);
                    isset($resolucion) ? $resolucion = $resolucion->nodeValue : $resolucion = "--";

                    $fechaResolucion = $sunarp->getElementsByTagName('fechaResolucion')->item(0);
                    isset($fechaResolucion) ? $fechaResolucion = $fechaResolucion->nodeValue : $fechaResolucion = "--";

                    $data['html'] .= '
                            <td>'. ($i+1) .'</td>
                            <td>'. $abvrTitulo .'</td>
                            <td>'. $tituloProfesional .'</td>
                            <td>'. $universidad .'</td>
                            <td>'. $pais .'</td>
                            <td>'. $tipoInstitucion .'</td>
                            <td>'. $tipoGestion .'</td>
                            <td>'. $fechaEmision .'</td>
                            <td>'. $resolucion .'</td>
                            <td>'. $fechaResolucion .'</td>
                        ';

                    $data['html'] .= '</tr>';
                    $i++;
                }

                $data['html'] .= '</table>';
            }
            $data['error'] = EXIT_SUCCESS;
            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}
