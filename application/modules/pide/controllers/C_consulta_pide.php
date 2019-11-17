<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_consulta_pide extends MX_Controller {
    
    function __construct()
    {
        parent::__construct();
       
        $this->load->helper('utils');
        $this->load->model('M_utils');
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
            
            'combo_tipopide' => getComboByParametro('PIDE'),
            'modulos_usuario_sb' => getModulosDashboard($idRol,$idUsuario)["side"]
        );
        $this->load->view('V_consulta_pide',$data);
    }

    public function BuscarPide()
    {
        $data['error'] = EXIT_ERROR;
        try {
            $id_tipo_pide  =  $this->input->post('nid_tipo')!= null ? $this->input->post('nid_tipo') : null;
            log_message('error', print_r($id_tipo_pide, true));
            $data = $this->M_utils->BuscarPide($id_tipo_pide);
           
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
                        <td attr='codigo'>".$dat->codigo."</td>
                        <td attr='usuario'>".$dat->usuario."</td>
                        <td attr='fecha'>".$dat->dafecha."</td>
                        <td attr='entrada'>".$dat->entrada."</td>
                        <td attr='salida'>".$dat->salida."</td>
                        </tr>";
            }
            log_message('error', print_r($data, true));
            echo json_encode($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }
    
}
