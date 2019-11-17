<?php

    function getAreas($idarea = NULL)
    {
        $ci =& get_instance();

        $ci->load->model('M_utils');
        $data = $ci->M_utils->getAreas($idarea);
        $html = "";
        foreach ($data['result'] as $datos) {
            $html.="<option value=".$datos->idarea.">".$datos->txtarea."</option>";
        }
        
        return $html;
    }

    function getYearsNormas()
    {
        $ci =& get_instance();

        $ci->load->model('M_utils');
        $data = $ci->M_utils->getYearsNormas();
        $html = "";
        if($data['error'] == EXIT_ERROR){
            return "";
        }
        foreach ($data['result'] as $datos) {
            $html.="<option value=".$datos->numanio.">".$datos->numanio."</option>";
        }
        return $html;
    }


    function getSedes()
    {
        $ci =& get_instance();

        $ci->load->model('M_utils');
        $data = $ci->M_utils->getSedes();
        $html = "";
        foreach ($data['result'] as $datos) {
            $html.="<option value=".$datos->IDSEDE.">".$datos->TXTSEDE."</option>";
        }
        
        return $html;
    }

    function getCategorias()
    {
        $ci =& get_instance();

        $ci->load->model('M_utils');
        $data = $ci->M_utils->getCategorias();
        $html = "";
        if($data['error'] == EXIT_ERROR){
            return $html;
        }
        foreach ($data['result'] as $datos) {
            $html.="<option value=".$datos->IDCATEGORIA.">".$datos->TXTDESCRIPCION."</option>";
        }
        
        return $html;
    }

    function getSubcategorias($categoria)
    {
        $ci =& get_instance();

        $ci->load->model('M_utils');
        $data = $ci->M_utils->getSubcategorias($categoria);
        $html = "";
        if($data['error'] == EXIT_ERROR){
            return $html;
        }
        foreach ($data['result'] as $datos) {
            $html.="<option value=".$datos->IDSUBCATEGORIA.">".$datos->TXTDESCRIPCION."</option>";
        }
        
        return $html;
    }
    
    function getMotivos(){
        $ci =& get_instance();

        $ci->load->model('M_utils');
        $data = $ci->M_utils->getMotivos();
        $html = "";
        foreach ($data['result'] as $datos) {
            $html.="<option value=".$datos->id_motivo.">".$datos->descripcion."</option>";
        }
        
        return $html;
    }

    function getComboByParametro($categoria,$id = null) {
        $ci =& get_instance();

        $ci->load->model('M_utils');
        $data = $ci->M_utils->getParametrosByCategoria($categoria);
        $html = "";
        foreach ($data['result'] as $datos) {
            if($id != $datos->IDPARAMETRO){
                $html.="<option value=".$datos->IDPARAMETRO.">".$datos->TXTPARAMETRO."</option>";
            }
        }
        
        return $html;
    }

    function getModulosDashboard($idrol, $idusuario) {
        $ci =& get_instance();

        $ci->load->model('M_utils');
        $data = $ci->M_utils->getModulos($idrol, $idusuario);
        $html["dash"] = "";
        $html["side"] = "";
        $cont = 0;

        if($data['error'] == EXIT_ERROR){
            return $html;
        }

        foreach ($data['result'] as $datos) {

            $html["dash"].='
                <div class="col-md-3" style="margin-bottom:36px;">
                    <div class="card mb-3 shadow-sm">
                        <img src="'.base_url().'public/utils/img/'.$datos->TXTURLIMAGEN.'" alt="" width="100%" height="225" class="img-responsive">
                        <div class="card-body">
                            <p class="card-text">'.$datos->TXTABREV.'</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick=\'window.open("'.base_url().$datos->TXTRUTA.'","_self")\'>Ingresar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }

        $html["dash"].= '<div style="clear:both"></div></div>';

        foreach ($data['result'] as $datos) {

            $htmlLI= '<ul class="collapse list-unstyled show" id="homeSubmenu'.++$cont.'">';
            
            foreach (json_decode($datos->JSON_PERMISOS) as $value) {
                
                $htmlLI.='
                        <li >
                            <a href="'.$value->TXTRUTA.'">'.$value->TXTPERMISO.'</a>
                        </li>
                ';
            }

            $htmlLI.='</ul>';

            $html["side"].='

                <li>
                    <a href="#homeSubmenu'.$cont.'" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle">'.$datos->TXTABREV.'</a>
                    
                        '.$htmlLI.'
                    
                </li>
            ';
        }
        
        return $html;
    }
    
    function getRoles()
    {
        $ci =& get_instance();

        $ci->load->model('M_utils');
        $data = $ci->M_utils->getRoles();
        $html = "";
        if($data['error'] == EXIT_ERROR){
            return $html;
        }
        foreach ($data['result'] as $datos) {
            $html.="<option value=".$datos->idrol.">".$datos->txtrol."</option>";
        }
        
        return $html;
    }
    
    function getAllModulos()
    {
        $ci =& get_instance();

        $ci->load->model('M_utils');
        $data = $ci->M_utils->getAllModulos();
        $html = "";
        if($data['error'] == EXIT_ERROR){
            return $html;
        }
        foreach ($data['result'] as $datos) {
            $html.="<option value=".$datos->idsistema.">".$datos->txtsistema."</option>";
        }
        
        return $html;
    }
    
    function getPermisosByModulo($idmodulo)
    {
        $ci =& get_instance();

        $ci->load->model('M_permisos');
        $data = $ci->M_permisos->getPermisosByModulo($idmodulo);
        $html = "";
        if($data['error'] == EXIT_ERROR){
            return $html;
        }
        foreach ($data['result'] as $datos) {
            $html.="<option value=".$datos->idpermiso.">".$datos->txtpermiso."</option>";
        }
        
        return $html;
    }

    function getRolesByPermiso($permiso){
        $ci =& get_instance();
        $ci->load->model('M_permisos');

        $data = $ci->M_permisos->getRolesByPermiso($permiso);
        $data["html"] = "";
        if ($data['error'] == EXIT_ERROR){
            $data['error'] = EXIT_SUCCESS;
            return $data;
        }
        $cont = 0;
        foreach($data['result'] as $dat){
            $cont++;
            $data["html"] .=
                "<tr>
                    <td>".$cont."</td>
                    <td attr='rol'>".$dat->txtrol."</td>
                    <td>
                        <div class='block_container'>
                            <div class='block' onclick='modalConfirmarQuitarRol(".$dat->idrol.")'><i class='far fa-trash-alt tooltip-test' title='Eliminar' style='color: black'></i>
                            </div>
                        </div>
                    </td>
                </tr>";
        }
        return $data;
    }
    