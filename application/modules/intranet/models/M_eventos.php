<?php

class M_eventos extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function insertarEvento($datos_evento) {
        $resultado = $this->db->query('SELECT * FROM "MDB_INT"."INT_INSERTAREVENTO"(?,?,?,?,?,?,?,?,?,?,?)',$datos_evento);
        if($resultado->result()[0]->INT_INSERTAREVENTO == 'OK'){
            return array('error'=> EXIT_SUCCESS);
        } else {
            return array('error'=> EXIT_ERROR,
                         'msj'=> 'No se pudo registrar el evento');
        }
    }
}
