<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_admin_eventos extends MX_Controller {
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_admin_eventos');
        $this->load->helper('utils');
        $this->load->helper(array('download'));
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
            'bar' => 'Intranet',
            'combo_categoria' => getComboByParametro('EVENTOS_CATEG'),
            'eventos' => $this->filtrarEventos()
        );
        $this->load->view('V_admin_eventos',$data);
    }

    public function filtrarEventos()
    {
        $data['error'] = EXIT_ERROR;
        try {
            $data = $this->M_admin_eventos->getEventos(null);
            $data["html"] = "";
            if ($data['error'] == EXIT_ERROR){
                echo json_encode($data);
                return;
            }
            $cont = 0;
            foreach($data['result'] as $dat){
                $cont++;
                $data["html"] .=
                    "<tr>
                        <td>".$cont."</td>
                        <td attr='nombre'>".$dat->txttitulo."</td>
                        <td attr='desc'>".$dat->txtdescripcion."</td>
                        <td attr='fecinicio'>".$dat->fechainicio."</td>
                        <td attr='fecfin'>".$dat->fechafin."</td>
                        <td>
                            <div class='block_container'>
                                <div class='block' onclick='modalEditEvento(".$dat->idevento.",this)'><i class='far fa-edit tooltip-test' title='Editar' style='color: black'></i>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class='block_container'>
                                <div class='block' onclick='modalEditArchivo(".$dat->idevento.",this)'><i class='far fa-eye tooltip-test' title='Editar' style='color: black'></i>
                                </div>
                            </div>
                        </td>
                    </tr>";
            }
            return $data['html'];
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    function modalEditEvento(){
        $data['error'] = EXIT_ERROR;
        try {
            $idevento  =  $this->input->post('idevento');
            $data = $this->M_admin_eventos->getEventos($idevento);
            $data["html"] = "";
            if ($data['error'] == EXIT_ERROR){
                echo json_encode($data);
                return;
            }
            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function editEvento(){
        $data['error'] = EXIT_ERROR;
        try {
            $idevento     =  $this->input->post('idevento');
            $titulo       =  $this->input->post('titulo');
            $descripcion  =  $this->input->post('descripcion');
            $fechainicio  =  $this->input->post('fechainicio');
            $fechafin     =  $this->input->post('fechafin');
            $lugar        =  $this->input->post('lugar');
            $categoria    =  $this->input->post('categoria');
            $costo        =  $this->input->post('costo');
            $contacto     =  $this->input->post('contacto');
            $tagsEvento   =  $this->input->post('tagsEvento');

            $datos_evento = array (
                'IDEVENTO'        => $idevento,
                'TXTTITULO'       => $titulo,
                'TXTDESCRIPCION'  => $descripcion,
                'DAFECHACOMIENZO' => $fechainicio,
                'DAFECHAFIN'      => $fechafin,
                'TXTLOCACION'     => $lugar,
                'IDCATEGORIA'     => $categoria,
                'TXTCOSTO'        => $costo,
                'TXTCONTACTO'     => $contacto,
                'TXTTAGS'         => $tagsEvento
            );
            $data = $this->M_admin_eventos->editDatosEvento($datos_evento);
            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function modalEditArchivo(){
        $data['error'] = EXIT_ERROR;
        try {
            $idevento  =  $this->input->post('idevento');
            $data = $this->M_admin_eventos->getEventos($idevento);
            $data["html"] = "";
            if ($data['error'] == EXIT_ERROR){
                echo json_encode($data);
                return;
            }
            foreach($data['result'] as $dat){
                $data["html"] .=
                    "<tr>
                        <td>
                            <a style='color:blue' href='".base_url()."intranet/C_admin_eventos/descargarDocumento/".$dat->txturlimagen."'>
                                Descargar
                            </a>
                        </td>
                    </tr>";
            }
            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function editImagenEvento(){
        $data['error'] = EXIT_ERROR;
        try {
            $s_nombreUsuario = $this->session->userdata('s_nombreUsuario');
            if($s_nombreUsuario == null){
                return;
            }
            $config['upload_path']   = '../server_files/intranet/eventosimg';
            $config['allowed_types'] = '*';
            $config['max_size']      = '20048';
            $search  = explode(",","ç,æ,œ,á,é,í,ó,ú,à,è,ì,ò,ù,ä,ë,ï,ö,ü,ÿ,â,ê,î,ô,û,å,e,i,ø,u");
            $replace = explode(",","c,ae,oe,a,e,i,o,u,a,e,i,o,u,a,e,i,o,u,y,a,e,i,o,u,a,e,i,o,u");
            $nuevo = str_replace($search, $replace,$_FILES["archivo"]['name']);    
            $config['file_name'] = preg_replace('/[^a-z0-9.]/i', '', $nuevo);
            $this->load->library('upload',$config); 
            
            if (!$this->upload->do_upload("archivo")) {
               //log_message('error',$this->upload->display_errors());
               $data['msj'] = strip_tags($this->upload->display_errors());
            } else {
                $idevento  =  $this->input->post('idevento');
                
                $file_info = $this->upload->data();
                $archivo   = $file_info['file_name'];

                $data = $this->M_admin_eventos->editImagenEvento($idevento,$archivo);
                
                if ($data['error'] == EXIT_ERROR){
                    echo json_encode($data);
                    return;
                }
                $data['html'] = "<tr>
                                    <td>
                                        <a style='color:blue' href='".base_url()."intranet/C_admin_eventos/descargarDocumento/".$archivo."'>
                                            Descargar
                                        </a>
                                    </td>
                                </tr>";

            }
            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function descargarDocumento($archivo){
        $data = file_get_contents(URL_SERVER.'intranet/eventosimg/'.$archivo);
        force_download($archivo,$data);
    }
}
