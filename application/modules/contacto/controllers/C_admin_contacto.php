<?php 
//(defined('BASEPATH')) OR exit('No direct script access allowed');

class C_admin_contacto extends MX_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_admin_contacto');
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
        $idarea  = $this->session->userdata('s_area');
        $data = array(
            'modulos_usuario_sb' => getModulosDashboard($idRol,$idUsuario)["side"],
            'bar'          => 'Contacto y Sugerencias',
            'combo_area'   => getAreas($idarea),
            'tb_contactos' => $this->cargarDatosContacto()
        );
        $this->load->view('contacto/v_admin_contacto', $data);
    }

    public function cargarDatosContacto(){
        $idarea  = $this->session->userdata('s_area');
        $sesionU = $this->session->userdata('s_nombreUsuario');
        $data = $this->M_admin_contacto->getDatosContactos($idarea,CON_TIPO_CONTACTO);
        $html = "";
        if ($data['error'] == EXIT_ERROR){
            return $html;
        }

        $cont = 0;
        foreach($data['result'] as $dat){
            $cont++;
            $state = '';
            $state_desc = '';
            $btnEnviar= "";
            $btnArchivar = "";
            $btnResponder = "";
            if($dat->IDESTADO == ESTADO_CONTACTO_PENDIENTE){
                $state = 'success';
                $state_desc = 'PENDIENTE';
                $btnEnviar = "<div class='block btn-enviar' onclick='modalEnviar(this)'><i class='fas fa-paper-plane tooltip-test' title='Asignar a una área' style='color: blue'></i></div>";
                $btnArchivar = "<div class='block btn-archivar' onclick='modalArchivar(this)'><i class='fas fa-inbox tooltip-test' title='Archivar el mensaje' style='color: red'></i>
                                </div>";
                $btnResponder = "<div class='block btn-responder' onclick='modalResponder(this)'>
                                    <i class='fas fa-envelope tooltip-test' title='Responder al vecino' style='color: Dodgerblue'></i>
                                </div>";
            } else if($dat->IDESTADO == ESTADO_CONTACTO_DERIVADO) {
                if($idarea == $dat->IDAREAINICIAL){
                    $state = 'success';
                    $state_desc = 'PENDIENTE';
                    $btnEnviar = "<div class='block btn-enviar' onclick='modalEnviar(this)'><i class='fas fa-paper-plane tooltip-test' title='Asignar a una área' style='color: blue'></i></div>";
                    $btnResponder = "<div class='block btn-responder' onclick='modalResponder(this)'>
                                        <i class='fas fa-envelope tooltip-test' title='Responder al vecino' style='color: Dodgerblue'></i>
                                     </div>";
                } else {
                    $state = 'primary';
                    $state_desc = 'ASIGNADO';
                }
            } else if($dat->IDESTADO == ESTADO_CONTACTO_ARCHIVADO) {
                $state = 'danger';
                $state_desc = 'ARCHIVADO';
            } else if($dat->IDESTADO == ESTADO_CONTACTO_FINALIZADO) {
                $state = 'warning';
                $state_desc = 'RESPONDIDO';
            }

            $html .=   "<tr data-id='".$dat->IDCONTACTO."'>
                            <td >".$cont."</td>
                            <td attr='nomb'>".$dat->NOMBRES."</td>
                            <td attr='tel'>".$dat->TXTTELEFONO."</td>
                            <td attr='medio'>".$dat->MEDIO."</td>
                            <td attr='asun'>".$dat->TXTASUNTO."</td>
                            <td attr='fech'>".$dat->DAREGISTRO."</td>
                            <td attr='esta'><div class='badge badge-".$state."'>".$state_desc."</div></td>
                            <td>
                                <div class='block_container'>
                                    <div class='block' onclick='modalVer(this)'><i class='far fa-eye tooltip-test' title='Ver detalle' style='color: green'></i>
                                    </div>
                                    ".$btnEnviar."
                                    ".$btnArchivar."
                                    ".$btnResponder."
                                </div>
                            </td>
                        </tr>";
        }
        return $html;
    }
    
    function getMensaje(){
        $data['error'] = EXIT_ERROR; 
        
        try {
            $idcontacto = $this->input->post('idcontacto');
            $idarea     = $this->session->userdata('s_area');
            $data = $this->M_admin_contacto->getDatosContactos($idarea,CON_TIPO_CONTACTO,$idcontacto);
            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function asignarArea(){
        $data['error'] = EXIT_ERROR; 
        
        try {
            $idContacto    = $this->input->post('idcontacto');
            if($idContacto == null){
                echo json_encode($data);return;
            }
            $mensaje       = $this->input->post('mensaje');
            $areaDerivada  = $this->input->post('area_asignada');
            $username      = $this->session->userdata('s_nombreUsuario');

            $data     = $this->M_admin_contacto->asignarArea($areaDerivada, $idContacto, $mensaje, $username);
            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function archivarContacto(){
        $data['error'] = EXIT_ERROR; 
        
        try {
            $idContacto    = $this->input->post('idcontacto');
            if($idContacto == null){
                echo json_encode($data);return;
            }
            $username   = $this->session->userdata('s_nombreUsuario');
            if($username == null){
                echo json_encode($data);return;
            }

            $data = $this->M_admin_contacto->archivarContacto($idContacto, $username);
            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function responderVecino(){
        $data['error'] = EXIT_ERROR;
        
        try {
            $idContacto  = $this->input->post('idcontacto');
            $mensaje     = $this->input->post('mensaje');
            if($idContacto == null){
                echo json_encode($data);return;
            }
            $username   = $this->session->userdata('s_nombreUsuario');
            if($username == null){
                echo json_encode($data);return;
            }

            $data = $this->M_admin_contacto->responderContacto($idContacto, $username, $mensaje);

            /*
            $vecino = $this->M_admin_contacto->datosVecino($idContacto);
            if($vecino['error'] != EXIT_SUCCESS){
                echo json_encode($data);
                return;
            }
            $datos_vecino = $vecino['result'][0];
            $datos = array(
                'vecino'  => $datos_vecino->NOMBRES,
                'mensaje' => $mensaje
            );
            $contenido = $this->load->view('V_correo_mensaje',$datos,TRUE);

            
            $this->email->set_newline("\r\n");
            $this->email->from('desarrollomunibellavista@gmail.com', 'Municipalidad de Bellavista');
            //$this->email->to('franco.condor.urp@gmail.com');
            $this->email->to($datos_vecino->TXTCORREO);
            $this->email->subject('MUNICIPALIDAD DE BELLAVISTA - Registro de Contacto');

            $this->email->message($contenido);

            if ($this->email->send()) {
                log_message('error', 'success');
                $data['error'] = EXIT_SUCCESS;
            } else {
                log_message('error', $this->email->print_debugger());
            }*/
            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function guardarContacto(){
        $data['error'] = EXIT_ERROR; 
        
        try {

            $pat  = $this->input->post('paterno');
            $mat  = $this->input->post('materno');
            $nom  = $this->input->post('nombres');
            $est  = $this->input->post('estado');
            $msj  = $this->input->post('mensaje');
            $asun = $this->input->post('asunto');
            $tel = $this->input->post('telefono');
            $fec = $this->input->post('fechaHora');
            
            $data     = $this->M_admin_contacto->guardarContacto($pat, $mat, $nom, $est, $msj, $asun, $tel, $fec);
            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
