<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_admin_normas extends MX_Controller {
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_admin_normas');
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
            'combo_year' => getYearsNormas(),
            'combo_tiponorma' => getComboByParametro('NORMAS'),
            'modulos_usuario_sb' => getModulosDashboard($idRol,$idUsuario)["side"],
            'bar' => 'Normas Institucionales'
        );
        
        $this->load->view('V_admin_normas',$data);
    }

    public function buscarNormas()
    {
        $data['error'] = EXIT_ERROR;
        try {
            $id_tipo_norma  =  $this->input->post('nid_tipo')!= null ? $this->input->post('nid_tipo') : null;
            $year           =  $this->input->post('year')!= null ? $this->input->post('year') : null;
            $nombre           =  $this->input->post('nombre')!= null ? $this->input->post('nombre') : null;
            $descripcion      =  $this->input->post('descripcion')!= null ? $this->input->post('descripcion') : null;
            $data = $this->M_admin_normas->BuscarNormas($id_tipo_norma,$year,$nombre,$descripcion);
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
                        <td attr='norma'>".$dat->txtnorma."</td>
                        <td attr='descnorma'>".$dat->txtdescnorma."</td>
                        <td attr='fechanorma'>".$dat->danorma."</td>
                        <td attr='hits'>".$dat->numhits."</td>
                        <td>
                            <a style='color:blue' href='".base_url()."normas/C_admin_normas/descargarNorma/".$dat->txtarchivourl."/".$dat->idnorma."' onclick='hit(this)'>
                                Descargar
                            </a>
                        </td>
                        <td>
                            <div class='block_container'>
                                <div class='block' onclick='modalEditDatosNorma(".$dat->idnorma.",this)'><i class='far fa-edit tooltip-test' title='Editar Contenido' style='color: black'></i>
                                </div>

                                <div class='block' onclick='modalEditArchivo(".$dat->idnorma.",this)'><i class='fas fa-file-alt' title='Editar Documento' style='color: green'></i>
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

    function modalEditArchivo(){
        $data['error'] = EXIT_ERROR;
        try {
            $iddocumento  =  $this->input->post('iddocumento');
            $data = $this->M_admin_normas->getDatosNorma($iddocumento);
            $data["html"] = "";
            if ($data['error'] == EXIT_ERROR){
                echo json_encode($data);
                return;
            }
            foreach($data['result'] as $dat){
               
                $data["html"] .=
                    "<tr>
                        <td>
                            <a style='color:blue' href='".base_url()."normas/C_admin_normas/descargarDocumento/".$dat->txtarchivourl."'>
                                Descargar
                            </a>
                        </td>
                    </tr>";
            }
            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function editArchivo(){
        $data['error'] = EXIT_ERROR;
        try {
            $s_nombreUsuario = $this->session->userdata('s_nombreUsuario');
            if($s_nombreUsuario == null){
                return;
            }
            $config['upload_path']   = '../server_files/normas';
            $config['allowed_types'] = 'pdf';
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
                $iddocumento     =  $this->input->post('iddocumento');
                
                $file_info = $this->upload->data();
                $archivo   = $file_info['file_name'];

                $data = $this->M_admin_normas->editDocArchivo($iddocumento,$archivo);
                
                if ($data['error'] == EXIT_ERROR){
                    echo json_encode($data);
                    return;
                }
                $data['html'] = "<tr>
                                    <td>
                                        <a style='color:blue' href='".base_url()."normas/C_admin_normas/descargarDocumento/".$archivo."'>
                                            Descargar
                                        </a>
                                    </td>
                                </tr>";

            }
            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function descargarDocumento($archivo){
        $data = file_get_contents(URL_SERVER.'normas/'.$archivo);
        force_download($archivo,$data);
    }
    
    function modalEditDatosNormas(){
        
        $data['error'] = EXIT_ERROR;
        try {
            $idnorma  =  $this->input->post('idnorma');
            $data = $this->M_admin_normas->getDatosNorma($idnorma);
            log_message('error',print_r($data,true));
            $data["html"] = "";
            if ($data['error'] == EXIT_ERROR){
                echo json_encode($data);
                return;
            }
            foreach($data['result'] as $dat){
                $data['idnorma'] = $dat->idnorma;
                $data['norma'] = $dat->txtnorma;
                $data['descripcion'] = $dat->txtdescnorma;
                $data['tipo'] = $dat->txttipo;
                $data['fecha'] = $dat->danorma;
                $data['archivo'] = $dat->txtarchivourl;
            }
            echo json_encode($data);
            
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    function descargarNorma($archivo,$id_norma){
        $this->M_admin_normas->incrementHit($id_norma);
        $data = file_get_contents('D:/xampp/htdocs/server_files/normas/'.$archivo);
        force_download($archivo,$data);
    }
    
    function editDatosNorma(){ 
        $data['error'] = EXIT_ERROR;
        try {
            
            $idnorma  =  $this->input->post('idnorma');
            $norma       =  $this->input->post('norma');
            $descnorma         =  $this->input->post('descripcion');
            $tipo        =  $this->input->post('tipo');
            $fecha         =  $this->input->post('fecha');
            $date = str_replace('/', '-', $fecha);
            $year           =  date('Y', strtotime($date));
            $data = $this->M_admin_normas->editNormaDatos($idnorma,$norma,$descnorma,$tipo,$fecha,$year);
            
            if ($data['error'] == EXIT_ERROR){
                echo json_encode($data);
                return;
            }

            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
