<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_normas_vecino extends MX_Controller {
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_normas_vecino');
        $this->load->helper('utils');
        $this->load->helper(array('download'));
       
    }

	public function index()
	{
        $data = array(
            'combo_year' => getYearsNormas(),
            'combo_tiponorma' => getComboByParametro('NORMAS'),
            'bar' => 'Normas Institucionales'
        );
        $this->load->view('V_normas_vecino',$data);
    }

    public function buscarNormas()
    {
        $data['error'] = EXIT_ERROR;
        try {
            $id_tipo_norma  =  $this->input->post('nid_tipo');
            $year           =  $this->input->post('year')!= null ? $this->input->post('year') : null;
            $nombre           =  $this->input->post('nombre')!= null ? $this->input->post('nombre') : null;
            $descripcion      =  $this->input->post('descripcion')!= null ? $this->input->post('descripcion') : null;
            $data = $this->M_normas_vecino->BuscarNormas($id_tipo_norma,$year,$nombre,$descripcion);
            log_message('error',print_r($data,true));
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
                        <td>".$dat->txtnorma."</td>
                        <td>".$dat->txtdescnorma."</td>
                        <td>".$dat->danorma."</td>
                        <td attr='hits'>".$dat->numhits."</td>
                        <td>
                            <a style='color:blue' href='".base_url()."normas/C_normas_vecino/descargarNorma/".$dat->txtarchivourl."/".$dat->idnorma."' onclick='hit(this)'>
                                Descargar
                            </a>
                        </td>
                        </tr>";
            }
            echo json_encode($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }
    function descargarNorma($archivo,$id_norma){
        $this->M_normas_vecino->incrementHit($id_norma);
        $data = file_get_contents('C:/xampp/htdocs/server_files/normas/'.$archivo);
        force_download($archivo,$data);
    }
}