<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Datos_Personales extends MX_Controller {
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_Datos_Personales');
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
            'bar' => 'Recursos Humanos'
        );
        
        $this->load->view('V_Datos_Personales',$data);
    }

    public function buscarVacaciones()
    {
        $data['error'] = EXIT_ERROR;
        try {
            $codigo  =  $this->input->post('codigo')!= null ? $this->input->post('codigo') : null;
            $data = $this->M_Datos_Personales->BuscarVacaciones($codigo);
            error_log(print_r($codigo,true));
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
                        <td attr='periodo'>".$dat->periodo."</td>
                        <td attr='fechain'>".$dat->fecha_inicio."</td>
                        <td attr='fechafin'>".$dat->fecha_fin."</td>
                        <td attr='dias'>".$dat->dias."</td>
                        <td attr='saldo'>".$dat->saldo."</td>
                        <td attr='saldo'>".$dat->descripcion."</td>
                        </tr>";
            }
            echo json_encode($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }
    
    public function buscarPersona()
    {
        $data['error'] = EXIT_ERROR;
        try {
            $busqueda  =  $this->input->post('nombre')!= null ? $this->input->post('nombre') : null;
            $data = $this->M_Datos_Personales->BuscarPersona($busqueda);
            log_message('error',print_r($data,true));

            $data["html"] = "";
            if ($data['error'] == EXIT_ERROR){
                echo json_encode($data);
                return;
            }
            $cont = 0;
            $data['html'] .= '
                
            <table class="table">
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Estado</th>
                <th>+</th>
              
            </tr>';
            foreach($data['result'] as $dat){
                $cont++;
                $data["html"] .=
                    "<tr>
                        <td>".$cont."</td>
                        <td attr='nombre'>".$dat->nombre."</td>
                        <td attr='apellidopa'>".$dat->apellido_pa."</td>
                        <td attr='apellidoma'>".$dat->apellido_ma."</td>
                        <td attr='estado'>".$dat->estado."</td>
                        <td attr='total'>
                        <div class='block_container'>
                            <div class='block' onclick='EnviarDatos(\"".$dat->datos_completos."\",\"".$dat->codigo."\",\"".$dat->dni."\",\"".$dat->cargo."\",\"".$dat->fecha_nac."\",\"".$dat->fecha_ingreso."\",\"".$dat->fecha_salida."\")'><i class='btn btn-primary' data-toggle='modal'>Seleccionar</i>
                            </div>
                            </div>
                        </td>

                    </tr>";
            }
          
            echo json_encode($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }



    }
}
