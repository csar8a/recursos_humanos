<?php

class M_usuarios extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    function getPermisosByModulo($idmodulo) {
        $sql = 'SELECT * FROM "MDB_SEG"."SEG_GETPERMISOSBYMODULO"(?)';
        $result = $this->db->query($sql,array($idmodulo));
        if($result->num_rows() != 0) {
            return array('error'  => EXIT_SUCCESS,
                         'result' => $result->result());
        } else {
            return array('error'=> EXIT_ERROR);
        }
    }
    
    function getRolesByPermiso($idpermiso) {
        $sql = 'SELECT * FROM "MDB_SEG"."SEG_GETROLESBYPERMISO"(?)';
        $result = $this->db->query($sql,array($idpermiso));
        if($result->num_rows() != 0) {
            return array('error'  => EXIT_SUCCESS,
                         'result' => $result->result());
        } else {
            return array('error'=> EXIT_ERROR);
        }
    }

    function asignarRolPermiso($idrol,$idpermiso) {
        $result = $this->db->query('SELECT * FROM "MDB_SEG"."SEG_ASIGNARROLPERMISO"(?,?)',array($idrol,$idpermiso));
        $data = explode('|',$result->result()[0]->SEG_ASIGNARROLPERMISO);
        if($data[0] == 'OK'){
            if($data[1] != 0){
                return array('error'=> EXIT_ERROR,
                             'msj'=> 'Este rol ya tiene el permiso asignado');
            } else {
                return array('error'=> EXIT_SUCCESS);
            }
        } else {
            return array('error'=> EXIT_ERROR,
                         'msj'=> 'No se pudo asignar el rol');
        }
    }

    function removeRolPermiso($idrol,$idpermiso) {
        $result = $this->db->query('SELECT * FROM "MDB_SEG"."SEG_REMOVERROLPERMISO"(?,?)',array($idrol,$idpermiso));
        $data = explode('|',$result->result()[0]->SEG_REMOVERROLPERMISO);
        if($data[0] == 'OK'){
            if($data[1] == 0){
                return array('error' => EXIT_ERROR,
                             'msj'   => 'No se pudo quitar el rol');
            } else {
                return array('error'=> EXIT_SUCCESS);
            }
        } else {
            return array('error' => EXIT_ERROR,
                         'msj'   => 'No se pudo quitar el rol');
        }
    }

    function registrarUsuario($datos_usuario) {
        $result = $this->db->query('SELECT * FROM "MDB_SEG"."SEG_REGISTRARUSUARIO"(?,?,?,?,?,?,?,?,?,?,?,?)', $datos_usuario);
        $data = explode('|',$result->result()[0]->SEG_REGISTRARUSUARIO);
        if($data[0] == 'OK'){
            if($data[1] == 0 && $data[2] == 0){
                return array('error'=> EXIT_SUCCESS);
            } else {
                if($data[1] != 0){
                    return array('error' => EXIT_ERROR,
                                 'msj'   => 'El documento ya ha sido registrado anteriormente');
                } elseif ($data[2] != 0){
                    return array('error' => EXIT_ERROR,
                                 'msj'   => 'El usuario ya ha sido registrado anteriormente');
                }
            }
        } else {
            return array('error' => EXIT_ERROR,
                         'msj'   => 'No se pudo registrar el usuario');
        }
    }

    function buscarUsuarioNombre($nombres) {
        $sql = 'SELECT * FROM "MDB_SEG"."SEG_BUSQUEDAUSUARIO"(?)';
        $result = $this->db->query($sql,array($nombres));
        if($result->num_rows() != 0) {
            return array('error'  => EXIT_SUCCESS,
                         'result' => $result->result());
        } else {
            return array('error'=> EXIT_ERROR);
        }
    }

    function asignarArea($idusuario,$idarea,$fechainicio,$fechafin){
        $resultado = $this->db->query('SELECT * FROM "MDB_SEG"."SEG_ASIGNARAREA"(?,?,?,?)',array($idusuario,$idarea,$fechainicio,$fechafin));
        if($resultado->result()[0]->SEG_ASIGNARAREA == 'OK'){
            return array('error'=> EXIT_SUCCESS);
        } else {
            return array('error'=> EXIT_ERROR);
        }
    }

    function getFechasAreaUsuario($idusuario){
        $sql = 'SELECT * FROM "MDB_SEG"."SEG_GETFECHASAREA"(?)';
        $result = $this->db->query($sql,array($idusuario));
        if($result->num_rows() != 0) {
            return array('error'  => EXIT_SUCCESS,
                         'result' => $result->result());
        } else {
            return array('error'=> EXIT_ERROR);
        }
    }

    function getDatosUsuario($idusuario){
        $sql = 'SELECT * FROM "MDB_SEG"."SEG_GETDATOSUSUARIO"(?)';
        $result = $this->db->query($sql,array($idusuario));
        if($result->num_rows() != 0) {
            return array('error'  => EXIT_SUCCESS,
                         'result' => $result->result());
        } else {
            return array('error'=> EXIT_ERROR);
        }
    }

    function editDatosUsuario($datos_usuario){
        $resultado = $this->db->query('SELECT * FROM "MDB_SEG"."SEG_EDITARUSUARIO"(?,?,?,?,?,?,?)',$datos_usuario);
        if($resultado->result()[0]->SEG_EDITARUSUARIO == 'OK'){
            return array('error'=> EXIT_SUCCESS);
        } else {
            return array('error'=> EXIT_ERROR);
        }
    }

    function estadoUsuario($user, $flg){
        $resultado = $this->db->query('SELECT * FROM "MDB_SEG"."SEG_ESTADOUSUARIO"(?,?)',array($user, $flg));
        if($resultado->result()[0]->SEG_ESTADOUSUARIO == 'OK'){
            return array('error'=> EXIT_SUCCESS);
        } else {
            return array('error'=> EXIT_ERROR);
        }
    }

    function getRolesUsuario($idusuario){
        $sql = 'SELECT * FROM "MDB_SEG"."SEG_GETROLESUSUARIO"(?)';
        $result = $this->db->query($sql,array($idusuario));
        if($result->num_rows() != 0) {
            return array('error'  => EXIT_SUCCESS,
                         'result' => $result->result());
        } else {
            return array('error'=> EXIT_ERROR);
        }
    }

    function asignarRolUsuario($idusuario,$idrol) {
        $result = $this->db->query('SELECT * FROM "MDB_SEG"."SEG_ASIGNARROLUSUARIO"(?,?)',array($idusuario,$idrol));
        $data = explode('|',$result->result()[0]->SEG_ASIGNARROLUSUARIO);
        if($data[0] == 'OK'){
            if($data[1] != 0){
                return array('error'=> EXIT_ERROR,
                             'msj'=> 'El usuario ya tiene este rol asignado');
            } else {
                return array('error'=> EXIT_SUCCESS);
            }
        } else {
            return array('error'=> EXIT_ERROR,
                         'msj'=> 'No se pudo asignar el rol');
        }
    }

    function removeRolUsuario($idusuario,$rol) {
        $result = $this->db->query('SELECT * FROM "MDB_SEG"."SEG_REMOVERROLUSUARIO"(?,?)',array($idusuario,$rol));
        $data = explode('|',$result->result()[0]->SEG_REMOVERROLUSUARIO);
        if($data[0] == 'OK'){
            if($data[1] == 0){
                return array('error' => EXIT_ERROR,
                             'msj'   => 'No se pudo quitar el rol');
            } else {
                return array('error'=> EXIT_SUCCESS);
            }
        } else {
            return array('error' => EXIT_ERROR,
                         'msj'   => 'No se pudo quitar el rol');
        }
    }

    function getPermisosUsuario($idusuario){
        $sql = 'SELECT * FROM "MDB_SEG"."SEG_GETPERMISOSUSUARIO"(?)';
        $result = $this->db->query($sql,array($idusuario));
        if($result->num_rows() != 0) {
            return array('error'  => EXIT_SUCCESS,
                         'result' => $result->result());
        } else {
            return array('error'=> EXIT_ERROR);
        }
    }

    function asignarPermisoUsuario($idusuario,$permiso){
        $result = $this->db->query('SELECT * FROM "MDB_SEG"."SEG_ASIGNARPERMISOUSUARIO"(?,?)',array($idusuario,$permiso));
        $data = explode('|',$result->result()[0]->SEG_ASIGNARPERMISOUSUARIO);
        if($data[0] == 'OK'){
            if($data[1] != 0){
                return array('error'=> EXIT_ERROR,
                             'msj'=> 'El usuario ya tiene este permiso asignado');
            } else {
                return array('error'=> EXIT_SUCCESS);
            }
        } else {
            return array('error'=> EXIT_ERROR,
                         'msj'=> 'No se pudo asignar el permiso');
        }
    }

    function removePermisoUsuario($idusuario,$idpermiso){
        $result = $this->db->query('SELECT * FROM "MDB_SEG"."SEG_REMOVERPERMISOUSUARIO"(?,?)',array($idusuario,$idpermiso));
        $data = explode('|',$result->result()[0]->SEG_REMOVERPERMISOUSUARIO);
        if($data[0] == 'OK'){
            if($data[1] == 0){
                return array('error' => EXIT_ERROR,
                             'msj'   => 'No se pudo quitar el permiso');
            } else {
                return array('error'=> EXIT_SUCCESS);
            }
        } else {
            return array('error' => EXIT_ERROR,
                         'msj'   => 'No se pudo quitar el permiso');
        }
    }
}
