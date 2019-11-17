<?php

class M_utils extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function getAreas($idarea = NULL) {
        $sql = 'SELECT * FROM "MDB_GRAL"."GRAL_AREAS"(?)';
        $result = $this->db->query($sql,array($idarea));
        if($result->num_rows() != 0) {
            return array('error'  => EXIT_SUCCESS,
                         'result' => $result->result());
        } else {
            return array('error'=> EXIT_ERROR);
        }
    }

    function getYearsNormas() {
        $sql = 'SELECT * FROM "MDB_GRAL"."GRAL_NUMANIOS"()';
        $result = $this->db->query($sql);
        if($result->num_rows() != 0) {
            return array('error'  => EXIT_SUCCESS,
                         'result' => $result->result());
        } else {
            return array('error'=> EXIT_ERROR);
        }
    }
    
    function getSedes() {
        $sql = 'SELECT "IDSEDE", "TXTSEDE"
                  FROM "MDB_GRAL"."GRAL_SEDE"
                 WHERE "FLGACTI" = 1::text
              ORDER BY "TXTSEDE"';
        $result = $this->db->query($sql);
        if($result->num_rows() != 0) {
            return array('error'  => EXIT_SUCCESS,
                         'result' => $result->result());
        } else {
            return array('error'=> EXIT_ERROR);
        }
    }

    function getCategorias() {
        $result = $this->db->query('SELECT * FROM "MDB_SAV"."SAV_GETCATEGORIAS"()');
        if($result->num_rows() != 0) {
            return array('error'  => EXIT_SUCCESS, 'result' => $result->result());
        } else {
            return array('error'=> EXIT_ERROR);
        }
    }
    
    function getSubcategorias($idcategoria) {
        $result = $this->db->query('SELECT * FROM "MDB_SAV"."SAV_GETSUBCATEGORIAS"(?)', array($idcategoria));
        if($result->num_rows() != 0) {
            return array('error'  => EXIT_SUCCESS, 'result' => $result->result());
        } else {
            return array('error'=> EXIT_ERROR);
        }
    }
    
    /* motivos en contactanos o sugerencias*/
    function getMotivos(){
        $sql = "SELECT * 
                  FROM mdb_contacto.contacto_motivo";
        $result = $this->db->query($sql);
        if($result->num_rows() != 0) {
            return array('error'  => EXIT_SUCCESS,
                          'result' => $result->result());
        } else {
            return array('error'=>EXIT_ERROR);
        }
    }

    function getParametrosByCategoria($categoria){
        $sql = 'SELECT * FROM "MDB_GRAL"."GRAL_COMBOPARAMETROS"(?)';
        $result = $this->db->query($sql, array($categoria));
        if($result->num_rows() != 0) {
            return array('error'  => EXIT_SUCCESS,
                          'result' => $result->result());
        } else {
            return array('error'=>EXIT_ERROR);
        }
    }


    function insertarPideConsulta($datos_pide) {
        $resultado = $this->db->query('SELECT * FROM "MDB_GRAL"."GRAL_INSERTARCONSULTAPIDE"(?,?,?,?,?)',$datos_pide);
        $data = explode('|',$resultado->result()[0]->GRAL_INSERTARCONSULTAPIDE);
        if($data[0] == 'OK'){
            return array('error'=> EXIT_SUCCESS,
                            'codigo'=>$data[1]);
            
        } else {
            return array('error'=> EXIT_ERROR,
                         'msj'=> 'No se pudo registrar');
        }
    }
    
    
    function getModulos($idrol, $idusuario) {
        $sql = 'SELECT * FROM "MDB_SEG"."SEG_MODULOSACCESO"(?,?) ';
        $result = $this->db->query($sql,array($idrol, $idusuario));
        
        if($result->num_rows() != 0) {
            return array( 'error'  => EXIT_SUCCESS, 
                          'result' => $result->result());
        } else {
            return array('error'=> EXIT_ERROR);
        }
    }

    function getDatosPersona($tipodoc,$doc){
        $sql= 'SELECT * FROM "MDB_GRAL"."GRAL_DATOSPERSONA"(?, ?)';
        $result = $this->db->query($sql,array($tipodoc, $doc));
        if($result->num_rows() != 0) {
            return array( 'error'  => EXIT_SUCCESS,
                          'result' => $result->row_array());
        } else {
            return array('error'=> EXIT_ERROR);
        }
    }

    function getValorByParametro($parametro,$categoria) {
        $sql = 'SELECT * FROM "MDB_GRAL"."GRAL_VALORBYPARAMETRO"(?,?);';
        $result = $this->db->query($sql,array($parametro,$categoria));
        if($result->num_rows() != 0) {
            return array('error'  => EXIT_SUCCESS,
                         'result' => $result->result());
        } else {
            return array('error'=> EXIT_ERROR);
        }
    }
    
    function getAllModulos() {
        $sql = 'SELECT * FROM "MDB_SEG"."SEG_GETMODULOS"()';
        $result = $this->db->query($sql,array());
        if($result->num_rows() != 0) {
            return array('error'  => EXIT_SUCCESS,
                         'result' => $result->result());
        } else {
            return array('error'=> EXIT_ERROR);
        }
    }

    function getRoles() {
        $sql = 'SELECT * FROM "MDB_SEG"."SEG_GETROLES"()';
        $result = $this->db->query($sql,array());
        if($result->num_rows() != 0) {
            return array('error'  => EXIT_SUCCESS,
                         'result' => $result->result());
        } else {
            return array('error'=> EXIT_ERROR);
        }
    }

    function BuscarPide($txtconsultapide) {
        $result = $this->db->query('SELECT * FROM "MDB_GRAL"."GRAL_BUSCARPIDE"(?)', $txtconsultapide);
        if($result->num_rows() != 0) {
            return array('error'  => EXIT_SUCCESS, 'result' => $result->result());
        } else {
            return array('error'=> EXIT_ERROR);
        }
    }
}
