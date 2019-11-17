<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_admin_docs extends MX_Controller {
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_admin_docs');
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
            'bar' => 'Intranet',
            'combo_area'   => getAreas(),
            'docs' => $this->datosDocumentos(null,'',null,null),
            'combo_int_tipodoc'  => getComboByParametro('INT_TIPODOC')
        );
        $this->load->view('V_admin_docs',$data);
    }

    public function datosDocumentos($area,$busqueda,$fecha,$tipo)
    {
        $data['error'] = EXIT_ERROR;
        try {
            $datos_doc = array(
                'idarea'      => $area,
                'txtbusqueda' => $busqueda,
                'fecha'       => $fecha,
                'idtipo'      => $tipo
            );
            $data = $this->M_admin_docs->datosDocumentos($datos_doc);
            $data["html"] = "";
            if ($data['error'] == EXIT_ERROR){
                return $data['html'];
            }
            $cont = 0;
            foreach($data['result'] as $dat){
                $cont++;
                $data["html"] .=
                    "<tr>
                        <td>".$cont."</td>
                        <td attr='nombre'>".$dat->txtdocumento."</td>
                        <td attr='desc'>".$dat->txtdescdocumento."</td>
                        <td attr='tipo'>".$dat->tipo."</td>
                        <td>".$dat->daregistro."</td>
                        <td>
                            <div class='block_container'>
                                <div class='block' onclick='modalEditDoc(".$dat->iddocumento.",this)'><i class='far fa-edit tooltip-test' title='Editar' style='color: black'></i>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class='block_container'>
                                <div class='block' onclick='modalEditArchivo(".$dat->iddocumento.",this)'><i class='far fa-eye tooltip-test' title='Editar' style='color: black'></i>
                                </div>
                            </div>
                        </td>
                    </tr>";
            }
            return $data['html'];
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    function descargarDocumento($archivo){
        $data = file_get_contents(URL_SERVER.'intranet/documentos/'.$archivo);
        force_download($archivo,$data);
    }

    function modalEditArchivo(){
        $data['error'] = EXIT_ERROR;
        try {
            $iddocumento  =  $this->input->post('iddocumento');
            $data = $this->M_admin_docs->getDatosArchivo($iddocumento);
            $data["html"] = "";
            if ($data['error'] == EXIT_ERROR){
                echo json_encode($data);
                return;
            }
            foreach($data['result'] as $dat){
                $data['nombre'] = $dat->txtdocumento;
                $data['desc'] = $dat->txtdescdocumento;
                $data['idtipo'] = $dat->idtipo;
                $data["html"] .=
                    "<tr>
                        <td>
                            <a style='color:blue' href='".base_url()."intranet/C_admin_docs/descargarDocumento/".$dat->txtarchivourl."'>
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
                $iddocumento     =  $this->input->post('iddocumento');
                
                $file_info = $this->upload->data();
                $archivo   = $file_info['file_name'];

                $data = $this->M_admin_docs->editDocArchivo($iddocumento,$archivo);
                
                if ($data['error'] == EXIT_ERROR){
                    echo json_encode($data);
                    return;
                }
                $data['html'] = "<tr>
                                    <td>
                                        <a style='color:blue' href='".base_url()."intranet/C_admin_docs/descargarDocumento/".$archivo."'>
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

    function editDatosDoc(){
        $data['error'] = EXIT_ERROR;
        try {
            $s_nombreUsuario = $this->session->userdata('s_nombreUsuario');
            if($s_nombreUsuario == null){
                return;
            }
            
            $iddocumento  =  $this->input->post('iddoc');
            $nombre       =  $this->input->post('nombre');
            $desc         =  $this->input->post('desc');
            $idtipo         =  $this->input->post('idtipo');

            $data = $this->M_admin_docs->editDocDatos($iddocumento,$nombre,$desc,$idtipo);
            
            if ($data['error'] == EXIT_ERROR){
                echo json_encode($data);
                return;
            }

            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function filtrarDocumento()
    {
        $data['error'] = EXIT_ERROR;
        try {
            $texto = $this->input->post('documento');
            $fecha = $this->input->post('fecha');
            $tipo = $this->input->post('idtipo');

            $texto = !empty($texto) ? $texto : '';
            $fecha = !empty($fecha) ? $fecha : NULL;
            $tipo  = !empty($tipo)  ? $tipo : NULL;
            $data['html'] = $this->datosDocumentos(null,$texto, $fecha,$tipo);
            echo json_encode($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }
}
