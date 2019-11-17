<?php

class M_admin_sav extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    function getDatosSAV() {
        $sql = 'SELECT initcap(p."TXTNOMPERSONA" || \' \' || p."TXTAPEPATERNO" || \' \' || p."TXTAPEMATERNO")  AS "NOMBRECOMPLETO",
                       s."IDPERSONA",
                       (SELECT "TXTPARAMETRO"
                          FROM "MDB_GRAL"."GRAL_PARAMETROS" pa
                         WHERE pa."FLGCATEGORIA" = \'MEDIO\'
                           AND pa."TXTVALOR" = s."IDMEDIO"::text
                           AND pa."FLGACTI" = \'1\') AS "TXTMEDIO",
                       "TXTTEMA",
                       "TXTDESCRIPCION",
                       (SELECT c."TXTDESCRIPCION"
                          FROM "MDB_SAV"."SAV_CATEGORIA" c
                         WHERE c."IDCATEGORIA" = s."IDCATEGORIA") AS "TXTCATEGORIA",
                       (SELECT c."TXTDESCRIPCION"
                          FROM "MDB_SAV"."SAV_SUBCATEGORIA" c
                         WHERE c."IDSUBCATEGORIA" = s."IDSUBCATEGORIA") AS "TXTSUBCATEGORIA",
                       to_char(s."DAREGISTRO", \'DD/MM/YYYY\') AS "DAREGISTRO"
                  FROM "MDB_SAV"."SAV_CASO" s,
                       "MDB_GRAL"."GRAL_PERSONA" p
                 WHERE s."IDPERSONA" = p."IDPERSONA"';

        $result = $this->db->query($sql);
        if($result->num_rows() != 0) {
            return array('error'  => EXIT_SUCCESS, 
                        'result' => $result->result());
        } else {
            return array('error'=> EXIT_ERROR);
        }
    }
}