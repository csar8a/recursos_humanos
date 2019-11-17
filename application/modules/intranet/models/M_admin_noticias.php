<?php

class M_admin_noticias extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    



    function buscarNoticia($busqueda) {
        $result = $this->db->query('SELECT * FROM "MDB_INT"."INT_BUSCARNOTICIA"(?)', array($busqueda));
        if($result->num_rows() != 0) {
            return array('error'  => EXIT_SUCCESS, 'result' => $result->result());
        } else {
            return array('error'=> EXIT_ERROR);
        }
    }

    function editNoticiaDatos($idnoticia,$titulo,$descripcion,$extracto,$estado){
        $result = $this->db->query('SELECT * FROM "MDB_INT"."INT_EDITDATOSNOTICIA"(?,?,?,?,?)',array($idnoticia,$titulo,$descripcion,$extracto,$estado));
        $data = explode('|',$result->result()[0]->INT_EDITDATOSNOTICIA);
        if($data[0] == 'OK'){
            return array('error'=> EXIT_SUCCESS);
        } else {
            return array('error'=> EXIT_ERROR,
                         'msj'=> 'No se pudo editar la noticia');
        }
    }

     function getDatosNoticia($idnot){
        $result = $this->db->query('SELECT * FROM "MDB_INT"."INT_GETDATOSNOTICIAS"(?)', array($idnot));
        if($result->num_rows() != 0) {
            return array('error'  => EXIT_SUCCESS, 'result' => $result->result());
        } else {
            return array('error'=> EXIT_ERROR);
        }
    }

    function editImagenNoticia($idnoticia,$archivo){
        $result = $this->db->query('SELECT * FROM "MDB_INT"."INT_EDITIMAGENOTICIA"(?,?)',array(intval($idnoticia),$archivo));
        $data = explode('|',$result->result()[0]->INT_EDITIMAGENOTICIA);
        log_message('error',print_r($result,true));
        if($data[0] == 'OK'){
            return array('error'=> EXIT_SUCCESS);
        } else {
            return array('error'=> EXIT_ERROR,
                         'msj'=> 'No se pudo editar el archivo imagen');
        }
    }

    function estadoNoticia($idnoticia, $flg){
        $resultado = $this->db->query('SELECT * FROM "MDB_INT"."INT_ESTADONOTICIA"(?,?)',array($idnoticia, $flg));
        if($resultado->result()[0]->INT_ESTADONOTICIA == 'OK'){
            return array('error'=> EXIT_SUCCESS);
        } else {
            return array('error'=> EXIT_ERROR);
        }
    }
    

    function editImagenExtraNoticia($idnoticia,$imgextra,$archivo){
        $result = $this->db->query('SELECT * FROM "MDB_INT"."INT_EDITIMAGENEXTRANOTICIA"(?,?,?)',array(intval($idnoticia),$imgextra,$archivo));
        $data = explode('|',$result->result()[0]->INT_EDITIMAGENEXTRANOTICIA);
        if($data[0] == 'OK'){
            return array('error'=> EXIT_SUCCESS);
        } else {
            return array('error'=> EXIT_ERROR,
                         'msj'=> 'No se pudo editar la imagen');
        }
    }

    function removeFotoExtra($idnoticia,$img){
        $result = $this->db->query('SELECT * FROM "MDB_INT"."INT_REMOVEFOTOEXTRANOTICIA"(?,?)',array(intval($idnoticia),$img));
        $data = explode('|',$result->result()[0]->INT_REMOVEFOTOEXTRANOTICIA);
        if($data[0] == 'OK'){
            return array('error'=> EXIT_SUCCESS);
        } else {
            return array('error' => EXIT_ERROR,
                         'msj'   => 'No se pudo quitar la foto');
        }
    }

    function addFotoExtra($idnoticia,$archivo){
        $resultado = $this->db->query('SELECT * FROM "MDB_INT"."INT_ADDFOTOEXTRANOTICIA"(?,?)',array($idnoticia,$archivo));
        if($resultado->result()[0]->INT_ADDFOTOEXTRANOTICIA == 'OK'){
            return array('error'=> EXIT_SUCCESS);
        } else {
            return array('error'=> EXIT_ERROR);
        }
    }
}
