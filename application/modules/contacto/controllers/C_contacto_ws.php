<?php 
//(defined('BASEPATH')) OR exit('No direct script access allowed');

class C_contacto_ws extends MX_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_contacto_ws');
        $this->load->helper('utils');
    }
    
    public function index()
    {   
        //log_message('error', print_r('INDEX',true));
        //$view_ws = $this->load->view('contacto/V_contacto_ws', '', TRUE);
        
        $data['llamada'] = $_GET['id'];
        //log_message('error', print_r($data['llamada'],true));
        $this->load->view('contacto/V_contacto_ws', $data);
        
    }

    function addContacto(){ //log_message('error', print_r('addContacto',true));
        $t = microtime(true);
        $micro = sprintf("%06d",($t - floor($t)) * 1000000);
        $d = new DateTime( date('Y-m-d H:i:s.'.$micro, $t) );

        //print $d->format("Y-m-d H:i:s.u"); // note at point on "u"
        /*
        log_message('error', print_r(date("Y-m-d H:i:s.u"),true));
        */
        
        //log_message('error', print_r($d->format("Y-m-d H:i:s").' fecha php',true));
        
        $llamada = $this->input->post('llamada');
        //log_message('error', print_r($llamada,true));
        $datos = $this->M_contacto_ws->contacto_ws($d->format("Y-m-d H:i:s.u"),$llamada);
        
        //log_message('error', print_r($data,true));
        $arrayjson[] = array(
            'tipo'          => 1,//tipo de actualizacion
            'mensaje'       => "hola",//mensaje
            'fecha'         => $d->format("d/m/Y H:i"),//fecha de envio
            'actualizacion' => '1',
            'telefono'      => $llamada,
            'id'            => $datos['id'],
            'fec_send'      => '1'.$d->format("dmY"),
            'time_send'     => '1'.$d->format("Hi"),
            'codigo'        => $datos['cod']
        );
        //log_message('error', print_r($arrayjson,true));
        echo json_encode($arrayjson);
    }
}
