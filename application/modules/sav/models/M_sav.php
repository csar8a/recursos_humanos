<?php

class M_sav extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function registrarServicio($datos_persona, $datos_sav) {
        $this->db->trans_start();
        $sql= 'SELECT * FROM "MDB_GRAL"."GRAL_INSUPDDATOSPERSONA"(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
        $result = $this->db->query($sql, $datos_persona);
        $data = explode('|',$result->result()[0]->GRAL_INSUPDDATOSPERSONA);
        if($data[0] == 'OK'){

            $datos_sav['IDPERSONA'] = $data[1];
            $sql= 'SELECT * FROM "MDB_SAV"."SAV_INSERTARSERVICIO"(?,?,?,?,?,?)';
            $result = $this->db->query($sql, $datos_sav);
            if($result->result()[0]->SAV_INSERTARSERVICIO == 'OK'){
                $this->db->trans_complete();
                return array('error'=> EXIT_SUCCESS);
            } else {
                return array('error'=> EXIT_ERROR);
            }
        } else {
            return array('error'=> EXIT_ERROR);
        }
    }
}