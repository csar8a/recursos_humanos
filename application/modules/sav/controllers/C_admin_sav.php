<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_admin_sav extends MX_Controller {
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_admin_sav');
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
            'tb_sav' => $this->getDatosSAV(),
            'modulos_usuario_sb' => getModulosDashboard($idRol,$idUsuario)["side"],
            'bar' => 'Servicio de Atención al vecino'
        );
        $this->load->view('v_admin_sav', $data);
    }

    public function getDatosSAV(){
        $data = $this->M_admin_sav->getDatosSAV();
        $html = "";
        if ($data['error'] == EXIT_ERROR){
            return $html;
        }
        // $dat->nid_persona
        $cont = 0;
        foreach($data['result'] as $dat){
            $cont++;
            $html .=   "<tr>
                            <td>".$cont."</td>
                            <td attr='nom'>".$dat->NOMBRECOMPLETO."</td>
                            <td attr='cat'>".$dat->TXTCATEGORIA."</td>
                            <td attr='subcat'>".$dat->TXTSUBCATEGORIA."</td>
                            <td attr='medio'>".$dat->TXTMEDIO."</td>
                            <td attr='tema'>".$dat->TXTTEMA."</td>
                            <td>
                                <div class='block_container'>
                                    <div class='block' onclick='modalVer(this)'><i class='far fa-eye'></i>
                                    </div>
                                    <div class='block' onclick='modalEdit()'><i class='fas fa-edit' style='color: green'></i>
                                    </div>
                                </div>
                            </td>
                        </tr>";
        }
        return $html;
    }

    public function verMensaje(){
        $data['error'] = EXIT_ERROR; 
        
        try {
            $id_caso   = $this->input->post('id_caso');
            $resultado = $this->M_admin_contacto->getMensajeSAV($id_caso);
            if($resultado['error'] == EXIT_SUCCESS){
                $data['msj_caso'] = $resultado['result'][0]->TXTMENSAJE;
                //log_message('error',print_r($data,true));
            }

            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

}
