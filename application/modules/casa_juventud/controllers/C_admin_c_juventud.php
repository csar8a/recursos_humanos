<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_admin_c_juventud extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_admin_casa_juventud');
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
            'bar'          => 'Casa de la Juventud',
            'combo_tipodoc'   => getComboByParametro('TIPODOC', 4),
            'combo_distritos' => getComboByParametro('DISTRITO'),
            'combo_estado_civil' => getComboByParametro('ESTADO_CIVIL')
            //'fichas' => $this->filtrarFichas()
        );
        $this->load->view('casa_juventud/V_admin_c_juventud',$data);
    }

    public function getFamiliaresVista()
    {
        $idficha = $this->input->post('id_ficha');
        $data['error'] = EXIT_ERROR;
        try {
            $data = $this->M_admin_casa_juventud->getFamiliares($idficha);
            $data["html"] = "";
            if ($data['error'] == EXIT_ERROR){
                echo json_encode($data);
                return;
            }
            if($data['result'] != null) {
                foreach($data['result'] as $dat){
                    $data["html"] .=
                        "<tr>
                            
                            <td attr=''>".$dat->txtnompersona."</td>
                            <td attr=''>".$dat->txtappaterno."</td>
                            <td attr=''>".$dat->txtapmaterno."</td>
                            <td attr=''>".$dat->txtedad."</td>
                            <td attr=''>".$dat->txtparentesco."</td>
                            <td>
                                <div class='block_container' style='text-align: center' onclick='deleteFamiliar(".$dat->idpersona.")'>
                                    <div class='block'>
                                        <a style='color:blue'>
                                            <i class='fas fa-trash' title='Eliminar' style='color: red'></i>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>";
                }
            } else {
                $data["html"] .= "<tr style='text-align: center'><td colspan='6'>Aun no tiene familiares inscritos.</td></tr>";
            }

            echo json_encode($data);
        }
        catch (\Throwable $th) {
            throw $th;
        }
        
    }

    public function getFamiliares($idficha)
    {
        $data['error'] = EXIT_ERROR;
        try {
            $data = $this->M_admin_casa_juventud->getFamiliares($idficha);
            $data["html"] = "";
            if ($data['error'] == EXIT_ERROR){
                echo json_encode($data);
                return;
            }
            $cont = 0;

            $data["html"] .= "<tbody>";

            foreach($data['result'] as $dat){
                $cont++;
                $data["html"] .=
                    "<tr>
                        <td attr='codigo'>".$dat->txtnompersona."</td>
                        <td attr='fechainscrp'>".$dat->txtappaterno."</td>
                        <td attr='nombre'>".$dat->txtapmaterno."</td>
                        <td attr='nombre'>".$dat->txtedad."</td>
                        <td attr='nombre'>".$dat->txtparentesco."</td>
                    </tr>";
            }
            $data["html"] .= "</tbody>";
            log_message('error',print_r($data["html"],true));

            return $data['html'];
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

    public function buscarFicha()
    {
         
       $data['error'] = EXIT_ERROR;
        try {
            $nombre  =  $this->input->post('nombre')!= null ? $this->input->post('nombre') : null;
            $nombre2 = strtolower($nombre);
            $codigo  =  $this->input->post('codigo')!= null ? $this->input->post('codigo') : null;
            $data = $this->M_admin_casa_juventud->buscarFicha($nombre2,$codigo);
            //log_message('error',print_r($data,true));

            $data["html"] = "";
            if ($data['error'] == EXIT_ERROR){
                echo json_encode($data);
                return;
            }
            $cont = 0;        
            foreach($data['result'] as $dat){
                $cont++;
                $data["html"] .=
                    "
                    <tr>
                        <td>".$cont."</td>
                        <td attr='codigo'>".$dat->txtcodigo."</td>
                        <td attr='fechainscrp'>".$dat->dainscripcion."</td>
                        <td attr='nombre'>".$dat->nombre."</td>
                        <td>
                            <div class='block_container' style='text-align: center'>
                                <div class='block' onclick='openModalFamiliares(".$dat->idficha.",this)'><i class='far fa-edit tooltip-test' title='Editar' style='color: black'></i>
                                </div>
                            </div>
                        </td>
                        <td attr='foto'>
                        <div class='block_container' style='text-align: center'>
                            <div class='block' onclick='ModalFotoP(\"".$dat->idjoven."\",\"".$dat->imagen."\")'><i class='fas fa-camera tooltip-test' title='Editar' style='color: #007bff'></i>
                            </div>
                            </div>
                        </td>
                        <td>
                            <div class='block_container' style='text-align: center'>
                                <a style='color:blue' href='".base_url()."casa_juventud/C_admin_c_juventud/openFichaFinal/".$dat->idficha."'>
                                    <i class='fas fa-eye tooltip-test' title='Editar' style='color: #40bbe5'></i>
                                </a>
                            </div>
                        </td>
                        <td>
                        <div class='block_container' style='text-align: center'>
                            <div class='block' onclick='modalEditDatosJoven(".$dat->idficha.",this)'>
                            <i class='fas fa-user-edit' title='Editar Joven' style='color: #063f5d'></i>
                           
                            </div>
                        </div>
                    
                        <div class='block_container' style='text-align: center'>
                            <div class='block' onclick='modalEditDatosApoderado(".$dat->idficha.",this)'>
                            <i class='fas fa-user-friends' title='Editar Apoderado' style='color: green'></i>
                            
                            </div>
                        </div>
                    </td>
                        <td>
                            <div class='block_container' style='text-align: center'>
                            <div class='block' onclick='opencardpage(".$dat->idficha.",this)'>
                            <i class='fas fa-id-card tooltip-test' title='Carnet' style='color: #40bbe5'></i>
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

    

    function modalFotoP(){
        $data['error'] = EXIT_ERROR;
        try {
            $idjoven  =  $this->input->post('idjoven');
            $imagen  =  $this->input->post('imagen');
            if($imagen != '')
            {
                $data["html"] ='
                <img style="width: 150px; height: 150px;" src="../server_files/modulos/casajuventud/'.$imagen.'"/><br>
                <b><span style="color:#063f5d; display:none">IP: </span></b><span id="idjoven" style="text-transform: capitalize; display:none">'.$idjoven.'</span></span><br>
                ';
            } else {
                $data["html"] ='
                <img style="width: 150px; height: 150px;" src="'.base_url().'public/casa_juventud/img/foto.png"/><br>
                <b><span style="color:#063f5d; display:none">IP: </span></b><span id="idjoven" style="text-transform: capitalize; display:none">'.$idjoven.'</span></span><br>
                ';
            }
            
            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    } 

    public function insertarFamiliar()
    {
        $familiares     =  $this->input->post('familiares');
        $idFicha     =  $this->input->post('id_ficha');

        $familiar = explode(";", $familiares);
        $cantidad_familiares = sizeof($familiar);

        for($i = 0; $i < $cantidad_familiares; $i++)
        {
            $familiar_detalle = explode(",",$familiar[$i]);

            $datos_familiar = array(
                'txtnompersona'        => $familiar_detalle[0],
                'txtappaterno'         => $familiar_detalle[1],
                'txtapmaterno'         => $familiar_detalle[2],
                'txtedad'              => $familiar_detalle[3],
                'txtparentesco'        => $familiar_detalle[4],
                'idficha'              => $idFicha
            );

            $data = $this->M_admin_casa_juventud->insertarFamiliar($datos_familiar);
        }
        echo json_encode($data);
        //log_message('error', print_r(sizeof($familiar),true));



    }

    function editArchivo(){
        $data['error'] = EXIT_ERROR;
        try {
            $s_nombreUsuario = $this->session->userdata('s_nombreUsuario');
            if($s_nombreUsuario == null){
                return;
            }
            $config['upload_path']='../server_files/modulos/casajuventud';
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
                $idjoven     =  $this->input->post('idjoven');
                $file_info = $this->upload->data();
                $archivo   = $file_info['file_name'];
                $data = $this->M_admin_casa_juventud->editImagenPersona($idjoven,$archivo);
                $data['img'] = $archivo;
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

    function getAllData(){
        $data['error'] = EXIT_ERROR;
        try {
            $idFICHA  =  $this->input->post('id_ficha');
            log_message('error',print_r($idFICHA,true));
            $data = $this->M_admin_casa_juventud->getAllDatos($idFICHA);
            $data["html"] = "";
            if ($data['error'] == EXIT_ERROR){
                echo json_encode($data);
                return;
            }
            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function openFichaFinal($idficha)
    {
        $data = array(
            'familiares' => $this->getFamiliares($idficha),
            'id' => $idficha
        );
        $this->load->view('casa_juventud/V_ficha_final_casa_juventud',$data);
    }

    public function deleteFamiliar()
    {
        $idfamiliar = $this->input->post('idpersona');
        $data = $this->M_admin_casa_juventud->deleteFamiliar($idfamiliar);
        if ($data['error'] == EXIT_ERROR){
            echo json_encode($data);
            return;
        }
        echo json_encode($data);
    }
    
    function modalEditDatosJoven(){
        
        $data['error'] = EXIT_ERROR;
        try {
            $idficha  =  $this->input->post('idficha');
            $data = $this->M_admin_casa_juventud->getAllDatosFicha($idficha);
            log_message('error',print_r($data,true));
            log_message('error',print_r('ficha'+$idficha,true));
            $data["html"] = "";
            if ($data['error'] == EXIT_ERROR){
                echo json_encode($data);
                return;
            }
            foreach($data['result'] as $dat){


                $data['joven'] = $dat->joven;
                $data['apoderado'] = $dat->apoderado;
              
            }
            echo json_encode($data);
            
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function editDatosJoven(){ 
        $data['error'] = EXIT_ERROR;
        try {
            $idjoven  =  $this->input->post('idjoven');
            $apPaternoJoven  =  $this->input->post('apPaternoJoven');
            $apMaternoJoven       =  $this->input->post('apMaternoJoven');
            $nombresJoven         =  $this->input->post('nombresJoven');
            $telefonoJoven        =  $this->input->post('telefonoJoven');
            $fechaNacJoven         =  $this->input->post('fechaNacJoven');
            $date = str_replace('/', '-', $fechaNacJoven);
            $celularJoven         =  $this->input->post('celularJoven');
            $correoJoven         =  $this->input->post('correoJoven');
            $gradoInstruccionJoven         =  $this->input->post('gradoInstruccionJoven');
            $ocupacionJoven         =  $this->input->post('ocupacionJoven');
            $centroEstudiosTrabajoJoven         =  $this->input->post('centroEstudiosTrabajoJoven');
            $estadoCivilJoven         =  $this->input->post('estadoCivilJoven');
            $distrito         =  $this->input->post('distrito');
            $viaPublica         =  $this->input->post('viaPublica');
            $urbanizacion         =  $this->input->post('urbanizacion');
            $numero         =  $this->input->post('numero');
            $interior         =  $this->input->post('interior');
            $manzana         =  $this->input->post('manzana');
            $lote         =  $this->input->post('lote');
            $data = $this->M_admin_casa_juventud->editFichaJoven($idjoven,$apPaternoJoven,$apMaternoJoven,
            $nombresJoven,$telefonoJoven,$celularJoven,$correoJoven,$gradoInstruccionJoven,$ocupacionJoven
            ,$centroEstudiosTrabajoJoven,$date,$estadoCivilJoven,$distrito,$viaPublica,$urbanizacion,$numero,$interior
            ,$manzana,$lote);
            
            if ($data['error'] == EXIT_ERROR){
                echo json_encode($data);
                return;
            }

            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function editDatosApoderado(){ 
        $data['error'] = EXIT_ERROR;
        try {
            $idficha  =  $this->input->post('idficha');
            $tipodocapoderado  =  $this->input->post('tipodocapoderado');
            $docapoderado  =  $this->input->post('docapoderado');
            $apPaternoApoderado  =  $this->input->post('apPaternoApoderado');
            $apMaternoApoderado       =  $this->input->post('apMaternoApoderado');
            $nombresApoderado         =  $this->input->post('nombresApoderado');
            $telefonoApoderado        =  $this->input->post('telefonoApoderado');
            $celularApoderado         =  $this->input->post('celularApoderado');
            $correoApoderado         =  $this->input->post('correoApoderado');
            $gradoInstruccionApoderado         =  $this->input->post('gradoInstruccionApoderado');
            $ocupacionApoderado         =  $this->input->post('ocupacionApoderado');
            $estadoCivilApoderado         =  $this->input->post('estadoCivilApoderado');
            $sexoa         =  $this->input->post('sexoa');
            $fechaNacApoderado         =  $this->input->post('fechaNacApoderado');
            $date = str_replace('/', '-', $fechaNacApoderado);
           

           
            $data = $this->M_admin_casa_juventud->editFichaApoderado($idficha,$tipodocapoderado,$docapoderado,$apPaternoApoderado,$apMaternoApoderado,$nombresApoderado,
            $telefonoApoderado,$celularApoderado,$correoApoderado,$gradoInstruccionApoderado,$ocupacionApoderado,$estadoCivilApoderado,$sexoa,$date);
            
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
