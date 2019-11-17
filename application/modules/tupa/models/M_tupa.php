<?php

class M_tupa extends CI_Model
{

	function __construct()
	{
		parent ::__construct();

	}

	function guardarInforme($datos)
	{
     $this->db->insert('informe',$datos);

	}


}