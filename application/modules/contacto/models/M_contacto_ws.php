<?php

class M_contacto_ws extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    function contacto_ws_old($date,$numllamada) {
        //$date = '2019-08-04 14:00:30.848287'; //pruebas local
        //$date = '2019-08-05 14:00:49'; //pruebas asterisk
        
        $sql = 'SELECT * FROM `asteriskcdr_storage`.`cdr_201908` 
                 WHERE `src`      = ?
                 AND TIMESTAMPDIFF(MINUTE,`datetime`, ?)= 1';
        $asterisk = $this->load->database('asterisk', TRUE);
        $result = $asterisk->query($sql,array($numllamada,$date));
        log_message('error',print_r($result->result(),true)); //Datos de la llamada
        if($result->num_rows() != 0) {
            $data = $result->result()[0];
            
            $sql = 'INSERT INTO "MDB_CON"."CON_CONTACTO"(
                        "IDTIPOCONTACTO", "TXTCODIGO", "IDESTADO", "IDTIPO", "TXTTELEFONO")
                    VALUES ( 97, ?, ?, ?, ?)';
            $result = $this->db->query($sql,array(rand(1000,6000),ESTADO_CONTACTO_PENDIENTE,CON_TIPO_CONTACTO,$data->src));

            return array('error'  => EXIT_SUCCESS, 'result' => $data);
        } else {
            return array('error'=> EXIT_ERROR);
        }
    }
    
    function contacto_ws($date,$numllamada) {
        $sql = 'SELECT "CON_RANDOMCONTACTO" 
                  FROM "MDB_CON"."CON_RANDOMCONTACTO" ()';
                  
        $result = $this->db->query($sql);
        $cod = $result->result()[0]->CON_RANDOMCONTACTO;
        $data_con = array( 'IDTIPOCONTACTO' => 97,
                            'TXTCODIGO'     => $cod,
                            'IDESTADO'      => ESTADO_CONTACTO_PENDIENTE,
                            'IDTIPO'        => CON_TIPO_CONTACTO,
                            'TXTTELEFONO'   => $numllamada,
                            'IDMEDIO'       => 108
                    );
        $this->db->trans_start();
        $this->db->insert("MDB_CON.CON_CONTACTO",$data_con);
        $this->db->trans_complete();

        $insert_id = $this->db->insert_id();

        $data_mov = array('IDAREAINICIAL' => 2,
                          'IDCONTACTO'    => $insert_id
                    );
        $this->db->trans_start();
        $this->db->insert("MDB_CON.CON_CONTACTOMOVIMIENTO",$data_mov);
        $this->db->trans_complete();

        return array('cod'=>$cod, 'id'=>$insert_id);
    }
}
