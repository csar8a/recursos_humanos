<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_ficha_casa_juventud extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        /*$this->load->model('M_acceso_info');
        $this->load->helper('utils');
        $this->load->libraries(['Utilities']);*/
        $this->load->model('M_utils');
        $this->load->helper('utils');
        $this->load->model('M_ficha_casa_juventud');
    }

    public function index()
    {
        $data = array(
            'combo_tipodoc'   => getComboByParametro('TIPODOC', 4),
            'combo_distritos' => getComboByParametro('DISTRITO'),
            'combo_estado_civil' => getComboByParametro('ESTADO_CIVIL')
        );
        $this->load->view('casa_juventud/V_ficha_casa_juventud', $data);
    }

    public function insertarFicha()
    {
        $data['error'] = EXIT_ERROR;
        try {
            $fechaInscripcion     = trim($this->input->post('fechaInscripcion'));
            $codigo = trim($this->input->post('codigo'));
            $responsable = trim($this->input->post('responsable'));
            $emergencia    = $this->input->post('emergencia');


            $numDocumentoJoven         = trim($this->input->post('numDocumentoJoven'));
            $apPaternoJoven      = trim($this->input->post('apPaternoJoven'));
            $apMaternoJoven      = trim($this->input->post('apMaternoJoven'));
            $nombresJoven      = trim($this->input->post('nombresJoven'));
            $telefonoJoven      = trim($this->input->post('telefonoJoven'));
            $celularJoven      = trim($this->input->post('celularJoven'));
            $correoJoven      = trim($this->input->post('correoJoven'));
            $gradoInstruccionJoven      = trim($this->input->post('gradoInstruccionJoven'));
            $ocupacionJoven      = trim($this->input->post('ocupacionJoven'));
            $centroEstudiosTrabajoJoven      = trim($this->input->post('centroEstudiosTrabajoJoven'));
            $tipo_docJoven      = trim($this->input->post('tipo_docJoven'));
            $estadoCivilJoven      = $this->input->post('estadoCivilJoven') != null ? trim($this->input->post('estadoCivilJoven')) : null;
            $fechaNacJoven      = trim($this->input->post('fechaNacJoven'));
            $sexoJoven      = trim($this->input->post('sexoJoven'));



            $distrito     = $this->input->post('distrito');
            $viaPublica   = trim($this->input->post('viaPublica'));
            $urbanizacion = trim($this->input->post('urbanizacion'));
            $numero       = trim($this->input->post('numero'));
            $interior     = trim($this->input->post('interior'));
            $manzana      = trim($this->input->post('manzana'));
            $lote         = trim($this->input->post('lote'));

            $numDocumentoApoderado         = trim($this->input->post('numDocumentoApoderado'));
            $apPaternoApoderado         = trim($this->input->post('apPaternoApoderado'));
            $apMaternoApoderado         = trim($this->input->post('apMaternoApoderado'));
            $nombresApoderado         = trim($this->input->post('nombresApoderado'));
            $telefonoApoderado         = trim($this->input->post('telefonoApoderado'));
            $celularApoderado         = trim($this->input->post('celularApoderado'));
            $correoApoderado         = trim($this->input->post('correoApoderado'));
            $gradoInstruccionApoderado         = trim($this->input->post('gradoInstruccionApoderado'));
            $ocupacionApoderado         = trim($this->input->post('ocupacionApoderado'));
            $tipo_docApoderado         = trim($this->input->post('tipo_docApoderado'));
            $estadoCivilApoderado         = $this->input->post('estadoCivilApoderado') != null ? trim($this->input->post('estadoCivilApoderado')) : null;
            $fechaNacApoderado         = trim($this->input->post('fechaNacApoderado'));
            $sexoApoderado         = trim($this->input->post('sexoApoderado'));




            $ip           = trim($this->input->ip_address());



            $datos_joven = array(
                'TIPODOCUMENTO'    => intval($tipo_docJoven),
                'TXTDOCUMENTO'     => $numDocumentoJoven,
                'TXTNOMPERSONA'    => $nombresJoven,
                'TXTAPEPATERNO'    => $apPaternoJoven,
                'TXTAPEMATERNO'    => $apMaternoJoven,
                'TXTTELEFONO'      => $telefonoJoven,
                'TXTTCELULAR'      => $celularJoven,
                'TXTCORREO'        => $correoJoven,
                'TXTGRADO'        => $gradoInstruccionJoven,
                'TXTOCUPACION'        => $ocupacionJoven,
                'TXTCENTRO'        => $centroEstudiosTrabajoJoven,
                'TXTESTADOCIVIL'        => $estadoCivilJoven,
                'TXTFECHANAC'        => $fechaNacJoven,
                'TXTSEXO'        => $sexoJoven,
                'IDDISTRITO'       => intval($distrito),
                'TXTVIAPUBLICA'    => $viaPublica,
                'TXTURBANIZACION'  => $urbanizacion,
                'TXTNUMERO'        => $numero,
                'TXTINTERIOR'      => $interior,
                'TXTMANZANA'       => $manzana,
                'TXTLOTE'          => $lote
            );


            if (strlen($numDocumentoApoderado!=0)) {
                $datos_apoderado = array(
                    'TIPODOCUMENTOA'    => intval($tipo_docApoderado),
                    'TXTDOCUMENTOA'     => $numDocumentoApoderado,
                    'TXTNOMPERSONAA'    => $nombresApoderado,
                    'TXTAPEPATERNOA'    => $apPaternoApoderado,
                    'TXTAPEMATERNOA'    => $apMaternoApoderado,
                    'TXTTELEFONOA'      => $telefonoApoderado,
                    'TXTTCELULARA'      => $celularApoderado,
                    'TXTCORREOA'        => $correoApoderado,
                    'TXTGRADOA'        => $gradoInstruccionApoderado,
                    'TXTOCUPACIONA'        => $ocupacionApoderado,
                    'TXTESTADOCIVILA'        => $estadoCivilApoderado,
                    'TXTFECHANACA'        => $fechaNacApoderado,
                    'TXTSEXOA'        => $sexoApoderado

                );
            } else {
                $datos_apoderado = "0";
            }

           // log_message('error', print_r($datos_joven, true));
            $data = $this->M_ficha_casa_juventud->insertarFicha($datos_joven, $datos_apoderado);
            //log_message('error', print_r($data, true));

            if ($data['error'] != EXIT_ERROR) {
                $codigojoven =  $data['codigo1'];
                $codigoapoderado =  $data['codigo2'];

                if ($codigoapoderado == "0") {
                    $codigoapoderado = NULL;
                }

                $datos_ficha = array(
                    'TXTCODIGOFICHA'    => $codigo,
                    'TXTRESPONSABLE'    => $responsable,
                    'TXTEMERGENCIA'    => $emergencia,
                    'IDJOVEN'    => $codigojoven,
                    'IDAPODERADO'    => $codigoapoderado,

                );
                $data = $this->M_ficha_casa_juventud->insertarFichaFinal($datos_ficha);
            }



            

            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
