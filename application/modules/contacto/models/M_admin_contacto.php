<?php

class M_admin_contacto extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function getDatosContactos($idAreaInicial, $idTipo, $idcontacto = null)
    { //IDAREAINICIAL INTEGER,IDTIPO INTEGER
        $result = $this->db->query('SELECT * FROM "MDB_CON"."CON_MOVIMIENTOS"(?,?,?)', array($idAreaInicial, $idTipo, $idcontacto));
        if ($result->num_rows() != 0) {
            return array('error'  => EXIT_SUCCESS, 'result' => $result->result());
        } else {
            return array('error' => EXIT_ERROR);
        }
    }

    function asignarArea($areaDerivada, $idContacto, $mensaje, $username)
    {
        $resultado = $this->db->query('SELECT * FROM "MDB_CON"."CON_ASIGNARAREA"(?,?,?,?)', array($areaDerivada, $idContacto, $mensaje, $username));
        if ($resultado->result()[0]->CON_ASIGNARAREA == 'OK') {
            return array('error' => EXIT_SUCCESS);
        } else {
            return array(
                'error' => EXIT_ERROR,
                'msj' => 'No se pudo registrar el documento'
            );
        }
    }

    function archivarContacto($idContacto, $username)
    {
        $resultado = $this->db->query('SELECT * FROM "MDB_CON"."CON_ARCHIVARCONTACTO"(?,?)', array($idContacto, $username));
        if ($resultado->result()[0]->CON_ARCHIVARCONTACTO == 'OK') {
            return array('error' => EXIT_SUCCESS);
        } else {
            return array(
                'error' => EXIT_ERROR,
                'msj' => 'No se pudo registrar el documento'
            );
        }
    }

    function datosVecino($idcontacto)
    {
        $result = $this->db->query('SELECT * FROM "MDB_CON"."CON_DATOSVECINO"(?)', array($idcontacto));
        if ($result->num_rows() != 0) {
            return array('error'  => EXIT_SUCCESS, 'result' => $result->result());
        } else {
            return array('error' => EXIT_ERROR);
        }
    }

    function responderContacto($idContacto, $username, $mensaje)
    {
        $resultado = $this->db->query('SELECT * FROM "MDB_CON"."CON_RESPONDERCONTACTO"(?,?,?)', array($idContacto, $username, $mensaje));
        if ($resultado->result()[0]->CON_RESPONDERCONTACTO == 'OK') {
            return array('error' => EXIT_SUCCESS);
        } else {
            return array(
                'error' => EXIT_ERROR,
                'msj' => 'No se pudo responder'
            );
        }
    }

    function guardarContacto($pat, $mat, $nom, $est, $msj, $asun, $tel, $fec)
    {
        $d = new DateTime( date('Y-m-d H:i') );
            

        //Generamos un condigo random para el caso
        $sql = 'SELECT "CON_RANDOMCONTACTO" 
        FROM "MDB_CON"."CON_RANDOMCONTACTO" ()';

        $result = $this->db->query($sql);
        $cod = $result->result()[0]->CON_RANDOMCONTACTO;

        //Generamos el array con los datos de la llamada
        $data_con = array(
            'IDTIPOCONTACTO' => 97,
            'TXTCODIGO'     => $cod,
            'IDESTADO'      => ESTADO_CONTACTO_PENDIENTE,
            'IDTIPO'        => CON_TIPO_CONTACTO,
            'TXTTELEFONO'   => $tel,
            'IDMEDIO'       => 108,
            'TXTAPEPATERNO' => $pat,
            'TXTAPEMATERNO' => $mat,
            'TXTNOMPERSONA' => $nom,
            'IDESTLLAMADA' => $est,
            'TXTMENSAJE' => $msj,
            'TXTASUNTO' => $asun,
            'DAREGISTRO' => $d->format("Y-m-d H:i")
        );

        $this->db->trans_start();
        $this->db->insert("MDB_CON.CON_CONTACTO", $data_con);
        $this->db->trans_complete();

        $insert_id = $this->db->insert_id();

        //Insertamos data de movimiento entre areas
        $data_mov = array('IDAREAINICIAL' => 2,
                          'IDCONTACTO'    => $insert_id
                    );
        $this->db->trans_start();
        $this->db->insert("MDB_CON.CON_CONTACTOMOVIMIENTO",$data_mov);
        $this->db->trans_complete();

        return array('error'  => EXIT_SUCCESS);
    }
}
