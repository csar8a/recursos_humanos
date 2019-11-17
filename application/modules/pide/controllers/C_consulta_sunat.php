<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_consulta_sunat extends MX_Controller
{

    public function __construct()
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
            'modulos_usuario_sb' => getModulosDashboard($idRol, $idUsuario)["side"],
            'bar' => 'Consulta de Datos',
        );
        $this->load->view('V_consulta_sunat', $data);
    }

    public function buscarSUNAT()
    {

        try {
            $ruc = $this->input->post('ruc') != null ? $this->input->post('ruc') : null;

            $soapclient = new SoapClient('https://ws3.pide.gob.pe/services/SunatConsultaRuc?wsdl');
            $param = array('numruc' => $ruc);
            $responseGDP = $soapclient->getDatosPrincipales($param);
            $responseGDS = $soapclient->getDatosSecundarios($param);
            $responseRL = $soapclient->getRepLegales($param);

            $esActivo = $responseGDP->getDatosPrincipalesReturn->esActivo;
            $esHabido = $responseGDP->getDatosPrincipalesReturn->esHabido;

            ($esActivo == 'true') ? $esActivo = 'Si' : $esActivo = 'No';
            ($esHabido == 'true') ? $esHabido = 'Si' : $esHabido = 'No';

            $data['html'] = '
            <div class="row">
                <div class="col-md-6">
                    <b><span style="color:#063f5d;">Nombre o raz&oacute;n social: </span></b><span>' . $responseGDP->getDatosPrincipalesReturn->ddp_nombre . '</span></span><br><br>
                    <b><span style="color:#063f5d;">RUC: </span></b><span>' . $responseGDP->getDatosPrincipalesReturn->ddp_numruc . '</span></span><br><br>
                    <b><span style="color:#063f5d;">Actividad econ&oacute;mica: </span></b><span>' . $responseGDP->getDatosPrincipalesReturn->desc_ciiu . '</span></span><br><br>
                    <b><span style="color:#063f5d;">Estado del contribuyente: </span></b><span>' . $responseGDP->getDatosPrincipalesReturn->desc_estado . '</span></span><br><br>
                    <b><span style="color:#063f5d;">Contribuyente: </span></b><span>' . $responseGDP->getDatosPrincipalesReturn->desc_tpoemp . '</span></span><br><br>

                    <b><span style="color:#063f5d;">Estado activo: </span></b><span>' . $esActivo . '</span></span><br><br>
                    <b><span style="color:#063f5d;">Estado habido: </span></b><span>' . $esHabido . '</span></span><br><br>

                    <b><span style="color:#063f5d;">Fecha y hora de actualizaci&oacute;n: </span></b><span>' . $responseGDP->getDatosPrincipalesReturn->ddp_fecact . '</span></span><br><br>
                    <b><span style="color:#063f5d;">Fecha de alta: </span></b><span>' . $responseGDP->getDatosPrincipalesReturn->ddp_fecalt . '</span></span><br><br>
                    <b><span style="color:#063f5d;">Fecha de baja: </span></b><span>' . $responseGDP->getDatosPrincipalesReturn->ddp_fecbaj . '</span></span><br><br>
                    <b><span style="color:#063f5d;">Libreta tributaria: </span></b><span>' . $responseGDP->getDatosPrincipalesReturn->ddp_lllttt . '</span></span><br><br>
                    <b><span style="color:#063f5d;">Tipo de persona: </span></b><span>' . $responseGDP->getDatosPrincipalesReturn->desc_identi . '</span></span><br><br>
                </div>
                <div class="col-md-6">
                    <h5>Ubicaci&oacute;n</h5><br><br>
                    <b><span style="color:#063f5d;">Departamento: </span></b><span>' . $responseGDP->getDatosPrincipalesReturn->desc_dep . '</span></span><br><br>
                    <b><span style="color:#063f5d;">Provincia: </span></b><span>' . $responseGDP->getDatosPrincipalesReturn->desc_prov . '</span></span><br><br>
                    <b><span style="color:#063f5d;">Distrito: </span></b><span>' . $responseGDP->getDatosPrincipalesReturn->desc_dist . '</span></span><br><br>
                    <b><span style="color:#063f5d;">Tipo de via: </span></b><span>' . $responseGDP->getDatosPrincipalesReturn->desc_tipvia . '</span></span><br><br>
                    <b><span style="color:#063f5d;">Via: </span></b><span>' . $responseGDP->getDatosPrincipalesReturn->ddp_nomvia . '</span></span><br><br>
                    <b><span style="color:#063f5d;">Numero: </span></b><span>' . $responseGDP->getDatosPrincipalesReturn->ddp_numer1 . '</span></span><br><br>
                    <b><span style="color:#063f5d;">Interior: </span></b><span>' . $responseGDP->getDatosPrincipalesReturn->ddp_inter1 . '</span></span><br><br>
                    <b><span style="color:#063f5d;">Tipo de zona: </span></b><span>' . $responseGDP->getDatosPrincipalesReturn->desc_tipzon . '</span></span><br><br>
                    <b><span style="color:#063f5d;">Zona: </span></b><span>' . $responseGDP->getDatosPrincipalesReturn->ddp_nomzon . '</span></span><br><br>
                    <b><span style="color:#063f5d;">Ref. de ubicacion: </span></b><span>' . $responseGDP->getDatosPrincipalesReturn->ddp_refer1 . '</span></span><br><br>
                    <b><span style="color:#063f5d;">Condicion de domicilio: </span></b><span>' . $responseGDP->getDatosPrincipalesReturn->desc_flag22 . '</span></span><br><br>
                    <b><span style="color:#063f5d;">Dependencia: </span></b><span>' . $responseGDP->getDatosPrincipalesReturn->desc_numreg . '</span></span><br><br>
                </div>
            </div>
            ';

            $data['html2'] = '
            <div class="row">
                <div class="col-md-6">
                
                    <b><span style="color:#063f5d;">Nombre comercial: </span></b><span>' . $responseGDS->getDatosSecundariosReturn->dds_nomcom . '</span></span><br><br>
                    <b><span style="color:#063f5d;">Número de RUC: </span></b><span>' . $responseGDS->getDatosSecundariosReturn->dds_numruc . '</span></span><br><br>
                    <b><span style="color:#063f5d;">Nacionalidad: </span></b><span>' . $responseGDS->getDatosSecundariosReturn->dds_nacion . '</span></span><br><br>
                    <b><span style="color:#063f5d;">Origen de la entidad: </span></b><span>' . $responseGDS->getDatosSecundariosReturn->desc_orient . '</span></span><br><br>
                    <b><span style="color:#063f5d;">Fecha de constitución: </span></b><span>' . $responseGDS->getDatosSecundariosReturn->dds_consti . '</span></span><br><br>
                    <b><span style="color:#063f5d;">Fecha de inicio de actividades: </span></b><span>' . $responseGDS->getDatosSecundariosReturn->dds_inicio . '</span></span><br><br>
                    <b><span style="color:#063f5d;">Número de licencia municipal: </span></b><span>' . $responseGDS->getDatosSecundariosReturn->dds_licenc . '</span></span><br><br>
                    <b><span style="color:#063f5d;">Calificación de la conducta del contribuyente: </span></b><span>' . $responseGDS->getDatosSecundariosReturn->dds_califi . '</span></span><br><br>
                    <b><span style="color:#063f5d;">Descripción de comercio exterior: </span></b><span>' . $responseGDS->getDatosSecundariosReturn->desc_comext . '</span></span><br><br>
                    <b><span style="color:#063f5d;">Tipo de contabilidad: </span></b><span>' . $responseGDS->getDatosSecundariosReturn->desc_contab . '</span></span><br><br>
                    <b><span style="color:#063f5d;">Tipo de documento de identidad: </span></b><span>' . $responseGDS->getDatosSecundariosReturn->desc_docide . '</span></span><br><br>
                    <b><span style="color:#063f5d;">Num. de documento de identidad: </span></b><span>' . $responseGDS->getDatosSecundariosReturn->dds_nrodoc . '</span></span><br><br>
                    <b><span style="color:#063f5d;">Condición de domiciliado: </span></b><span>' . $responseGDS->getDatosSecundariosReturn->desc_domici . '</span></span><br><br>
                    <b><span style="color:#063f5d;">Fecha de nacimiento: </span></b><span>' . $responseGDS->getDatosSecundariosReturn->dds_fecnac . '</span></span><br><br>
                </div>
                <div class="col-md-6">
                    <b><span style="color:#063f5d;">Tipo de facturación: </span></b><span>' . $responseGDS->getDatosSecundariosReturn->desc_factur . '</span></span><br><br>
                        
                    <b><span style="color:#063f5d;">Numero de asiento inscripción RRPP: </span></b><span>' . $responseGDS->getDatosSecundariosReturn->dds_asient . '</span></span><br><br>
                    <b><span style="color:#063f5d;">Tomo o ficha de RRPP: </span></b><span>' . $responseGDS->getDatosSecundariosReturn->dds_ficha . '</span></span><br><br>
                    <b><span style="color:#063f5d;">Numero de folios en RRPP: </span></b><span>' . $responseGDS->getDatosSecundariosReturn->dds_nfolio . '</span></span><br><br>
                    
                    <b><span style="color:#063f5d;">País que emitió el pasaporte: </span></b><span>' . $responseGDS->getDatosSecundariosReturn->dds_paispa . '</span></span><br><br>
                    <b><span style="color:#063f5d;">Número de pasaporte: </span></b><span>' . $responseGDS->getDatosSecundariosReturn->dds_pasapo . '</span></span><br><br>
                    <b><span style="color:#063f5d;">Carnet patronal: </span></b><span>' . $responseGDS->getDatosSecundariosReturn->dds_patron . '</span></span><br><br>
                    <b><span style="color:#063f5d;">Sexo: </span></b><span>' . $responseGDS->getDatosSecundariosReturn->desc_sexo . '</span></span><br><br>
                    <b><span style="color:#063f5d;">Número de teléfono #1: </span></b><span>' . $responseGDS->getDatosSecundariosReturn->dds_telef1 . '</span></span><br><br>
                    <b><span style="color:#063f5d;">Número de teléfono #2: </span></b><span>' . $responseGDS->getDatosSecundariosReturn->dds_telef2 . '</span></span><br><br>
                    <b><span style="color:#063f5d;">Número de teléfono #3: </span></b><span>' . $responseGDS->getDatosSecundariosReturn->dds_telef3 . '</span></span><br><br>
                    <b><span style="color:#063f5d;">Fax: </span></b><span>' . $responseGDS->getDatosSecundariosReturn->dds_numfax . '</span></span><br><br>
                </div>
            </div>
            ';

            $data['html3'] = '
            <div class="row">
                <div class="col-md-12">

                    <b><span style="color:#063f5d;">Nombre del representante: </span></b><span>' . $responseRL->getRepLegalesReturn->rso_nombre . '</span></span><br><br>
                    <b><span style="color:#063f5d;">Número de RUC: </span></b><span>' . $responseRL->getRepLegalesReturn->rso_numruc . '</span></span><br><br>
                    <b><span style="color:#063f5d;">Cargo: </span></b><span>' . $responseRL->getRepLegalesReturn->rso_cargoo . '</span></span><br><br>
                    <b><span style="color:#063f5d;">Fecha desde la que ocupa el cargo: </span></b><span>' . $responseRL->getRepLegalesReturn->rso_vdesde . '</span></span><br><br>
                    <b><span style="color:#063f5d;">Descripción de documento : </span></b><span>' . $responseRL->getRepLegalesReturn->desc_docide . '</span></span><br><br>
                    <b><span style="color:#063f5d;">Número de documento: </span></b><span>' . $responseRL->getRepLegalesReturn->rso_nrodoc . '</span></span><br><br>
                    <b><span style="color:#063f5d;">Fecha y hora de actualización: </span></b><span>' . $responseRL->getRepLegalesReturn->rso_fecact . '</span></span><br><br>
                    <b><span style="color:#063f5d;">Fecha de nacimiento: </span></b><span>' . $responseRL->getRepLegalesReturn->rso_fecnac . '</span></span><br><br>
                    
                </div>
            </div>
            ';

            $data['error'] = EXIT_SUCCESS;
            echo json_encode($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
