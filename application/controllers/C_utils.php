<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_utils extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_utils');
    }

    public function buscarPersona()
    {
        $data['error'] = EXIT_ERROR;
        try
        {
            $tipodoc  =  $this->input->post('tipodoc');
            $doc      =  $this->input->post('doc');

            $data = $this->M_utils->getDatosPersona($tipodoc,$doc);
            echo json_encode($data);

        } catch (\Throwable $th) {throw $th;}
    }

    
}