<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_normas extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_normas');
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
            'combo_tiponorma' => getComboByParametro('NORMAS'),
            'modulos_usuario_sb' => getModulosDashboard($idRol,$idUsuario)["side"],
            'bar' => 'Normas Institucionales'
        );
        $this->load->view('v_normas', $data);
    }
 
    public function insertarNorma()
    {
        $data['error'] = EXIT_ERROR;
        try {
            // VALIDACION DE USUARIO
            $s_nombreUsuario = $this->session->userdata('s_nombreUsuario');
            if($s_nombreUsuario == null){
                return;
            }
            $config['upload_path']='../server_files/normas';
            $config['allowed_types']='pdf';
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
                $id_tipo_norma  =  $this->input->post('nid_tipo');
                $nombre         =  $this->input->post('nombre');
                $descripcion    =  $this->input->post('descripcion');
                $fecha          =  $this->input->post('fecha');
                $date = str_replace('/', '-', $fecha);
                $year           =  date('Y', strtotime($date));
                
                $file_info = $this->upload->data();
                $archivo   = $file_info['file_name'];
                
                $datos_norma = array(
                    'TXTNORMA'          => $nombre,
                    'TXTDESCNORMA'      => $descripcion,
                    'FLGESTADO'         => 1,
                    'TXTARCHIVOURL'     => $archivo,
                    'NUMANIO'           => $year,
                    'DANORMA'           => $fecha,
                    'TXTIPREGISTRO'        => '',
                    'TXTUSERREGISTRO'    => $s_nombreUsuario,
                    'TXTTIPO'            => $id_tipo_norma,
                );

                $data = $this->M_normas->insertNorma($datos_norma);
            }
            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
