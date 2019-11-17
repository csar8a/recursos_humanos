<?php

class M_contacto_call extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    function guardarContacto($id, $pat, $mat, $nom, $est, $msj, $asun) {
        $sql = 'UPDATE "MDB_CON"."CON_CONTACTO"
                   SET "TXTNOMPERSONA"  = ?, "TXTAPEPATERNO" = ?, 
                        "TXTAPEMATERNO" = ?, "TXTMENSAJE"    = ?, 
                        "TXTASUNTO" = ?, "IDESTLLAMADA" = ?
                 WHERE "IDCONTACTO" = ?';
        $result = $this->db->query($sql,array($nom,$pat, $mat,$msj,$asun,$est,$id));
        return array('error'  => EXIT_SUCCESS);
    }
}
