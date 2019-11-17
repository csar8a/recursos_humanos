<?php

class M_usuarios_intranet extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function buscarUsuarioNombre($nombres) {
        $sql = 'SELECT * FROM "MDB_SEG"."SEG_BUSQUEDAUSUARIOINTRANET"(?)';
        $result = $this->db->query($sql,array($nombres));
        if($result->num_rows() != 0) {
            return array('error'  => EXIT_SUCCESS,
                         'result' => $result->result());
        } else {
            return array('error'=> EXIT_ERROR);
        }
    }

    function estadoUsuario($user, $flg){
        $resultado = $this->db->query('SELECT * FROM "MDB_SEG"."SEG_ESTADOUSUARIOINTRANET"(?,?)',array($user, $flg));
        if($resultado->result()[0]->SEG_ESTADOUSUARIOINTRANET == 'OK'){
            return array('error'=> EXIT_SUCCESS);
        } else {
            return array('error'=> EXIT_ERROR);
        }
    }

    function registrarUsuario($datos_usuario) {
        $result = $this->db->query('SELECT * FROM "MDB_SEG"."SEG_REGISTRARUSUARIOINTRANET"(?,?,?,?,?,?,?,?)', $datos_usuario);
        $data = explode('|',$result->result()[0]->SEG_REGISTRARUSUARIOINTRANET);
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

    function getDatosUsuario($idusuario){
        $sql = 'SELECT * FROM "MDB_SEG"."SEG_GETDATOSUSUARIOINTRANET"(?)';
        $result = $this->db->query($sql,array($idusuario));
        if($result->num_rows() != 0) {
            return array('error'  => EXIT_SUCCESS,
                         'result' => $result->result());
        } else {
            return array('error'=> EXIT_ERROR);
        }
    }

    function editDatosUsuario($datos_usuario){
        $resultado = $this->db->query('SELECT * FROM "MDB_SEG"."SEG_EDITARUSUARIOINTRANET"(?,?,?,?,?,?,?)',$datos_usuario);
        if($resultado->result()[0]->SEG_EDITARUSUARIOINTRANET == 'OK'){
            return array('error'=> EXIT_SUCCESS);
        } else {
            return array('error'=> EXIT_ERROR);
        }
    }

    function getAreaUsuario($idusuario){
        $sql = 'SELECT * FROM "MDB_SEG"."SEG_GETAREAUSUARIOINTRANET"(?)';
        $result = $this->db->query($sql,array($idusuario));
        if($result->num_rows() != 0) {
            return array('error'  => EXIT_SUCCESS,
                         'result' => $result->result());
        } else {
            return array('error'=> EXIT_ERROR);
        }
    }

    function asignarArea($idusuario,$idarea){
        $resultado = $this->db->query('SELECT * FROM "MDB_SEG"."SEG_ASIGNARAREAINTRANET"(?,?)',array($idusuario,$idarea));
        if($resultado->result()[0]->SEG_ASIGNARAREAINTRANET == 'OK'){
            return array('error'=> EXIT_SUCCESS);
        } else {
            return array('error'=> EXIT_ERROR);
        }
    }
}
