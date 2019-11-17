<?php

class M_normas_vecino extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    function BuscarNormas($tipo,$year,$nombre,$descripcion) {
        $result = $this->db->query('SELECT * FROM "MDB_GRAL"."GRAL_BUSCARNORMA"(?,?,?,?)', array($tipo,$year,$nombre,$descripcion));
        
        log_message('error',$this->db->last_query());
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
}
