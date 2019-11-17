<?php 
//(defined('BASEPATH')) OR exit('No direct script access allowed');

class C_eventos extends MX_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_eventos');
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
            'bar'          => 'Intranet',
            'combo_categoria' => getComboByParametro('EVENTOS_CATEG')
        );
        $this->load->view('intranet/V_eventos', $data);
    }

    function insertarEvento(){
        $data['error'] = EXIT_ERROR;
        try {
            // VALIDACION DE USUARIO
            $s_nombreUsuario = $this->session->userdata('s_nombreUsuario');
            if($s_nombreUsuario == null){
                return;
            }
            $config['upload_path']='../server_files/intranet/eventosimg';
            //$config['upload_path']='/aplication/modules/intranet/files/';
            //$config['upload_path'] = realpath(APPPATH . '../server_files/intranet');
            $config['allowed_types']='*';
            $config['max_size']='20048';
            $search = explode(",","ç,æ,œ,á,é,í,ó,ú,à,è,ì,ò,ù,ä,ë,ï,ö,ü,ÿ,â,ê,î,ô,û,å,e,i,ø,u");
            $replace = explode(",","c,ae,oe,a,e,i,o,u,a,e,i,o,u,a,e,i,o,u,y,a,e,i,o,u,a,e,i,o,u");
            $nuevo = str_replace($search, $replace,$_FILES["archivo"]['name']);    
            $config['file_name'] = preg_replace('/[^a-z0-9.]/i', '', $nuevo);
            $this->load->library('upload',$config); 
            
            if (!$this->upload->do_upload("archivo")) {
               //log_message('error',$this->upload->display_errors());
               $data['msj'] = strip_tags($this->upload->display_errors());
            } else {
                //$idarea  =  $this->input->post('area');
                $titulo      =  $this->input->post('titulo');
                $descripcion =  $this->input->post('descripcion');
                $lugar       =  $this->input->post('lugar');
                $categoria   =  $this->input->post('categoria');
                $costo       =  $this->input->post('costo');
                $contacto    =  $this->input->post('contacto');
                $fechainicio =  $this->input->post('fechainicio');
                $fechafin    =  $this->input->post('fechafin');
                $tags        =  $this->input->post('tags');

                $costo = !empty($costo) ? $costo : NULL;
                
                $file_info = $this->upload->data();
                $archivo   = $file_info['file_name'];
                
                $datos_evento = array(
                    'TXTTITULO'       => $titulo,
                    'TXTDESCRIPCION'  => $descripcion,
                    'DAFECHACOMIENZO' => $fechainicio,
                    'DAFECHAFIN'      => $fechafin,
                    'TXTLOCACION'     => $lugar,
                    'IDCATEGORIA'     => $categoria,
                    'TXTCOSTO'        => $costo,
                    'TXTCONTACTO'     => $contacto,
                    'TXTTAGS'         => $tags,
                    'TXTUSERREGISTRO' => $s_nombreUsuario,
                    'TXTURLIMAGEN'    => $archivo
                );

                $data = $this->M_eventos->insertarEvento($datos_evento);
            }
            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
