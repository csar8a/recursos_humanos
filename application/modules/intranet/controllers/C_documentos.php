<?php 
//(defined('BASEPATH')) OR exit('No direct script access allowed');

class C_documentos extends MX_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_documentos');
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
            'bar'                => 'Intranet',
            'combo_int_tipodoc'  => getComboByParametro('INT_TIPODOC')
        );
        $this->load->view('intranet/V_documentos', $data);
    }

    function insertarDocumento(){
        $data['error'] = EXIT_ERROR;
        try {
            // VALIDACION DE USUARIO
            $s_nombreUsuario = $this->session->userdata('s_nombreUsuario');
            if($s_nombreUsuario == null){
                return;
            }
            $config['upload_path']   = '../server_files/intranet/documentos';
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
                $titulo         =  $this->input->post('titulo');
                $tipo           =  $this->input->post('tipo');
                $descripcion    =  $this->input->post('descripcion');
                
                $file_info = $this->upload->data();
                $archivo   = $file_info['file_name'];
                
                $datos_documento = array(
                    'TXTDOCUMENTO'      => $titulo,
                    'IDAREA'            => null,
                    'TXTDESCDOCUMENTO'  => $descripcion,
                    'TXTARCHIVOURL'     => $archivo,
                    'TXTUSERREGISTRO'   => $s_nombreUsuario,
                    'IDTIPO'            => $tipo
                );

                $data = $this->M_documentos->insertarDocumento($datos_documento);
            }
            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
