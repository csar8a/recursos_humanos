<?php

class M_reporte_pide extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    function cargarReporte($fechainicio,$fechafin) {
        $sql = 'SELECT * FROM "MDB_GRAL"."GRAL_REPORTEPIDE"(?,?)';
        $result = $this->db->query($sql,array($fechainicio,$fechafin));
        if($result->num_rows() != 0) {
            return array('error'  => EXIT_SUCCESS, 'result' => $result->result());
        } else {
            return array('error'=> EXIT_ERROR);
        }
    }
}
