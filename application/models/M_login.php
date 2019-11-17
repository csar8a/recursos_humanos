<?php

class M_login extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function login($datos_login) {

        $sql = 'SELECT * FROM "MDB_SEG"."SEG_LOGIN"(?,?) ';

        $resultado = $this->db->query($sql,$datos_login);
              
        if($resultado->num_rows() == 1)
        {   
            $r = $resultado->row();

            $s_usuario = array(
                's_idUsuario' => $r->idusuario,
                's_nombreUsuario' => $r->txtusername,
                's_nombrePersona' => $r->txtnompersona,
                's_roles' => $r->idrol,
                's_area' => $r->idareaactual
            );

            $this->session->set_userdata($s_usuario);

            $datos_acceso = array(
                'ip' => $this->input->ip_address(),
                'user' => $this->session->userdata('s_nombreUsuario'),
                'modulo' => FLG_ACCESO_MODULO_MANTENIMIENTO
            );

            

            $this->guardarAcceso($datos_acceso);

            return array('error'=> EXIT_SUCCESS);

        } else { return array('error'=> EXIT_ERROR);}
    }

    function guardarAcceso($datos_acceso) {
        $resultado = $this->db->query('SELECT * FROM "MDB_SEG"."SEG_GUARDARACCESO"(?,?,?)',$datos_acceso);
        if($resultado->result()[0]->SEG_GUARDARACCESO == 'OK'){
            return array('error'=> EXIT_SUCCESS);
        } else {
            return array('error'=> EXIT_ERROR);
        }
    }

    
}