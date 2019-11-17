<?php

class M_documentos extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function insertarDocumento($datos_documento) {
        
        $resultado = $this->db->query('SELECT * FROM "MDB_INT"."INT_INSERTARDOCUMENTO"(?,?,?,?,?,?)',$datos_documento);
        if($resultado->result()[0]->INT_INSERTARDOCUMENTO == 'OK'){
            return array('error'=> EXIT_SUCCESS);
        } else {
            return array('error'=> EXIT_ERROR,
                         'msj'=> 'No se pudo registrar el documento');
        }
    }
}
