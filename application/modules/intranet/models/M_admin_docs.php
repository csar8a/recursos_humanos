<?php

class M_admin_docs extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    function datosDocumentos($datos_doc) {
        $result = $this->db->query('SELECT * FROM "MDB_INT"."INT_BUSCARDOCUMENTO"(?,?,?,?)', $datos_doc);
        if($result->num_rows() != 0) {
            return array('error'  => EXIT_SUCCESS, 'result' => $result->result());
        } else {
            return array('error'=> EXIT_ERROR);
        }
    }

    function getDatosArchivo($iddocumento){
        $result = $this->db->query('SELECT * FROM "MDB_INT"."INT_GETDATOSDOCUMENTO"(?)', array($iddocumento));
        if($result->num_rows() != 0) {
            return array('error'  => EXIT_SUCCESS, 'result' => $result->result());
        } else {
            return array('error'=> EXIT_ERROR);
        }
    }

    function editDocArchivo($iddocumento,$archivo){
        $result = $this->db->query('SELECT * FROM "MDB_INT"."INT_EDITARCHIVO"(?,?)',array(intval($iddocumento),$archivo));
        $data = explode('|',$result->result()[0]->INT_EDITARCHIVO);
        if($data[0] == 'OK'){
            return array('error'=> EXIT_SUCCESS);
        } else {
            return array('error'=> EXIT_ERROR,
                         'msj'=> 'No se pudo editar el archivo');
        }
    }

    function editDocDatos($iddocumento,$nombre,$desc,$idtipo){
        $result = $this->db->query('SELECT * FROM "MDB_INT"."INT_EDITDATOSDOC"(?,?,?,?)',array($iddocumento,$nombre,$desc,$idtipo));
        $data = explode('|',$result->result()[0]->INT_EDITDATOSDOC);
        if($data[0] == 'OK'){
            return array('error'=> EXIT_SUCCESS);
        } else {
            return array('error'=> EXIT_ERROR,
                         'msj'=> 'No se pudo editar el documento');
        }
    }
}
