<?php

class M_Datos_Personales extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    function BuscarPersona($busqueda) {
        $result = $this->db->query('SELECT * FROM "MDB_PER"."PER_BUSCARPERSONA"(?)', $busqueda);
        if($result->num_rows() != 0) {
            return array('error'  => EXIT_SUCCESS, 'result' => $result->result());
        } else {
            return array('error'=> EXIT_ERROR);
        }
    }


    function BuscarVacaciones($codigo) {
        $result = $this->db->query('SELECT * FROM  "MDB_PER"."PER_BUSCARVACACIONES"(?)', $codigo);
        if($result->num_rows() != 0) {
            return array('error'  => EXIT_SUCCESS, 'result' => $result->result());
        } else {
            return array('error'=> EXIT_ERROR);
        }
    }

   
}
