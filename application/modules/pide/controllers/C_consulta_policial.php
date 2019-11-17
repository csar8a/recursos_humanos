<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_consulta_policial extends MX_Controller {
    
    function __construct()
    {
        parent::__construct();
        $this->load->helper('utils');
        $sesionU = $this->session->userdata('s_nombreUsuario');
        if (empty($sesionU)) {
            redirect('login');
        }
    }

	public function index()
	{
        $idRol = $this->session->userdata('s_roles');
        $idUsuario = $this->session->userdata('s_idUsuario');
        $data = array(
            
            'modulos_usuario_sb' => getModulosDashboard($idRol,$idUsuario)["side"]
        );
        $this->load->view('V_consulta_policial',$data);
    }

    public function buscarPersona()
    {
        try {         
        $dni =  $this->input->post('dni')!= null ? $this->input->post('dni') : null;
        $context  = stream_context_create(array('https' => array('header' => 'Accept: application/xml')));
	    $url = 'https://ws3.pide.gob.pe/Rest/Pnp/APolicialPersonaNroDoc?clienteUsuario=MUDIBE&clienteClave=MUD1B3&servicioCodigo=WS_PIDE_ANTECEDENTES_FLAG&clienteSistema=SISTEMAENTIDAD&clienteIp=1.1.1.1&clienteMac=AA:BB:CC:DD:EE:FF&tipoDocUserClieFin=2&nroDocUserClieFin='.$dni.'&nroDoc='.$dni.'';
        $xml = file_get_contents($url, false, $context);
        $doc = new DOMDocument(); 
        $doc->loadXML($xml);

        $condicion= $doc->getElementsByTagName('codigoMensaje')->item(0)->nodeValue;
            $data['html']='
                <div class="row">
                <div class="col-md-8 text-nowrap">';
            if ($condicion =='00') {

                $data['html'] .= 

                '
                    <b><span style="color:#063f5d;">DNI BUSCADO:</span></b><span style="text-transform: capitalize">' .$dni.'</span></span><br><br>
                    <b><span style="color:#063f5d">Nombre Completo: </span></b><span style="text-transform: capitalize">' .$doc->getElementsByTagName('nombrecompleto')->item(0)->nodeValue.'</span><br><br>
                    <b><span style="color:#063f5d">Apellido Paterno: </span></b><span style="text-transform: capitalize">' .$doc->getElementsByTagName('apellidoPaterno')->item(0)->nodeValue. '</span><br><br>
                    <b><span style="color:#063f5d">Apellido Materno: </span></b><span style="text-transform: capitalize">' .$doc->getElementsByTagName('apellidoMaterno')->item(0)->nodeValue. '</span><br><br>
                    <b><span style="color:#063f5d">Nombres: </span></b><span style="text-transform: capitalize">' .$doc->getElementsByTagName('nombres')->item(0)->nodeValue. '</span><br><br>
                    <b><span style="color:#063f5d">C&oacute;digo Persona: </span></b><span style="text-transform: capitalize">' .$doc->getElementsByTagName('codigoPersona')->item(0)->nodeValue. '</span><br><br>
                    <b><span style="color:#063f5d">Homonimia: </span></b><span style="text-transform: capitalize">' .$doc->getElementsByTagName('homonimia')->item(0)->nodeValue. '</span><br><br>
                    <b><span style="color:#063f5d">Lugar de Nacimiento: </span></b><span style="text-transform: capitalize">' .$doc->getElementsByTagName('lugarNacimiento')->item(0)->nodeValue. '</span><br><br>
                    <b><span style="color:#063f5d">Fecha de Nacimiento: </span></b><span style="text-transform: capitalize">' .$doc->getElementsByTagName('fechaNacimiento')->item(0)->nodeValue. '</span><br><br>
                    <b><span style="color:#063f5d">Nombre Padre: </span></b><span style="text-transform: capitalize">' .$doc->getElementsByTagName('nombrePadre')->item(0)->nodeValue. '</span><br><br>
                    <b><span style="color:#063f5d">Nombre Madre: </span></b><span style="text-transform: capitalize">' .$doc->getElementsByTagName('nombreMadre')->item(0)->nodeValue. '</span><br><br>
                    <b><span style="color:#063f5d">Tipo de Documento: </span></b><span style="text-transform: capitalize">' .$doc->getElementsByTagName('tipoDocumento')->item(0)->nodeValue. '</span><br><br>
                    <b><span style="color:#063f5d">Número Documento: </span></b><span style="text-transform: capitalize">' .$doc->getElementsByTagName('nroDocumento')->item(0)->nodeValue. '</span><br><br>
                    <b><span style="color:#063f5d">Sexo: </span></b><span style="text-transform: capitalize">' .$doc->getElementsByTagName('sexo')->item(0)->nodeValue.'</span><br><br>';
                    
                    if($doc->getElementsByTagName('talla')->item(0)->nodeValue = 'NULL'){
                        $data['html'] .='<b><span style="color:#063f5d">Talla: </span></b><span style="text-transform: capitalize">'.'--'.'</span><br><br>';
                        
                    } else{
                        $data['html'] .='<b><span style="color:#063f5d">Talla: </span></b><span style="text-transform: capitalize">'.$doc->getElementsByTagName('talla')->item(0)->nodeValue.'</span><br><br>';
                    }
    
                    if ($doc->getElementsByTagName('contextura')->item(0)->nodeValue = 'NULL'){
                        $data['html'] .='<b><span style="color:#063f5d">Contextura: </span></b><span style="text-transform: capitalize">'.'--'.'</span><br><br>';
                    } else{
                        $data['html'] .='<b><span style="color:#063f5d">Contextura: </span></b><span style="text-transform: capitalize">'.$doc->getElementsByTagName('contextura')->item(0)->nodeValue.'</span><br><br>';
                        
                    }
                        $data['html'] .='<b><span style="color:#063f5d">Descripción: </span></b><span style="text-transform: capitalize">'.$doc->getElementsByTagName('descripcionMensaje')->item(0)->nodeValue.'</span><br><br>';
                        
			}elseif ($condicion !="00") {
    
                    $data['html'] .= 
                    '
                    <div class="row">
                    <div class="col-md-8 text-nowrap">
                    <h2 align="center" style="color:#black"> Datos Personales</h2>
                    <b><span style="color:#063f5d">DNI Buscado: </span></b><span style="text-transform: capitalize">' .$dni. '</span><br><br>
                    <b><span style="color:#063f5d">Descripci&oacute;n: </span></b><span style="text-transform: capitalize">' .$doc->getElementsByTagName('descripcionMensaje')->item(0)->nodeValue. '</span><br><br>';
                    
                    

			}
			$data['html'] .='</div>  </div>';        
            $data['error'] = EXIT_SUCCESS;
            echo json_encode($data);
                
               
                }
                catch (\Throwable $th) {
                throw $th;
            }
    }
}
