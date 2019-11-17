<?php

class M_noticias extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function insertarNoticias($datos_noticia) {
        $resultado = $this->db->query('SELECT * FROM "MDB_INT"."INT_INSERTARNOTICIA"(?,?,?,?,?,?,?)',$datos_noticia);
        
        log_message('error',print_r($resultado->result()[0]->INT_INSERTARNOTICIA,true));
        if($resultado->result()[0]->INT_INSERTARNOTICIA == 'OK'){
            return array('error'=> EXIT_SUCCESS);
        } else {
            return array('error'=> EXIT_ERROR,
                         'msj'=> 'No se pudo registrar el documento');
        }
    }
}
