<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Intranet - Admin documentos</title>

    <link rel="stylesheet" href="<?php echo base_url();?>public/utils/css/bootstrap.min.css" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/utils/css/style2.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/utils/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/utils/css/jquery.timepicker.min.css">
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
                <h4 style="margin-bottom: 20px">Lista de eventos</h4>
                <div class="card">
                    <div class="card-body">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Fecha inicio</th>
                                    <th>Fecha fin</th>
                                    <th>Editar</th>
                                    <th>Imagen</th>
                                    </tr>
                            </thead>
                            <tbody id="body_eventos">
                                <?php echo $eventos?>
                            </tbody>    
                        </table>
                    </div>
                </div>
            </div>
         </div>   
    </div>
    
    <div class="modal fade" id="modalEditEvento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Datos del evento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="tituloEvento">Título</label>
                                <input class="form-control" id="tituloEvento" placeholder="Título">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="descEvento">Descripción:</label>
                                <br>
                                <textarea class="form-control" rows="4" id="descEvento"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="locacionEvento">Lugar</label>
                                <input class="form-control" id="locacionEvento" placeholder="Lugar del evento">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="categoriaEvento">Categoría</label>
                                <select class="form-control" id="categoriaEvento">
                                    <option value="">Seleccione una categoría</option>
                                    <?php echo $combo_categoria?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="costoEvento">Costo (S/.)</label>
                                <input class="form-control" id="costoEvento" placeholder="Costo del evento">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="contactoEvento">Contacto</label>
                                <input class="form-control" id="contactoEvento" placeholder="Información de contacto">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class='col-8'>
                            <div class="form-group" id="sandbox-container">
                                <label for="fechainicio">Fecha inicio:</label>
                                <input type="text" class="form-control"  readonly placeholder="Selecciona la fecha inicio" id="fechainicio">
                            </div>
                        </div>
                        <div class='col-4'>
                            <div class="form-group">
                                <label for="horainicio">Hora inicio:</label>
                                <input type="text" class="form-control" id="horainicio"/>
                            </div>
                        </div>
                        <div class='col-sm-8'>
                            <div class="form-group" id="sandbox-container">
                                <label for="fechafin">Fecha fin:</label>
                                <input type="text" class="form-control" readonly placeholder="Selecciona la fecha fin" id="fechafin">
                            </div>
                        </div>
                        <div class='col-4'>
                            <div class="form-group">
                                <label for="horafin">Hora fin:</label>
                                <input type="text" class="form-control" id="horafin"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="tagsEvento">Palabras clave</label>
                            <div class="input-group" onclick="modalAddTag()">
                                <div class="input-group-prepend" >
                                    <span class="input-group-text"><i class='fas fa-plus tooltip-test' title='Agregar tag'></i></span>
                                </div>
                                <input type="text" class="form-control" id="tagsEvento" readonly placeholder="Palabras clave">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="editDatosEvento()" >Actualizar</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="modalEditArchivo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Imagen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="card-body">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Imagen</th>
                                    </tr>
                                </thead>
                                <tbody id="body_imagen">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                Archivo:
                                <input type="file" name="fileImagen" class="custom-file">
                                </tr>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <button onclick="editImagenEvento()" type="button" class="btn btn-primary form-control" style="width: inherit; display: block;">Actualizar imagen</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTags" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" >Palabras clave</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="tagNuevo">Palabra clave</label>
                                <input class="form-control" id="tagNuevo" placeholder="Nuevo tag">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="btnAgregarTag" style="opacity: 0;">Agregar</label>
                                <button id="btnAgregarTag" onclick="agregarTag()" type="button" class="btn btn-primary form-control" style="width: inherit; display: block;">Agregar</button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <table class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Palabra clave</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody id="body_tags">
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
    <script src="<?php echo base_url(); ?>public/utils/js/jquery.timepicker.min.js"></script>
    <script src="<?php echo base_url();?>public/utils/js/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo base_url();?>public/intranet/js/admin_eventos.js"></script>
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
        $(document).ready(function(){
            $('#fechainicio').datepicker({
                format: "dd/mm/yyyy"
            });
            $('#fechafin').datepicker({
                format: "dd/mm/yyyy"
            });
            $('#horainicio').timepicker({
                timeFormat: 'h:mm p',
                interval: 15,
                scrollbar: true,
                dynamic: false,
                defaultTime: '8',
            });
            $('#horafin').timepicker({
                timeFormat: 'h:mm p',
                interval: 15,
                scrollbar: true,
                dynamic: false,
                defaultTime: '10'
            });
        });
    </script>
</body>
</html>
