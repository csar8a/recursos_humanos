<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_permisos extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('utils');
        $this->load->model('M_permisos');
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
            'modulos_usuario_sb' => getModulosDashboard($idRol, $idUsuario)["side"],
            'bar'   => 'Permisos',
            'roles' => getRoles(),
            'combo_rol_asignar' => getRoles(),
            'modulos' => getAllModulos(),
            'combo_tipodoc'   => getComboByParametro('TIPODOC'),
            'combo_area'   => getAreas()
        );
        $this->load->view('V_permisos', $data);
    }

    public function getPermisosByModulo(){
        $data['error'] = EXIT_ERROR;
        try {
            $modulo   = $this->input->post('modulo');
            
            $data['html'] = getPermisosByModulo($modulo);
            $data['error'] = EXIT_SUCCESS;
            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getRolesByPermiso(){
        $data['error'] = EXIT_ERROR;
        try {
            $permiso   = $this->input->post('permiso');
            $data = getRolesByPermiso($permiso);
            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function asignarPermiso(){
        $data['error'] = EXIT_ERROR;
        try {
            $permiso = $this->input->post('permiso');
            $rol     = $this->input->post('rol');

            $data = $this->M_permisos->asignarRolPermiso($rol,$permiso);
            if ($data['error'] == EXIT_ERROR){
                echo json_encode($data);
                return;
            }

            $data = getRolesByPermiso($permiso);
            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function removeRolPermiso(){
        $data['error'] = EXIT_ERROR;
        try {
            $permiso = $this->input->post('permiso');
            $rol     = $this->input->post('rol');

            $data = $this->M_permisos->removeRolPermiso($rol,$permiso);
            if ($data['error'] == EXIT_ERROR){
                echo json_encode($data);
                return;
            }

            $data['html'] = getRolesByPermiso($permiso)['html'];
            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function getConfigPermisos(){
        $data['error'] = EXIT_ERROR;
        try {
            $sistema = $this->input->post('sistema') != null ? $this->input->post('sistema') : null;
            $permiso = $this->input->post('permiso') != null ? $this->input->post('permiso') : null;
            $rol = $this->input->post('rol') != null ? $this->input->post('rol') : null;

            $data = $this->M_permisos->getConfigPermisos($sistema,$permiso,$rol);
            if ($data['error'] == EXIT_ERROR){
                echo json_encode($data);
                return;
            }
            
            $cont = 0;
            $data["html"] = "";
            foreach($data['result'] as $dat){
                $cont++;
                $data["html"] .=
                    "<tr>
                        <td>".$cont."</td>
                        <td>".$dat->txtsistema."</td>
                        <td>".$dat->txtpermiso."</td>
                        <td attr='roles'>".$dat->txtroles."</td>
                        <td>
                            <div class='block_container'>
                                <div class='block' onclick='modalEdit(".$dat->idsistema.",".$dat->idpermiso.",this)'>
                                    <i class='far fa-edit tooltip-test' title='Editar' style='color: black'>
                                    </i>
                                </div>
                            </div>
                        </td>
                    </tr>";
            }

            //$data['html'] = getRolesByPermiso($permiso)['html'];
            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
