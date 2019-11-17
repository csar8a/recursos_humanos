<?php

class M_admin_acceso extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    function getDatosContactos($idAreaInicial,$idTipo,$idcontacto=null) {//IDAREAINICIAL INTEGER,IDTIPO INTEGER
        $result = $this->db->query('SELECT * FROM "MDB_CON"."CON_MOVIMIENTOS"(?,?,?)', array($idAreaInicial,$idTipo,$idcontacto));
        if($result->num_rows() != 0) {
            return array('error'  => EXIT_SUCCESS, 'result' => $result->result());
        } else {
            return array('error'=> EXIT_ERROR);
        }
    }

    function asignarArea($areaDerivada, $idContacto, $mensaje, $username) {
        $resultado = $this->db->query('SELECT * FROM "MDB_CON"."CON_ASIGNARAREA"(?,?,?,?)', array($areaDerivada, $idContacto, $mensaje, $username));
        if($resultado->result()[0]->CON_ASIGNARAREA == 'OK'){
            return array('error'=> EXIT_SUCCESS);
        } else {
            return array('error'=> EXIT_ERROR,
                         'msj'=> 'No se pudo registrar el documento');
        }
    }
    
    function archivarContacto($idContacto, $username) {
        $resultado = $this->db->query('SELECT * FROM "MDB_CON"."CON_ARCHIVARCONTACTO"(?,?)', array($idContacto, $username));
        if($resultado->result()[0]->CON_ARCHIVARCONTACTO == 'OK'){
            return array('error'=> EXIT_SUCCESS);
        } else {
            return array('error'=> EXIT_ERROR,
                         'msj'=> 'No se pudo registrar el documento');
        }
    }

    function datosVecino($idcontacto){
        $result = $this->db->query('SELECT * FROM "MDB_CON"."CON_DATOSVECINO"(?)', array($idcontacto));
        if($result->num_rows() != 0) {
            return array('error'  => EXIT_SUCCESS, 'result' => $result->result());
        } else {
            return array('error'=> EXIT_ERROR);
        }
    }

    function responderContacto($idContacto, $username, $mensaje){
        $resultado = $this->db->query('SELECT * FROM "MDB_CON"."CON_RESPONDERCONTACTO"(?,?,?)', array($idContacto, $username, $mensaje));
        if($resultado->result()[0]->CON_RESPONDERCONTACTO == 'OK'){
            return array('error'=> EXIT_SUCCESS);
        } else {
            return array('error'=> EXIT_ERROR,
                         'msj'=> 'No se pudo responder');
        }
    }
    
}
