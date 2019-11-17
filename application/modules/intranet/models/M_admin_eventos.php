<?php

class M_admin_eventos extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    function getEventos($idevento) {
        $result = $this->db->query('SELECT * FROM "MDB_INT"."INT_GETDATOSEVENTO"(?)', array($idevento));
        if($result->num_rows() != 0) {
            return array('error'  => EXIT_SUCCESS, 'result' => $result->result());
        } else {
            return array('error'=> EXIT_ERROR);
        }
    }

    function editImagenEvento($iddocumento,$archivo){
        $result = $this->db->query('SELECT * FROM "MDB_INT"."INT_EDITIMAGENEVENTO"(?,?)',array(intval($iddocumento),$archivo));
        $data = explode('|',$result->result()[0]->INT_EDITIMAGENEVENTO);
        if($data[0] == 'OK'){
            return array('error'=> EXIT_SUCCESS);
        } else {
            return array('error'=> EXIT_ERROR,
                         'msj'=> 'No se pudo editar la imagen');
        }
    }

    function editDatosEvento($datos_evento){
        $result = $this->db->query('SELECT * FROM "MDB_INT"."INT_EDITDATOSEVENTO"(?,?,?,?,?,?,?,?,?,?)',$datos_evento);
        $data = explode('|',$result->result()[0]->INT_EDITDATOSEVENTO);
        if($data[0] == 'OK'){
            return array('error'=> EXIT_SUCCESS);
        } else {
            return array('error'=> EXIT_ERROR,
                         'msj'=> 'No se pudo editar el evento');
        }
    }
}
