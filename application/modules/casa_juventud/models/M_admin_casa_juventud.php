<?php

class M_admin_casa_juventud extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function getAllDatos($id_ficha2) {
        $result = $this->db->query('SELECT * FROM "MDB_MODULOS"."MODULOS_GETALLDATOSFICHA_CJ"(?)', array($id_ficha2));
        if($result->num_rows() != 0) {
            return array('error'  => EXIT_SUCCESS, 'result' => $result->result());
        } else {
            return array('error'=> EXIT_ERROR);
        }
    }

    function getAllDatosFicha($id_ficha2) {
        $result = $this->db->query('SELECT * FROM "MDB_MODULOS"."MODULOS_GETALLDATOSFICHA_CJ2"(?)', array($id_ficha2));
        if($result->num_rows() != 0) {
            return array('error'  => EXIT_SUCCESS, 'result' => $result->result());
        } else {
            return array('error'=> EXIT_ERROR);
        }
    }

    /*function getDatosNorma($idnor){
        $result = $this->db->query('SELECT * FROM "MDB_GRAL"."GRAL_GETDATOSNORMAS"(?)', array($idnor));
        if($result->num_rows() != 0) {
            return array('error'  => EXIT_SUCCESS, 'result' => $result->result());
        } else {
            return array('error'=> EXIT_ERROR);
        }
    }*/

    function getFichas($codigo) {
        $result = $this->db->query('SELECT * FROM "MDB_MODULOS"."MODULOS_GETDATOSFICHA_CJ"(?)', array($codigo));
        if($result->num_rows() != 0) {
            return array('error'  => EXIT_SUCCESS, 'result' => $result->result());
        } else {
            return array('error'=> EXIT_ERROR);
        }
        
    }

    function getCarnetFicha($idficha) {
        $result = $this->db->query('SELECT * FROM "MDB_MODULOS"."MODULOS_GETFICHACARNET"(?)', array($idficha));
        if($result->num_rows() != 0) {
            return array('error'  => EXIT_SUCCESS, 'result' => $result->result());
        } else {
            return array('error'=> EXIT_ERROR);
        }
        
    }

    function buscarFicha($nombre,$codigo) {
        $result = $this->db->query('SELECT * FROM "MDB_MODULOS"."MODULOS_BUSCARFICHA"(?,?)', array($nombre,$codigo));
        if($result->num_rows() != 0) {
            return array('error'  => EXIT_SUCCESS, 'result' => $result->result());
        } else {
            return array('error'=> EXIT_ERROR);
        }
    }

    function editImagenPersona($idjoven,$archivo){
        $result = $this->db->query('SELECT * FROM "MDB_MODULOS"."MODULOS_EDITIMAGEPERSONA"(?,?)',array(intval($idjoven),$archivo));
        $data = explode('|',$result->result()[0]->MODULOS_EDITIMAGEPERSONA);
        log_message('error',print_r($result,true));
        if($data[0] == 'OK'){
            return array('error'=> EXIT_SUCCESS);
        } else {
            return array('error'=> EXIT_ERROR,
                         'msj'=> 'No se pudo editar el archivo imagen');
        }
    }

    function getFamiliares($id_ficha) {
        $result = $this->db->query('SELECT * FROM "MDB_MODULOS"."MODULOS_GETFAMILIARES"(?)', array($id_ficha));
        return array('error'  => EXIT_SUCCESS, 'result' => $result->result());
        /*if($result->num_rows() != 0) {
            return array('error'  => EXIT_SUCCESS, 'result' => $result->result());
        } else {
            return array('error'=> EXIT_ERROR);
        }*/
    }

    function insertarFamiliar($datos_familiar) {
        $resultado = $this->db->query('SELECT * FROM "MDB_MODULOS"."MODULOS_INSERTFAMILIAR"(?,?,?,?,?,?)',$datos_familiar);
        
        log_message('error',print_r($resultado->result()[0]->MODULOS_INSERTFAMILIAR,true));
        if($resultado->result()[0]->MODULOS_INSERTFAMILIAR == 'OK'){
            return array('error'=> EXIT_SUCCESS);
        } else {
            return array('error'=> EXIT_ERROR,
                         'msj'=> 'No se pudo registrar el documento');
        }
    }

    function deleteFamiliar($idFamiliar){
        $resultado = $this->db->query('SELECT * FROM "MDB_MODULOS"."MODULOS_DELETEFAMILIAR"(?)',$idFamiliar);
        if($resultado->result()[0]->MODULOS_DELETEFAMILIAR == 'OK'){
            return array('error'=> EXIT_SUCCESS);
        } else {
            return array('error'=> EXIT_ERROR,
                         'msj'=> 'No se pudo eliminar el familiar.');
        }
    }

    function editFichaJoven($idjoven,$apPaternoJoven,$apMaternoJoven,
    $nombresJoven,$telefonoJoven,$celularJoven,$correoJoven,$gradoInstruccionJoven,$ocupacionJoven
    ,$centroEstudiosTrabajoJoven,$date,$estadoCivilJoven,$distrito,$viaPublica,$urbanizacion,$numero,$interior
    ,$manzana,$lote){
        $result = $this->db->query('SELECT * FROM "MDB_GRAL"."GRAL_EDITFICHAJOVEN"(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',array($idjoven,$apPaternoJoven,$apMaternoJoven,
        $nombresJoven,$telefonoJoven,$celularJoven,$correoJoven,$gradoInstruccionJoven,$ocupacionJoven
        ,$centroEstudiosTrabajoJoven,$date,$estadoCivilJoven,$distrito,$viaPublica,$urbanizacion,$numero,$interior
        ,$manzana,$lote));
        $data = explode('|',$result->result()[0]->GRAL_EDITFICHAJOVEN);
        log_message('error',print_r($data,true));
        if($data[0] == 'OK'){
            return array('error'=> EXIT_SUCCESS);
        } else {
            return array('error'=> EXIT_ERROR,
                         'msj'=> 'No se pudo editar el joven');
        }
    }

    function editFichaApoderado($idficha,$tipodocapoderado,$docapoderado,$apPaternoApoderado,$apMaternoApoderado,$nombresApoderado,
    $telefonoApoderado,$celularApoderado,$correoApoderado,$gradoInstruccionApoderado,$ocupacionApoderado,$estadoCivilApoderado,$sexoa,$date){
        $result = $this->db->query('SELECT * FROM "MDB_GRAL"."GRAL_EDITFICHAAPODERADO"(?,?,?,?,?,?,?,?,?,?,?,?,?,?)',array($idficha,$tipodocapoderado,$docapoderado,$apPaternoApoderado,$apMaternoApoderado,$nombresApoderado,
        $telefonoApoderado,$celularApoderado,$correoApoderado,$gradoInstruccionApoderado,$ocupacionApoderado,$estadoCivilApoderado,$sexoa,$date));
        $data = explode('|',$result->result()[0]->GRAL_EDITFICHAAPODERADO);
        log_message('error',print_r($data,true));
        if($data[0] == 'OK'){
            return array('error'=> EXIT_SUCCESS);
        } else {
            return array('error'=> EXIT_ERROR,
                         'msj'=> 'No se pudo editar el apoderado');
        }
    }

    
}


