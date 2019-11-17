<?php

class M_admin_normas extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    function BuscarNormas($tipo,$year,$nombre,$descripcion) {
        $result = $this->db->query('SELECT * FROM "MDB_GRAL"."GRAL_BUSCARNORMA"(?,?,?,?)', array($tipo,$year,$nombre,$descripcion));
        if($result->num_rows() != 0) {
            return array('error'  => EXIT_SUCCESS, 'result' => $result->result());
        } else {
            return array('error'=> EXIT_ERROR);
        }
    }
    
    function incrementHit($id_norma) {
        $sql = 'SELECT * FROM "MDB_GRAL"."GRAL_INCREMENTARHITNORMA"(?)';
        $this->db->query($sql, array($id_norma));
        if($this->db->affected_rows() != 0) {
            return array('error' => EXIT_SUCCESS);
        } else {
            return array('error' => EXIT_ERROR);
        }
    }
    function getDatosNorma($idnor){
        $result = $this->db->query('SELECT * FROM "MDB_GRAL"."GRAL_GETDATOSNORMAS"(?)', array($idnor));
        if($result->num_rows() != 0) {
            return array('error'  => EXIT_SUCCESS, 'result' => $result->result());
        } else {
            return array('error'=> EXIT_ERROR);
        }
    }

    function editNormaDatos($idnorma,$norma,$descnorma,$tipo,$fecha,$year){
        $result = $this->db->query('SELECT * FROM "MDB_GRAL"."GRAL_EDITDATOSNORMA"(?,?,?,?,?,?)',array($idnorma,$norma,$descnorma,$tipo,$fecha,$year));
        $data = explode('|',$result->result()[0]->GRAL_EDITDATOSNORMA);
        log_message('error',print_r($data,true));
        if($data[0] == 'OK'){
            return array('error'=> EXIT_SUCCESS);
        } else {
            return array('error'=> EXIT_ERROR,
                         'msj'=> 'No se pudo editar la norma');
        }
    }
    
    function editDocArchivo($iddocumento,$archivo){
        $result = $this->db->query('SELECT * FROM "MDB_GRAL"."GRAL_EDITARCHIVONORMA"(?,?)',array(intval($iddocumento),$archivo));
        $data = explode('|',$result->result()[0]->GRAL_EDITARCHIVONORMA);
        if($data[0] == 'OK'){
            return array('error'=> EXIT_SUCCESS);
        } else {
            return array('error'=> EXIT_ERROR,
                         'msj'=> 'No se pudo editar el archivo');
        }
    }
}
