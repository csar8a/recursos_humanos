<?php

class M_permisos extends CI_Model
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
    
    function getConfigPermisos($sistema,$permiso,$rol) {
        $sql = 'SELECT * FROM "MDB_SEG"."SEG_GETCONFIGPERMISOS"(?,?,?)';
        $result = $this->db->query($sql,array($sistema,$permiso,$rol));
        if($result->num_rows() != 0) {
            return array('error'  => EXIT_SUCCESS,
                         'result' => $result->result());
        } else {
            return array('error'=> EXIT_ERROR);
        }
    }
}
