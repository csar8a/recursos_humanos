<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_admin_noticias extends MX_Controller {
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_admin_noticias');
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
            'bar' => 'Intranet'
        );
        $this->load->view('V_admin_noticias',$data);
    }

    public function buscarNoticia()
    {
       $data['error'] = EXIT_ERROR;
        try {
            $busqueda  =  $this->input->post('nombre')!= null ? $this->input->post('nombre') : null;
            $data = $this->M_admin_noticias->buscarNoticia($busqueda);
            //log_message('error',print_r($data,true));

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
                <th>Titulo</th>
                <th>Descripcion</th>
                <th>Fecha Registro</th>
                <th>Usuario</th>
                <th>Imagen Portada</th>
                <th>Extracto</th>
                <th>Imagenes Extras</th>
                <th>Editar</th>
                <th>Estado</th>
            </tr>';
            foreach($data['result'] as $dat){
                $cont++;
                $flg = $dat->flgacti == 1 ? 'checked' : '';
                $data["html"] .=
                    "<tr>
                        <td>".$cont."</td>
                        <td attr='titulonoticia'>".$dat->txttitulo."</td>
                        <td attr='descripcionnoticia'>".$dat->txtdescripcion."</td>
                        <td>".$dat->daregistro."</td>
                        <td>".$dat->txtuserregistro."</td>
                        <td>
                        <div class='block_container'>
                            <div class='block' onclick='ModalFotoP(\"".$dat->idnoticia."\",\"".$dat->txturlimagen."\")'><i class='btn btn-primary' data-toggle='modal'> Ver Foto</i>
                            </div>
                            </div>
                        </td>
                        <td attr='extractonoticia'>".$dat->txtextracto."</td>
                        <td>
                            <div class='block_container'>
                                <div class='block' onclick='ModalFotoE(".$dat->idnoticia.")'><i class='btn btn-primary' data-toggle='modal'> Ver Foto(s)</i>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class='block_container'>
                                <div class='block' onclick='modalEditDatosNoticia(".$dat->idnoticia.",this)'><i class='far fa-edit tooltip-test' title='Editar' style='color: black'></i>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class='custom-control custom-switch'>
                                <input type='checkbox' class='custom-control-input' id='customSwitches".$cont."' onchange='estadoNoticia(".$dat->idnoticia.",this)' ".$flg .">
                                <label class='custom-control-label' for='customSwitches".$cont."'></label>
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

    function modalFotoP(){
        $data['error'] = EXIT_ERROR;
        try {
            $idnoticia  =  $this->input->post('idnoticia');
            $txturlimagen  =  $this->input->post('txturlimagen');
            $data["html"] ='
            <img style="width: 50%;
            height: 50%;" src="../server_files/intranet/noticiasimg/'.$txturlimagen.'"/><br>
            <b><span style="color:#063f5d; display:none">IP: </span></b><span id="idnoticia" style="text-transform: capitalize; display:none">'.$idnoticia.'</span></span><br>';
            
            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }   


    function modalFotoE(){
        $data['error'] = EXIT_ERROR;
        try {
            $idnoticia  =  $this->input->post('idnoticia');
            $data = $this->M_admin_noticias->getDatosNoticia($idnoticia);
            
            $data["html"] = "";
            if ($data['error'] == EXIT_ERROR){
                echo json_encode($data);
                return;
            }
            $txtimagenesextras = "";
            foreach($data['result'] as $dat){
                $txtimagenesextras = $dat->txtimagenesextras;
            }
            $imagenesExtras = explode(";",$txtimagenesextras);
            if(strlen($txtimagenesextras) == 0 || count($imagenesExtras) == 0){
                echo json_encode($data);
                return;
            }
            $cont = 0;
            foreach($imagenesExtras as $img){
                $cont++;
                $data["html"] .=
                    "<tr>
                        <td>".$cont."</td>
                        <td attr='nombre'>".$img."</td>
                        <td>
                            <div class='block_container'>
                                <div class='block' onclick='modalVerFotoExtra(this)'><i class='far fa-eye tooltip-test' title='Editar' style='color: black'></i>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class='block_container'>
                                <div class='block' onclick='modalRemoveFotoExtra(".$dat->idnoticia.",this)'><i class='far fa-trash-alt tooltip-test' title='Eliminar' style='color: black'></i>
                                </div>
                            </div>
                        </td>
                    </tr>";
            }
            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function modalEditDatosNoticia(){
        
        $data['error'] = EXIT_ERROR;
        try {
            $idnoticia  =  $this->input->post('idnoticia');
            

            $data = $this->M_admin_noticias->getDatosNoticia($idnoticia);
            log_message('error',print_r($data,true));
            $data["html"] = "";
            if ($data['error'] == EXIT_ERROR){
                echo json_encode($data);
                return;
            }
            foreach($data['result'] as $dat){
                $data['idnoticia'] = $dat->idnoticia;
                $data['titulo'] = $dat->txttitulo;
                $data['descripcion'] = $dat->txtdescripcion;
                $data['extracto'] = $dat->txtextracto;
               
                
            }
            echo json_encode($data);
            
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function editDatosNoticia(){ 
        $data['error'] = EXIT_ERROR;
        try {
            
            $idnoticia  =  $this->input->post('idnoticia');
            $titulo       =  $this->input->post('titulo');
            $desc         =  $this->input->post('descripcion');
            $extracto         =  $this->input->post('extracto');
            $estado         =  $this->input->post('estado');
            $data = $this->M_admin_noticias->editNoticiaDatos($idnoticia,$titulo,$desc,$extracto,$estado);
            
            if ($data['error'] == EXIT_ERROR){
                echo json_encode($data);
                return;
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
            $config['upload_path']='../server_files/intranet/noticiasimg';
            $config['allowed_types']='jpg|png|jpeg';
            $config['max_size']='20048';
            $search = explode(",","ç,æ,œ,á,é,í,ó,ú,à,è,ì,ò,ù,ä,ë,ï,ö,ü,ÿ,â,ê,î,ô,û,å,e,i,ø,u");
            $replace = explode(",","c,ae,oe,a,e,i,o,u,a,e,i,o,u,a,e,i,o,u,y,a,e,i,o,u,a,e,i,o,u");
            $nuevo = str_replace($search, $replace,$_FILES["archivo"]['name']);    
            $config['file_name'] = preg_replace('/[^a-z0-9.]/i', '', $nuevo);
            $this->load->library('upload',$config); 
            
            if (!$this->upload->do_upload("archivo")) {
               $data['msj'] = strip_tags($this->upload->display_errors());               
            } else {
                $idnoticia     =  $this->input->post('idnoticia');
                $file_info = $this->upload->data();
                $archivo   = $file_info['file_name'];
                $data = $this->M_admin_noticias->editImagenNoticia($idnoticia,$archivo);
                //log_message('error',$data);
                if ($data['error'] == EXIT_ERROR){
                    echo json_encode($data);
                    return;
                }
            }
            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function estadoNoticia(){
        $data['error'] = EXIT_ERROR;
        try {
            $idnoticia = $this->input->post('idnoticia');
            $flg = $this->input->post('flg');

            $data = $this->M_admin_noticias->estadoNoticia($idnoticia,$flg);
            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function editFotoExtra(){
        $data['error'] = EXIT_ERROR;
        try {
            $s_nombreUsuario = $this->session->userdata('s_nombreUsuario');
            if($s_nombreUsuario == null){
                return;
            }
            $config['upload_path']='../server_files/intranet/noticiasimg';
            $config['allowed_types']='jpg|png|jpeg';
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
                $idnoticia    =  $this->input->post('idnoticia');
                $imgextra     =  $this->input->post('imgextra');
                
                $file_info = $this->upload->data();
                $archivo   = $file_info['file_name'];
                $data = $this->M_admin_noticias->editImagenExtraNoticia($idnoticia,$imgextra,$archivo);

                $data['img'] = $archivo;
                if ($data['error'] == EXIT_ERROR){
                    echo json_encode($data);
                    return;
                }
            }
            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function modalRemoveFotoExtra(){
        $data['error'] = EXIT_ERROR;
        try {
            $idnoticia  =  $this->input->post('idnoticia');
            $img        =  $this->input->post('img');
            $data = $this->M_admin_noticias->removeFotoExtra($idnoticia,$img);
            
            if ($data['error'] == EXIT_ERROR){
                echo json_encode($data);
                return;
            }

            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function addFotoExtra(){
        $data['error'] = EXIT_ERROR;
        try {

            
            $idnoticia    =  $this->input->post('idnoticia');
            $archivo = $this->M_admin_noticias->getDatosNoticia($idnoticia);
            
            if(count(explode(";",$archivo['result'][0]->txtimagenesextras)) == 10){
                $data['msj'] = 'No puedes agregar más de 10 imágenes extras.';
                echo json_encode($data);
                return;
            }

            $s_nombreUsuario = $this->session->userdata('s_nombreUsuario');
            if($s_nombreUsuario == null){
                return;
            }
            $config['upload_path']='../server_files/intranet/noticiasimg';
            $config['allowed_types']='jpg|png|jpeg';
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
                
                $file_info = $this->upload->data();
                $archivo   = $file_info['file_name'];
                $data = $this->M_admin_noticias->addFotoExtra($idnoticia,$archivo);
                if ($data['error'] == EXIT_ERROR){
                    echo json_encode($data);
                    return;
                }
                $data = $this->M_admin_noticias->getDatosNoticia($idnoticia);
            
                $data["html"] = "";
                if ($data['error'] == EXIT_ERROR){
                    echo json_encode($data);
                    return;
                }
                $txtimagenesextras = "";
                foreach($data['result'] as $dat){
                    $txtimagenesextras = $dat->txtimagenesextras;
                }
                $imagenesExtras = explode(";",$txtimagenesextras);
                if(strlen($txtimagenesextras) == 0 || count($imagenesExtras) == 0){
                    echo json_encode($data);
                    return;
                }
                $cont = 0;
                foreach($imagenesExtras as $img){
                    $cont++;
                    $data["html"] .=
                        "<tr>
                            <td>".$cont."</td>
                            <td attr='nombre'>".$img."</td>
                            <td>
                                <div class='block_container'>
                                    <div class='block' onclick='modalVerFotoExtra(this)'><i class='far fa-eye tooltip-test' title='Editar' style='color: black'></i>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class='block_container'>
                                    <div class='block' onclick='modalRemoveFotoExtra(".$dat->idnoticia.",this)'><i class='far fa-trash-alt tooltip-test' title='Eliminar' style='color: black'></i>
                                    </div>
                                </div>
                            </td>
                        </tr>";
                }
            }
            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
