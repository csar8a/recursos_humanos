<?php 
//(defined('BASEPATH')) OR exit('No direct script access allowed');

class Prueba extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        log_message('error','Hello World');
    }
}