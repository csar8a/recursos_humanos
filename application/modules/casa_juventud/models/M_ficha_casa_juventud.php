<?php

class M_ficha_casa_juventud extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    //datosPersona,datosDireccion -> MDB_GENERAL y datosAI -> MDB_DOCS(default)
    
    function insertarFicha($datos_joven, $datos_apoderado) {
        //log_message('error',print_r(3,true));
        //log_message('error',print_r($datos_joven,true));
        //log_message('error',print_r($datos_apoderado,true));
        $this->db->trans_start();        
        $sql= 'SELECT * FROM "MDB_MODULOS"."MODULOS_INSDATOSJOVEN"(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
        $result = $this->db->query($sql, $datos_joven);
        log_message('error',print_r($result->result()[0]->MODULOS_INSDATOSJOVEN,true));
        $data = explode('|',$result->result()[0]->MODULOS_INSDATOSJOVEN);

        if($data[2] != '0'){
            //log_message('error',print_r('abel hola',true));
            $this->db->trans_rollback();
            return array('error'=> EXIT_ERROR,'msj'=> 'El usuario tiene una ficha valida');
        }
        else if($data[0] == 'OK'){
            if($datos_apoderado != "0") {
            //log_message('error',print_r('abel hola2',true));
                $sql= 'SELECT * FROM "MDB_MODULOS"."MODULOS_INSDATOSAPODERADO"(?,?,?,?,?,?,?,?,?,?,?,?,?)';
                $result = $this->db->query($sql, $datos_apoderado);
                //log_message('error',print_r($result->result()[0]->MODULOS_INSDATOSAPODERADO,true));
                $data2 = explode('|',$result->result()[0]->MODULOS_INSDATOSAPODERADO);
                if($data2[0] == 'OK'){
                    $this->db->trans_complete();
                    return array('error'=> EXIT_SUCCESS,'codigo1'=>$data[1],'codigo2'=>$data2[1]);
                } else {
                    $this->db->trans_rollback();
                    return array('error'=> EXIT_ERROR);
                }
            } else {
                $this->db->trans_complete();
                return array('error'=> EXIT_SUCCESS,'codigo1'=>$data[1],'codigo2'=>"0");
            }
        } else {

            $this->db->trans_rollback();
            return array('error'=> EXIT_ERROR,'msj'=> 'Error');
        }
    }



    function insertarFichaFinal($datos_ficha) {
       // log_message('error',print_r(4,true));
       // log_message('error',print_r($datos_ficha,true));
        $resultado = $this->db->query('SELECT * FROM "MDB_MODULOS"."MODULOS_INSERTARFICHA"(?,?,?,?,?)',$datos_ficha);
        $data = explode('|',$resultado->result()[0]->MODULOS_INSERTARFICHA);
        if($data[0] == 'OK'){
            return array('error'=> EXIT_SUCCESS);
            
        } else {
            return array('error'=> EXIT_ERROR,
                         'msj'=> 'No se pudo registrar');
        }
        }
}

