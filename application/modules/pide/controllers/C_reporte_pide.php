<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_reporte_pide extends MX_Controller {
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_reporte_pide');
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
            'bar'          => 'Reporte PIDE'
        );
        $this->load->view('V_reporte_pide',$data);
    }

    public function cargarReporte()
    {
        $data['error'] = EXIT_ERROR;
        try {
            $fechainicio =  $this->input->post('fecha1');
            $fechafin    =  $this->input->post('fecha2');
            $data = $this->M_reporte_pide->cargarReporte($fechainicio,$fechafin);
            $data["html"] = "";
            $data["html2"] = "";
            if ($data['error'] == EXIT_ERROR){
                echo json_encode($data);
                return;
            }
            $cont = 0;
            foreach($data['result'] as $dat){
                $data["html2"] .=
                    "<h1> Fecha Busqueda: ".$fechainicio." hasta".$fechafin."</h1>";
                $cont++;
                $data["html"] .=
                    "<tr>
                        <td>".$dat->txtconsultapide."</td>
                        <td>".$dat->count."</td>
                    </tr>";
                
            }
            echo json_encode($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }    
}
