<?php
defined('BASEPATH') or exit('No direct script access allowed');
$GLOBALS['codigo_tarjeta'] = "";
$GLOBALS['nombre_tarjeta'] = "";
$GLOBALS['dni_tarjeta'] = "";
$GLOBALS['fechafin_tarjeta'] = "";

class C_tarjeta extends MX_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_admin_casa_juventud');
        $this->load->library('Ciqrcode');
        $this->buscarFicha();
        $params['data'] = $GLOBALS['nombre_tarjeta']." ".$GLOBALS['dni_tarjeta'];
        $params['level'] = 'H';
        $params['size'] = 2;
        $params['savename'] = FCPATH . 'public/casa_juventud/img/tes.png';
        $this->ciqrcode->generate($params);
        
       // echo '<img src="' . base_url() . 'public/casa_juventud/img/tes.png" />';
    }

    public function index()
    {
        $data = array(
            'qr'   => '<img src="' . base_url() . 'public/casa_juventud/img/tes.png" />',
            'tarjeta' => $GLOBALS['codigo_tarjeta'],
            'nombre' => strtoupper($GLOBALS['nombre_tarjeta']),
            'dni' => $GLOBALS['dni_tarjeta'],
            'fechafin' => $GLOBALS['fechafin_tarjeta']
        );
        $this->load->view('casa_juventud/V_tarjeta',$data);
    }

    public function buscarFicha()
    {
         
       $data['error'] = EXIT_ERROR;
        try {
            $ficha  =  $_GET['id'];
            $nombre = "";
            $code = "";
            $dni = "";
            $fecha = "";

            $data = $this->M_admin_casa_juventud->getCarnetFicha($ficha);
            //log_message('error',print_r($data,true));

            if ($data['error'] == EXIT_ERROR){
                echo json_encode($data);
                return;
            }      
            foreach($data['result'] as $dat){
                $nombre = $dat->nombre;
                $code =  $dat->txtcodigo;
                $dni = $dat->dni;
                $fecha = $dat->dainscripcion;
            }

            //Formateando codigo a cada 4 digitos
            $codenuevo = "";
            $cont = 0;
            for($i = 0; $i < strlen($code); $i++) {
                if($cont == 4){
                    $codenuevo .= "-";
                    $cont = 0;
                } 
                $codenuevo .= $code[$i];
                $cont++;
            }

            //Variables en carnet
            $GLOBALS['codigo_tarjeta'] = $codenuevo;
            $GLOBALS['nombre_tarjeta'] = $nombre;
            $GLOBALS['dni_tarjeta'] = $dni;
            $GLOBALS['fechafin_tarjeta'] = $fecha;
        }
        catch (\Throwable $th) {
            throw $th;
        }
    }

}
