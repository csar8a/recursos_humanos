<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Modulos - Casa de la Juventud</title>

    <link rel="stylesheet" href="<?php echo base_url();?>public/utils/css/bootstrap.min.css" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/utils/css/style2.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/utils/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/utils/css/jquery.timepicker.min.css">

    <!-- Scrollbar Custom CSS -->
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

    <!-- Font Awesome JS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/utils/css/fontawesome/all.min.css">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/utils/css/bootstrap-datepicker.css">
    
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <?php echo $this->load->view('sidebar')?>
        <div id="content">
            <!-- HEADER  -->
            <?php echo $this->load->view('header') ?>
            <div class="container" style="padding: 20px 0 20px 0">
                <h4 style="margin-bottom: 20px">Administrar - Casa de la Juventud</h4>

                <h6>Registra una nueva ficha has click <a href="<?php echo base_url(); ?>ficha_casa_juventud"
                        rel="noopener noreferrer" style="color:#2699ce">aquí</a>.</h6>

                <div class="row" style="margin-top: 50px">

                    <div class="col-3">
                        <div class="form-group">
                            <label for="documento">Documento de Identidad</label>
                            <input type="form-control" class="form-control vecino" id="codigo" name="codigo"
                                placeholder="Ingrese c&oacute;digo">
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input class="form-control" id="nombre" name="nombre" aria-describedby="searching"
                                placeholder="Nombre Persona">
                            <small id="searching" style="display: none;"
                                class="form-text text-muted">Buscando...</small>
                        </div>
                    </div>

                    <div class="col-2">
                        <div class="form-group">
                            <label for="btnBuscar" style="opacity: 0;">Búsqueda</label>
                            <button id="btnBuscar" onclick="buscarFicha()" type="button"
                                class="btn btn-primary form-control"
                                style="width: inherit; display: block;">Buscar</button>
                        </div>
                    </div>
                </div>

                <div class="row">
                     <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Codigo</th>
                                    <th>Fecha de inscripcion</th>
                                    <th>Nombre</th>
                                    <th>Familiares</th>
                                    <th>Foto</th>
                                    <th>Visualizar</th>
                                    <th>Editar</th>
                                    <th>Carnet</th>
                                </tr>
                            </thead>
                            <tbody id="body_eventos">

                            </tbody>
                        </table>
                </div>


                       

            </div>
        </div>
    </div>
    <div class="modal" id="modal_foto_principal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Foto - Persona</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div id="body_fotop" class="table-responsive"></div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        Modificar Imagen :
                        <input type="file" id="imagenprincipal" name="fileImagen" class="custom-file" accept="image/*">
                        </tr>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <button id="editArchivo" onclick="editArchivo()" type="button"
                            class="btn btn-primary form-control" style="width: inherit; display: block;">Cambiar
                            Foto</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="modalEditDoc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar - Datos Joven</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <input style="display:none" class="form-control vecino" id="idnorma2" placeholder="Ingrese titulo">
                <input style="display:none" class="form-control vecino" id="JovenID" placeholder="Ingrese titulo">
                <input style="display:none" class="form-control vecino" id="ApoderadoID" placeholder="Ingrese titulo">
                
                <div class="modal-body">
                    <div class="row">
                         <div class="col-sm-2">
                            <div class="form-group">
                                <label for="tipo">Tipo:</label>
                                <select class="form-control" id="selectTipoDoc" readonly>
                                    <option value=""  >Seleccione un tipo de documento</option>
                                    <?php echo $combo_tipodoc?>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="documentoID">Documento:</label>
                                <input type="text" id="documentoID" class="form-control"  readonly >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group" id="fechanacjov-container">
                                <label for="FechaNacimientoID">F.Nacimiento:</label>
                                <input id="FechaNacimientoID" type="text" class="form-control"  placeholder="Selecciona la fecha">
                            </div>
                        </div>
                    </div>   
                    <div class="row"> 
                        <div class='col-sm-4'>
                                <div class="form-group">
                                    <label for="nombresID">Nombres:</label>
                                    <input type="text" id="nombresID" maxlength="30"class="form-control">
                                </div>
                        </div>
                    
                        <div class='col-sm-4'>
                                <div class="form-group">
                                    <label for="paternoID">A.Paterno:</label>
                                    <input type="text" id="paternoID" maxlength="20" class="form-control">
                                </div>
                        </div>
                        <div class='col-sm-4'>
                                <div class="form-group">
                                    <label for="maternoID">A.Materno:</label>
                                    <input type="text" id="maternoID" maxlength="20" class="form-control">
                                </div>
                        </div>
                    </div>
                    <div class="row"> 
                        <div class='col-sm-2'>
                                <div class="form-group">
                                    <label for="telefonoID">Telefono:</label>
                                    <input type="text" id="telefonoID" maxlength="12" class="form-control">
                                </div>
                        </div>
                        <div class='col-sm-2'>
                                <div class="form-group">
                                    <label for="celularID">Celular:</label>
                                    <input type="text" id="celularID" maxlength="12"class="form-control">
                                </div>
                        </div>
                        <div class='col-sm-4'>
                                <div class="form-group">
                                    <label for="correoID">Correo:</label>
                                    <input type="text" id="correoID" maxlength="100" class="form-control">
                                </div>
                        </div>
                    </div> 
                    <div class="row">         
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="selectEstadoCivil">Estado civil</label>
                                <select class="form-control" id="selectEstadoCivil">
                                    <option value="">Seleccione un tipo</option>
                                    <?php echo $combo_estado_civil?>
                                </select>
                            </div>
                        </div>
                        <div class='col-sm-6'>
                                <div class="form-group">
                                    <label for="gradoInstruccionID">Grado de Instruccion:</label>
                                    <input type="text" id="gradoInstruccionID" maxlength="50" class="form-control">
                                </div>
                        </div>
                    </div>        
                    <div class="row">      
                        <div class='col-sm-6'>
                                <div class="form-group">
                                    <label for="ocupacionID">Ocupación:</label>
                                    <input type="text" id="ocupacionID" maxlength="150" class="form-control">
                                </div>
                        </div>
                        <div class='col-sm-6'>
                                <div class="form-group">
                                    <label for="centroEstudioID">Centro de Estudio:</label>
                                    <input type="text" id="centroEstudioID" maxlength="30" class="form-control">
                                </div>
                        </div>
                    </div>
                    
                <div class="modal-header">
                    <h5 class="modal-title">Dirección - Datos Joven</h5>
                </div>
                <div class="row"> 
                    <div class="col-md-4">
                            <div class="form-group">
                                <label for="selectDistrito">Distrito</label>
                                <select class="form-control" id="selectDistrito">
                                    <option value="" selected>Seleccione distrito</option>
                                    <?php echo $combo_distritos?>
                                </select>
                            </div>
                    </div>
                    <div class='col-sm-3'>
                                <div class="form-group">
                                    <label for="viaID">Via:</label>
                                    <input type="text" id="viaID" maxlength="45" class="form-control">
                                </div>
                    </div>
                    <div class='col-sm-3'>
                                <div class="form-group">
                                    <label for="urbanizacionID">Urbanización:</label>
                                    <input type="text" id="urbanizacionID" maxlength="45" class="form-control">
                                </div>
                        </div>
                </div>        
                <div class="row"> 
                       
                        <div class='col-sm-2'>
                                <div class="form-group">
                                    <label for="numeroID">Número:</label>
                                    <input type="text" id="numeroID" maxlength="6" class="form-control">
                                </div>
                        </div>
                        <div class='col-sm-2'>
                                <div class="form-group">
                                    <label for="interiorID">Interior:</label>
                                    <input type="text" id="interiorID" maxlength="8" class="form-control">
                                </div>
                        </div>
                        <div class='col-sm-2'>
                                    <div class="form-group">
                                        <label for="manzanaID">Mz:</label>
                                        <input type="text" id="manzanaID" maxlength="10" class="form-control">
                                    </div>
                        </div>
                        <div class='col-sm-2'>
                                    <div class="form-group">
                                        <label for="loteID">Lote:</label>
                                        <input type="text" id="loteID"  maxlength="10" class="form-control">
                                    </div>
                        </div>   
                </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" onclick="editDatosJoven()" id="btnEditUser">Actualizar</button>
                        </div>
                     
                </div>
                
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalEditDoc2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar - Datos Apoderado</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <input style="display:none" class="form-control vecino" id="idnorma2" placeholder="Ingrese titulo">
                <input style="display:none" class="form-control vecino" id="JovenID" placeholder="Ingrese titulo">
                <input style="display:none" class="form-control vecino" id="ApoderadoID" placeholder="Ingrese titulo">
                
                <div class="modal-body">
                    <div class="row">
                         <div class="col-sm-4">
                            <div class="form-group">
                                <label for="tipo">Tipo:</label>
                                <select class="form-control" id="selectTipoDocApoderado" >
                                    <option value="" >Seleccione un tipo de documento</option>
                                    <?php echo $combo_tipodoc?>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="documentoApoderadoID">Documento:</label>
                                <input type="text" id="documentoApoderadoID" maxlength="20" class="form-control" >
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="btnBuscar" style="opacity: 0;">Búsqueda</label>
                                <button id="btnBuscar" onclick="buscarApoderado()" type="button"
                                    class="btn btn-primary form-control" style="width: inherit;display: block;"
                                    >Buscar</button>
                            </div>
                        </div>
                        
                    </div>   
                    <div class="row"> 
                    <div class="col-md-4">
                            <div class="form-group" id="fechanacjov-container">
                                <label for="FechaNacimientoAID">F.Nacimiento:</label>
                                <input id="FechaNacimientoAID" type="text" class="form-control"  placeholder="Selecciona la fecha">
                            </div>
                        </div>
                        <div class='col-sm-6'>
                                <div class="form-group">
                                    <label for="nombresApoderadoID">Nombres:</label>
                                    <input type="text" id="nombresApoderadoID"  maxlength="30" class="form-control">
                                </div>
                        </div>
                    </div>
                    <div class="row"> 
                        <div class='col-sm-6'>
                                <div class="form-group">
                                    <label for="paternoApoderadoID">A.Paterno:</label>
                                    <input type="text" id="paternoApoderadoID" maxlength="20" class="form-control">
                                </div>
                        </div>
                        <div class='col-sm-6'>
                                <div class="form-group">
                                    <label for="maternoApoderadoID">A.Materno:</label>
                                    <input type="text" id="maternoApoderadoID" maxlength="20" class="form-control">
                                </div>
                        </div>
                    </div>
                    <div class="row"> 
                        <div class='col-sm-4'>
                                <div class="form-group">
                                    <label for="telefonoApoderadoID">Telefono:</label>
                                    <input type="text" id="telefonoApoderadoID"  maxlength="12" class="form-control">
                                </div>
                        </div>
                        <div class='col-sm-4'>
                                <div class="form-group">
                                    <label for="celularApoderadoID">Celular:</label>
                                    <input type="text" id="celularApoderadoID"  maxlength="12" class="form-control">
                                </div>
                        </div>
                        <div class='col-sm-4'>
                                <div class="form-group">
                                    <label for="correoApoderadoID">Correo:</label>
                                    <input type="text" id="correoApoderadoID" maxlength="100" class="form-control">
                                </div>
                        </div>
                    </div> 
                    <div class="row">         
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="selectEstadoCivilApoderado">Estado civil</label>
                                <select class="form-control" id="selectEstadoCivilApoderado">
                                    <option value="">Seleccione un tipo</option>
                                    <?php echo $combo_estado_civil?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="nombre">Sexo</label>
                            <div class="form-group">
                                <label class="radio-inline">
                                    <input id="SexoID" class="sexoJoven" type="radio" value="M" name="sexoApoderado">M
                                </label>
                                <label class="radio-inline" style="margin-left: 20px;">
                                    <input id="SexoID" class="sexoJoven" type="radio" value="F" name="sexoApoderado">F
                                </label>
                            </div>
                        </div>
                    </div>        
                    <div class="row">      
                        <div class='col-sm-6'>
                                <div class="form-group">
                                    <label for="ocupacionApoderadoID">Ocupación:</label>
                                    <input type="text" id="ocupacionApoderadoID" maxlength="100" class="form-control">
                                </div>
                        </div>
                        <div class='col-sm-6'>
                                <div class="form-group">
                                    <label for="gradoApoderadoID">Grado de Instruccion:</label>
                                    <input type="text" id="gradoApoderadoID" maxlength="40" class="form-control">
                                </div>
                        </div>
                    
                    </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" onclick="editDatosApoderado()" id="btnEditUser">Actualizar</button>
                        </div>
                     
                </div>
                
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalFamiliares" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Familiares</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="tagNuevo">Nombre</label>
                                <input class="form-control" id="nombreMod" placeholder="Ingrese nombre">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="tagNuevo">Apellido Paterno</label>
                                <input class="form-control" id="appaternoMod" placeholder="Ingrese apellido paterno">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="tagNuevo">Apellido Materno</label>
                                <input class="form-control" id="apmaternoMod" placeholder="Ingrese apellido materno">
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-4">
                            <div class="form-group">
                                <label for="tagNuevo">Edad</label>
                                <input class="form-control" id="edadMod" type="number" placeholder="Ingrese edad">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="selectTipoDoc">Parentesco</label>
                                <select class="form-control" id="selectParentesco">
                                    <option value="">Seleccione un parentesco</option>
                                    <option value="Padres">Padres</option>
                                    <option value="Hermano/a">Hermano/a</option>
                                    <option value="Esposo/a">Esposo/a</option>
                                    <option value="Tio/a">Tio/a</option>
                                    <option value="Abuelo/a">Abuelo/a</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="btnAgregarTag" style="opacity: 0;">Agregar</label>
                                <button id="btnAgregarTag" onclick="agregarFamiliar()" type="button"
                                    class="btn btn-primary form-control"
                                    style="width: inherit; display: block;">Agregar</button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body" style="padding-left: 0; padding-right: 0">
                        <table id="tablaAddFamiliares" class="table table-striped table-bordered" style="text-align: center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Ap. Paterno</th>
                                    <th>Ap. Materno</th>
                                    <th>Edad</th>
                                    <th>Parentesco</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody id="body_tags">
                            </tbody>
                        </table>
                        <input type="text" class="form-control" id="tagsEvento" readonly placeholder="Familiares"
                            style="display:none">
                        <button id="btnAddFamiliares" style="display: none" onclick="registrarFamiliares()" type="button" class="btn btn-primary">Asignar</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal" onClick="openListaFamiliares()">Ver familiares</button>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalListaFamiliares" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Familiares registrados</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    

                    <div class="card-body" style="padding-left: 0; padding-right: 0">
                        <table class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    
                                    <th>Nombre</th>
                                    <th>Ap. Paterno</th>
                                    <th>Ap. Materno</th>
                                    <th>Edad</th>
                                    <th>Parentesco</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody id="body_tags2">

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onClick="">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="overlay"></div>
    <script src="<?php echo base_url();?>public/utils/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/utils/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo base_url(); ?>public/utils/js/jquery.timepicker.min.js"></script>
    <script src="<?php echo base_url();?>public/utils/js/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo base_url();?>public/casa_juventud/js/admin_casa_juventud.js"></script>
    <script src="<?php echo base_url();?>public/utils/js/utils.js"></script>
   

    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
        integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
        crossorigin="anonymous"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>



    <script type="text/javascript">
        $(document).ready(function () {
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar, #content').toggleClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });

           
        });

        $('#fechanacjov-container input').datepicker({
            format: 'dd/mm/yyyy',
            startDate: '01/01/1970',
            endDate: '01/01/2050',
            autoclose: true
        });

        $(document).ready(function () {
            $('#sandbox-container input').datepicker({
                format: "dd/mm/yyyy"
            });
        });

    </script>

    <script>
        var base_url = <?php echo json_encode(base_url()); ?>;
    </script>

</body>

</html>