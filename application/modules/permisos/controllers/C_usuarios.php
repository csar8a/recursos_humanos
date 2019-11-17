<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_usuarios extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('utils');
        $this->load->model('M_usuarios');
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
            'bar'   => 'Usuarios',
            'roles' => getRoles(),
            'modulos' => getAllModulos(),
            'combo_tipodoc'   => getComboByParametro('TIPODOC'),
            'combo_area'   => getAreas(),
            'combo_rol' => getRoles()
        );
        $this->load->view('V_usuarios', $data);
    }

    function buscarUsuarioNombre(){
        $data['error'] = EXIT_ERROR;
        try {
            $nombres   = $this->input->post('nombres');
            
            $data = $this->M_usuarios->buscarUsuarioNombre($nombres);
            if ($data['error'] == EXIT_ERROR){
                echo json_encode($data);
                return;
            }
            $data["html"] = "";
            $cont = 0;
            foreach($data['result'] as $dat){
                $cont++;
                $flg = $dat->flgacti == 1 ? 'checked' : '';
                $data["html"] .=
                    "<tr>
                        <td>".$cont."</td>
                        <td attr='nombres'>".$dat->txtnombres."</td>
                        <td>".$dat->username."</td>
                        <td>
                            <div class='block_container'>
                                <div class='block' onclick='modalEditUser(".$dat->idusuario.",this)'><i class='far fa-edit tooltip-test' title='Editar' style='color: black'></i>
                                </div>
                            </div>
                        </td>
                        <td attr='area'>".$dat->txtarea."</td>
                        <td>
                            <div class='block_container'>
                                <div class='block' onclick='modalEditArea(".$dat->idusuario.",this)'><i class='far fa-edit tooltip-test' title='Editar' style='color: black'></i>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class='block_container'>
                                <div class='block' onclick='modalEditRol(".$dat->idusuario.",this)'><i class='far fa-edit tooltip-test' title='Editar' style='color: black'></i>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class='block_container'>
                                <div class='block' onclick='modalPermisos(".$dat->idusuario.",this)'><i class='far fa-eye tooltip-test' title='Editar' style='color: black'></i>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class='custom-control custom-switch'>
                                <input type='checkbox' class='custom-control-input' id='customSwitches".$cont."' onchange='estadoUsuario(".$dat->idusuario.",this)' ".$flg .">
                                <label class='custom-control-label' for='customSwitches".$cont."'></label>
                            </div>
                        </td>
                    </tr>";
            }
            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function modalEditArea(){
        $data['error'] = EXIT_ERROR;
        try {
            $idusuario   = $this->input->post('idusuario');
            
            $data = $this->M_usuarios->getFechasAreaUsuario($idusuario);
            
            if ($data['error'] == EXIT_ERROR){
                echo json_encode($data);
                return;
            }
            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function asignarArea(){
        $data['error'] = EXIT_ERROR;
        try {
            $idusuario   = $this->input->post('idusuario');
            $idarea      = $this->input->post('idarea');
            $fechainicio = $this->input->post('fechainicio');
            $fechafin    = $this->input->post('fechafin') != null ? $this->input->post('fechafin') : null;
            
            $data = $this->M_usuarios->asignarArea($idusuario,$idarea,$fechainicio,$fechafin);
            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function registrarUsuario(){
        $data['error'] = EXIT_ERROR;
        try {
            $tipodoc   = $this->input->post('tipodoc');
            $doc       = $this->input->post('doc');
            $apellidos = $this->input->post('apellidos');
            $nombres   = $this->input->post('nombres');
            $telefono  = $this->input->post('telefono');
            $correo    = $this->input->post('correo');
            $fecha     = $this->input->post('fecha');
            $area      =  $this->input->post('area');
            $usuario   =  $this->input->post('usuario');
            $password   =  $this->input->post('password');
            $fecini   =  $this->input->post('fecini');
            $fecfin   =  $this->input->post('fecfin');

            $datos_usuario = array(
                'tipodocumento' => $tipodoc,
                'txtdocumento' => $doc,
                'txtusername' => $usuario,
                'txtpassword' => $password,
                'txtcorreo' => $correo,
                'txtnombres' => $nombres,
                'txtapellidos' => $apellidos,
                'idareaactual' => $area,
                'txttelefono' => $telefono,
                'danacimiento' => $fecha,
                'dafechainicioarea' => $fecini,
                'dafechafinarea' => $fecfin
            );

            $data = $this->M_usuarios->registrarUsuario($datos_usuario);
            if ($data['error'] == EXIT_ERROR){
                echo json_encode($data);
                return;
            }
            
            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function getDatosUsuario(){
        $data['error'] = EXIT_ERROR;
        try {
            $idusuario   = $this->input->post('idusuario');
            
            $data = $this->M_usuarios->getDatosUsuario($idusuario);
            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function editarUsuario(){
        $data['error'] = EXIT_ERROR;
        try {
            $idusuario = $this->input->post('idusuario');
            $apellidos = $this->input->post('apellidos');
            $nombres   = $this->input->post('nombres');
            $password  = $this->input->post('password');
            $telefono  = $this->input->post('telefono');
            $correo    = $this->input->post('correo');
            $fecha     = $this->input->post('fecha');
            
            $datos_usuario = array(
                'idusuario' => $idusuario,
                'txtpassword' => $password,
                'txtcorreo' => $correo,
                'txtnombres' => $nombres,
                'txtapellidos' => $apellidos,
                'txttelefono' => $telefono,
                'danacimiento' => $fecha
            );

            $data = $this->M_usuarios->editDatosUsuario($datos_usuario);
            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function estadoUsuario(){
        $data['error'] = EXIT_ERROR;
        try {
            $user = $this->input->post('user');
            $flg = $this->input->post('flg');

            $data = $this->M_usuarios->estadoUsuario($user, $flg);
            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function getRolesUsuario(){
        $data['error'] = EXIT_ERROR;
        try {
            $user = $this->input->post('user');

            $data = $this->getRolesByUsuario($user);
            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function getRolesByUsuario($user){
        $data = $this->M_usuarios->getRolesUsuario($user);
        $data["html"] = "";
        if ($data['error'] == EXIT_ERROR){
            $data['error'] = EXIT_SUCCESS;
            return $data;
        }
        $cont = 0;
        foreach($data['result'] as $dat){
            $cont++;
            $data["html"] .=
                "<tr>
                    <td>".$cont."</td>
                    <td>".$dat->txtrol."</td>
                    <td>
                        <div class='block_container'>
                            <div class='block' onclick='modalConfirmarQuitarRol(".$dat->idrol.")'><i class='far fa-trash-alt tooltip-test' title='Eliminar' style='color: black'></i>
                            </div>
                        </div>
                    </td>
                </tr>";
        }
        return $data;
    }

    function asignarRolUsuario(){
        $data['error'] = EXIT_ERROR;
        try {
            $idusuario = $this->input->post('idusuario');
            $rol     = $this->input->post('rol');

            $data = $this->M_usuarios->asignarRolUsuario($idusuario,$rol);
            if ($data['error'] == EXIT_ERROR){
                echo json_encode($data);
                return;
            }

            $data = $this->getRolesByUsuario($idusuario);
            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function removeRolUsuario(){
        $data['error'] = EXIT_ERROR;
        try {
            $idusuario = $this->input->post('idusuario');
            $rol     = $this->input->post('rol');

            $data = $this->M_usuarios->removeRolUsuario($idusuario,$rol);
            if ($data['error'] == EXIT_ERROR){
                echo json_encode($data);
                return;
            }

            $data = $this->getRolesByUsuario($idusuario);
            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
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

    public function getPermisosUsuario(){
        $data['error'] = EXIT_ERROR;
        try {
            $user = $this->input->post('user');

            $data = $this->getPermisosByUsuario($user);
            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function getPermisosByUsuario($user){
        $data = $this->M_usuarios->getPermisosUsuario($user);
        $data["html"] = "";
        if ($data['error'] == EXIT_ERROR){
            $data['error'] = EXIT_SUCCESS;
            return $data;
        }
        $cont = 0;
        foreach($data['result'] as $dat){
            $cont++;
            $data["html"] .=
                "<tr>
                    <td>".$cont."</td>
                    <td>".$dat->txtsistema."</td>
                    <td>".$dat->txtpermiso."</td>
                    <td>
                        <div class='block_container'>
                            <div class='block' onclick='modalConfirmarQuitarPermiso(".$dat->idpermiso.")'><i class='far fa-trash-alt tooltip-test' title='Eliminar' style='color: black'></i>
                            </div>
                        </div>
                    </td>
                </tr>";
        }
        return $data;
    }

    function asignarPermisoUsuario(){
        $data['error'] = EXIT_ERROR;
        try {
            $idusuario = $this->input->post('idusuario');
            $permiso     = $this->input->post('permiso');

            $data = $this->M_usuarios->asignarPermisoUsuario($idusuario,$permiso);
            if ($data['error'] == EXIT_ERROR){
                echo json_encode($data);
                return;
            }

            $data = $this->getPermisosByUsuario($idusuario);
            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function removePermisoUsuario(){
        $data['error'] = EXIT_ERROR;
        try {
            $permiso   = $this->input->post('permiso');
            $idusuario = $this->input->post('idusuario');

            $data = $this->M_usuarios->removePermisoUsuario($idusuario,$permiso);
            if ($data['error'] == EXIT_ERROR){
                echo json_encode($data);
                return;
            }

            $data = $this->getPermisosByUsuario($idusuario);
            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
