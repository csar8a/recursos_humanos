<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recursos Humanos</title>
    <link rel="stylesheet" href="<?php echo base_url();?>public/utils/css/bootstrap.min.css" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/utils/css/style2.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/utils/css/bootstrap-datepicker.css">
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
            <div class="container" style="padding: 20px 0 20px 0">
                <h4 style="margin-bottom: 20px">Consulta de Datos Personales</h4>
               

                <div class="card" style="margin-top: 20px; background: #f1f1f1">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                        <label for="nombrebus">Nombre Completo:</label>
                                        <input class="form-control" readonly="readonly" id="nombretotal" name="nombretotal" aria-describedby="searching">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="buscarNormas"  style="opacity: 0;">Seleccionar</label>
                                    <button id="btnBuscar" onclick="AbrirModalPersona()" type="button" class="btn btn-primary form-control" style="width: inherit; display: block; background-color:#063f5d !important;">Seleccionar Persona</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="nombrebus">Codigo:</label>
                                    <input class="form-control" readonly="readonly" id="codigo" name="codigo" aria-describedby="searching">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="nombrebus">DNI:</label>
                                    <input class="form-control" readonly="readonly" id="dni" name="dni" aria-describedby="searching">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="nombrebus">Fecha Nacimiento:</label>
                                    <input class="form-control" readonly="readonly" id="fecha_nac" name="fecha_nac" aria-describedby="searching">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="nombrebus">Cargo:</label>
                                    <input class="form-control" readonly="readonly" id="cargo" name="cargo" aria-describedby="searching">
                                </div>
                            </div>
                        </div>
                        <div class="row"> 
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="nombrebus">Fecha Ingreso:</label>
                                    <input class="form-control" readonly="readonly" id="ingreso" name="ingreso" aria-describedby="searching">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="nombrebus">Fecha Cese:</label>
                                    <input class="form-control" readonly="readonly" id="cese" name="cese" aria-describedby="searching">
                                </div>
                            </div>
                        </div> 
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="buscarVacaciones"  style="opacity: 0;">Vacaciones</label>
                             <button id="btnBuscar" onclick="BuscarVacaciones()" type="button" class="btn btn-primary form-control" style="width: inherit; display: block; background-color:#79AAFF !important;">Ver Vacaciones</button>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Periodo</th>
                                        <th>Fecha_Inicio</th>
                                        <th>Fecha_Fin</th>
                                        <th>Dias</th>
                                        <th>Saldo</th>
                                        <th>Descripcion</th>
                                        </tr>
                                </thead>
                                <tbody id="body_vacaciones">                                   
                                </tbody>    
                            </table>
                        </div>
                     </div>
                </div>
            </div>
         </div>   
    </div>
    <div class="modal fade" id="modal_persona" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Buscar Persona</h5>
                    <button  type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                        <label for="nombrebus">Nombre Completo:</label>
                                        <input class="form-control" id="nombrebus" name="nombrebus" aria-describedby="searching">
                                </div>
                            </div>
                            <div class="col-3">
                                    <div class="form-group">
                                        <label for="buscarNormas"  style="opacity: 0;">Seleccionar</label>
                                        <button id="btnBuscar" onclick="BuscarPersona()" type="button" class="btn btn-primary form-control" style="width: inherit; display: block; background-color:#063f5d !important;">Buscar</button>
                                    </div>
                            </div>
                        </div>

                        <table class="table table-striped table-bordered" style="width:100%">
                           
                            <tbody id="body_personas">
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
    
    <div class="overlay"></div>
    <script src="<?php echo base_url();?>public/utils/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/utils/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>public/recursos_humanos/js/buscar_persona.js"></script>
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
    </script>
</body>
</html>
