<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_update_normas extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_update_normas');
        $this->load->helper('utils');
        $sesionU = $this->session->userdata('s_nombreUsuario');
        if (empty($sesionU)) {
            redirect('login');
        }
    }

    public function index()
    {
        $data = array(
            'combo_tiponorma' => getComboByParametro('NORMAS')
        );
        $this->load->view('v_update_normas', $data);
    }
    
    public function insertarNorma()
    {
        $data['error'] = EXIT_ERROR;
        try {
            // VALIDACION DE USUARIO
            $s_idPersona = $this->session->userdata('s_idPersona');
            if($s_idPersona == null){
                return;
            }
            $config['upload_path']='./application/modules/normas/files/';
            $config['allowed_types']='pdf';
            $config['max_size']='20048';
            $this->load->library('upload',$config);
            
            if (!$this->upload->do_upload("archivo")) {
                // log_message('error',$this->upload->display_errors());
                $data['msj'] = "El archivo no se pudo subir, selecciona archivos en formato PDF";
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
                    'TXTUSERREGISTRO'    => $s_idPersona,
                    'TXTTIPO'            => $id_tipo_norma,
                );

                $data = $this->M_normas->insertNorma($datos_norma);
            }
            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function updateNorma($id_norma){
        $this->M_update_normas->updateNorma($id_norma);
    }

}