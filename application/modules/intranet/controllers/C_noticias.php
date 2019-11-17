<?php 
//(defined('BASEPATH')) OR exit('No direct script access allowed');

class C_noticias extends MX_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_noticias');
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
            'bar'          => 'Intranet',
            'combo_area'   => getAreas()
        );
        $this->load->view('intranet/V_noticias', $data);
    }

    function insertarNoticia(){
        $data['error'] = EXIT_ERROR;
        try {
            // VALIDACION DE USUARIO
            $s_nombreUsuario = $this->session->userdata('s_nombreUsuario');
            if($s_nombreUsuario == null){
                return;
            }
            $config['upload_path']='../server_files/intranet/noticiasimg';
            $config['allowed_types']='jpg|png|jpeg';
            $config['max_size']='20048';
            $search = explode(",","ç,æ,œ,á,é,í,ó,ú,à,è,ì,ò,ù,ä,ë,ï,ö,ü,ÿ,â,ê,î,ô,û,å,e,i,ø,u");
            $replace = explode(",","c,ae,oe,a,e,i,o,u,a,e,i,o,u,a,e,i,o,u,y,a,e,i,o,u,a,e,i,o,u");

            $txtextras = null;
            $archivo = "";
            $contExtras = 0;
            foreach($_FILES as $key=>$file){
                $nuevo = str_replace($search, $replace,$file['name']);    
                $config['file_name'] = preg_replace('/[^a-z0-9.]/i', '', $nuevo);
                $this->load->library('upload',$config);
                $this->upload->initialize($config);

                if (!$this->upload->do_upload($key)) {
                    $data['msj'] = strip_tags($this->upload->display_errors());
                    echo json_encode($data);
                    return;
                } else {
                    $file_info = $this->upload->data();
                    if($key != 'archivo'){
                        $txtextras .= ($contExtras != 0 ? ";" : "").$file_info['file_name'];
                        $contExtras++;
                    } else {
                        $archivo   = $file_info['file_name'];
                    }
                }
                
            }

            if(isset($data['msj'])){
                echo json_encode($data);
                return;
            } else {
                $titulo       =  $this->input->post('titulo');
                $descripcion  =  $this->input->post('descripcion');
                $extracto     =  $this->input->post('extracto');

                $datos_noticia = array(
                    'TXTTITULO'                 => $titulo,
                    'TXTDESCRIPCION'            => $descripcion,
                    'TXTUSERREGISTRO'           => $s_nombreUsuario,
                    'TXTURLIMAGEN'              => $archivo,
                    'FLGACTI'                   => '1',
                    'TXTEXTRACTO'               => $extracto,
                    'TXTIMAGENESEXTRAS'         => $txtextras,
                );

                $data = $this->M_noticias->insertarNoticias($datos_noticia);
            }
            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
