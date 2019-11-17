<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Normas Institucionales</title>
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
                <h4 style="margin-bottom: 20px">Lista de normas</h4>
                <h6>Has un nuevo registro dando click <a href="<?php echo base_url(); ?>normas" rel="noopener noreferrer" style="color:#2699ce">aquí</a>.</h6>

                <div class="card" style="margin-top: 20px; background: #f1f1f1">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="tiponorma">Tipo de Norma:</label>
                                        <select class="form-control" id="tiponorma">
                                            <option value="">Seleccione un tipo de norma</option>
                                            <?php echo $combo_tiponorma?>
                                        </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="poryear">Año:</label>
                                        <select class="form-control" id="yearnorma">
                                            <option value="">Seleccione año</option>
                                            <?php echo $combo_year?>
                                        </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="buscarNormas"  style="opacity: 0;">Búsqueda</label>
                                    <button id="btnBuscar" onclick="BuscarNormas()" type="button" class="btn btn-primary form-control" style="width: inherit; display: block; background-color:#79AAFF !important;">Buscar</button>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="nombre">Nombre del Documento:</label>
                                    <input class="form-control" id="nombre" placeholder="Documento">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="nombre">Descripción del Documento:</label>
                                    <input class="form-control" id="descripcion" placeholder="Descripción">
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Fecha</th>
                                        <th>Hits</th>
                                        <th>Archivo</th>
                                        <th>Editar</th>
                                        </tr>
                                </thead>
                                <tbody id="body_normas">                                   
                                </tbody>    
                            </table>
                        </div>
                     </div>
                </div>
            </div>
         </div>   
    </div>
    <div class="modal fade" id="modalEditDoc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar - Datos de Norma Institucionales</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <input style="display:none" class="form-control vecino" id="idnorma2" placeholder="Ingrese titulo">
                
                <div class="modal-body">
                <div class="row">
                    <div class='col-sm-6'>
                        <div class="form-group" id="sandbox-container">
                            <label for="nombre">Fecha del documento:</label>
                            <input type="text" id="fecha2" class="form-control"  readonly placeholder="Selecciona la fecha">
                        </div>
                    </div>
                    
                        <div class="col-12">
                            <div class="form-group">
                                <label for="norma">Titulo:</label>
                                <input maxlength="150" class="form-control vecino" id="norma2" placeholder="Ingrese titulo">
                            </div>
                        </div>
                    
                    <div class="col-12">
                        <div class="form-group">
                            <label for="tipo">Tipo de Norma</label>
                            <select class="form-control" id="tipo2">
                                <option value="">Seleccione un tipo de norma</option>
                                <?php echo $combo_tiponorma?>
                            </select>
                        </div>
                    </div>
                   
                  
                        <div class="col-12">
                            <div class="form-group">
                                <label for="descripcion">Descripción:</label>
                                <br>
                                <textarea class="form-control" rows="4" id="descripcion2"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" onclick="editDatosNormas()" id="btnEditUser">Actualizar</button>
                        </div>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalEditArchivo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Archivo</h5>
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
                                        <th>Documento</th>
                                    </tr>
                                </thead>
                                <tbody id="body_archivo">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                Archivo:
                                <input type="file" name="fileImagen" class="custom-file" accept="application/pdf">
                                </tr>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <button onclick="editArchivo()" type="button" class="btn btn-primary form-control" style="width: inherit; display: block;">Actualizar archivo</button>
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
    <div class="overlay"></div>
    <script src="<?php echo base_url();?>public/utils/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/utils/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>public/utils/js/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo base_url();?>public/normas/js/admin_normas.js"></script>
    <script src="<?php echo base_url();?>public/utils/js/utils.js"></script>
    
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
        integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
        crossorigin="anonymous"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

    <script type="text/javascript">
        $('#sandbox-container input').datepicker({
            format:'dd/mm/yyyy',
            startDate: '01/01/2000',
            endDate: '01/01/2050', 
            autoclose: true
        });

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
