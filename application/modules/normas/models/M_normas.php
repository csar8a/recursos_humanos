<?php

class M_Normas extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    //datosPersona,datosDireccion -> MDB_GENERAL y datosAI -> MDB_DOCS(default)
    function insertNorma($datos_norma) {
        $resultado = $this->db->query('SELECT * FROM "MDB_GRAL"."GRAL_INSERTARNORMA"(?,?,?,?,?,?,?,?,?)',$datos_norma);
        if($resultado->result()[0]->GRAL_INSERTARNORMA == 'OK'){
            return array('error'=> EXIT_SUCCESS);
        } else {
            return array('error'=> EXIT_ERROR,
                         'msj'=> 'No se pudo registrar el documento');
        }
    }
}
