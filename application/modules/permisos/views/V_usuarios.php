<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Permisos</title>
  
    <link rel="stylesheet" href="<?php echo base_url();?>public/utils/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/utils/css/bootstrap-datepicker.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/utils/css/style2.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

    <!-- Font Awesome JS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/utils/css/fontawesome/all.min.css">
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <?php echo $this->load->view('sidebar')?>
        <div id="content">
            <!-- HEADER  -->
            <?php echo $this->load->view('header') ?>
            <div class="container" >
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="nombresBusquedaID">Nombre</label>
                                    <input type="form-control" class="form-control vecino" id="nombresBusquedaID" placeholder="Ingrese un nombre">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="btnBuscar" style="opacity: 0;">Búsqueda</label>
                                    <button id="btnBuscar" onclick="buscarUsuarioNombre()" type="button" class="btn btn-primary form-control" style="width: inherit; display: block;">Buscar</button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <button id="btnBuscar" onclick="modalRegUser()" type="button" class="btn btn-primary form-control" style="width: inherit; display: block;">Registrar usuario</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombres</th>
                                        <th>Usuario</th>
                                        <th>Editar datos</th>
                                        <th>Área actual</th>
                                        <th>Editar área</th>
                                        <th>Roles</th>
                                        <th>Permisos usuario</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody id="body_usuarios_busqueda">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="modalEditArea" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Área</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="areaUsuarioID">Seleccione el área al cual desea asignar</label>
                                <select class="form-control" id="areaUsuarioID">
                                    <option value="" >Seleccione el área</option>
                                    <?php echo $combo_area?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class='col-sm-6'>
                            <div class="form-group" id="fechaInicioID">
                                <label for="fecIni">Fecha inicio:</label>
                                <input type="text" class="form-control" id="fecIni" readonly placeholder="Selecciona la fecha">
                            </div>
                        </div>
                        <div class='col-sm-6'>
                            <div class="form-group" id="fechaFinID">
                                <label for="fecFin">Fecha fin:</label>
                                <input type="text" class="form-control" id="fecFin" readonly placeholder="Selecciona la fecha">
                            </div>
                        </div>
                    </div>
                    
                    
                </div>    
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="asignarArea()">Asignar área</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="modalEditUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Datos usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="selectTipoDoc">Documento</label>
                                <select class="form-control" id="selectTipoDoc">
                                    <option value="">Seleccione un tipo de documento</option>
                                    <?php echo $combo_tipodoc?>
                                </select>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="form-group doc">
                                <label id="documentoLb" for="documentoID" >N° de documento</label>
                                <input class="form-control" id="documentoID" name="documento" aria-describedby="nombreHelp" placeholder="Ingrese número de documento">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="apellidosID">Apellidos</label>
                                <input class="form-control vecino" id="apellidosID" placeholder="Ingrese su apellido paterno">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nombresID">Nombres</label>
                                <input type="form-control" class="form-control vecino" id="nombresID" placeholder="Ingrese sus Nombres">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="correoID">Correo electrónico</label>
                                <input type="email" class="form-control vecino" id="correoID" placeholder="Ingrese correo electrónico">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="usuarioID">Usuario</label>
                                <input type="form-control" class="form-control vecino" id="usuarioID" placeholder="Ingrese un usuario">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="passwordID">Contrase&ntilde;a</label>
                                <input type="password" id="passwordID" class="form-control" placeholder="Contrase&ntilde;a">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="telefonoID">Teléfono</label>
                                <input class="form-control vecino" id="telefonoID" placeholder="Ingrese teléfono o celular">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class='col-sm-4'>
                            <div class="form-group" id="fechaID">
                                <label for="fecha">Fecha de nacimiento:</label>
                                <input type="text" class="form-control" id="fecha" readonly placeholder="Selecciona la fecha">
                            </div>
                        </div>
                    </div>
                    <div class="row" id="row_area">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="selectArea">Área</label>
                                <select class="form-control" id="selectArea">
                                    <option value="">Seleccione un área</option>
                                    <?php echo $combo_area?>
                                </select>
                            </div>
                        </div>
                        <div class='col-sm-4'>
                            <div class="form-group" >
                                <label for="fecIniReg">Fecha inicio (Área):</label>
                                <input type="text" class="form-control" id="fecIniReg"istro"" readonly placeholder="Selecciona la fecha">
                            </div>
                        </div>
                        <div class='col-sm-4'>
                            <div class="form-group" >
                                <label for="fecFinReg">Fecha fin (Área):</label>
                                <input type="text" class="form-control" id="fecFinReg" readonly placeholder="Selecciona la fecha">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="registrarUsuario()" id="btnEditUser">Registrar Usuario</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="modalEditRol" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" >Rol</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="selectRolAsignar">Seleccione un rol</label>
                                <select class="form-control" id="selectRolAsignar">
                                    <option value="" >Seleccione un rol</option>
                                    <?php echo $combo_rol?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="btnAgregarRol" style="opacity: 0;">Agregar</label>
                                <button id="btnAgregarRol" onclick="asignarRolUsuario()" type="button" class="btn btn-primary form-control" style="width: inherit; display: block;">Agregar</button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <table class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Rol</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody id="body_roles">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="modalConfirmarQuitarRol" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" >Eliminar rol</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p><strong>¿Seguro que desea eliminar el rol?</strong></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="btnEliminarRol" type="button" class="btn btn-primary" data-dismiss="modal">Confirmar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalPermisos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" >Permisos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="selectModulo">Sistema</label>
                                <select class="form-control" id="selectModulo" onchange="getPermisosByModulo()">
                                    <option value="">Seleccione un sistema</option>
                                    <?php echo $modulos?>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="selectPermiso">Permiso</label>
                                <select class="form-control" id="selectPermiso">
                                    <option value="">Seleccione un permiso</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="btnAgregarRol" style="opacity: 0;">Agregar</label>
                                <button id="btnAgregarRol" onclick="asignarPermisoUsuario()" type="button" class="btn btn-primary form-control" style="width: inherit; display: block;">Agregar</button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <table class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Sistema</th>
                                    <th>Permiso</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody id="body_permisos">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="modalConfirmarQuitarPermiso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" >Eliminar Permiso</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p><strong>¿Seguro que desea eliminar el permiso?</strong></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="btnEliminarPermiso" type="button" class="btn btn-primary" data-dismiss="modal">Confirmar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url();?>public/utils/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/utils/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>public/utils/js/utils.js"></script>
    <script src="<?php echo base_url();?>public/permisos/js/usuarios.js"></script>
    <script src="<?php echo base_url();?>public/utils/js/bootstrap-datepicker.min.js"></script>
    
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

        $('#fechaID input').datepicker({
            format:'dd/mm/yyyy',
            startDate: '01/01/1919',
            endDate: '30/12/2019', 
            autoclose: true
        });
        $('#fechaInicioID input').datepicker({
            format:'dd/mm/yyyy',
            startDate: '01/01/1919',
            endDate: '30/12/2019', 
            autoclose: true
        });
        $('#fechaFinID input').datepicker({
            format:'dd/mm/yyyy',
            startDate: '01/01/1919',
            endDate: '30/12/2019', 
            autoclose: true,
            clearBtn: true
        });
        $('#fecIniReg').datepicker({
            format:'dd/mm/yyyy',
            startDate: '01/01/1919',
            autoclose: true
        });
        $('#fecFinReg').datepicker({
            format:'dd/mm/yyyy',
            startDate: '01/01/1919',
            autoclose: true
        });
    </script>
</body>
</html>