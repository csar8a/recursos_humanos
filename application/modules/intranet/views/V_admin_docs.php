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
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

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
            <div class="container">
                <h4 style="margin-bottom: 20px">Lista de documentos</h4>
                <div class="card" style="margin-top: 20px; background: #f1f1f1">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="documento">Documento</label>
                                    <input type="form-control" class="form-control vecino" id="documento"
                                        placeholder="Ingrese nombre de documento">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="selectTipoFiltro">Tipo de documento</label>
                                    <select class="form-control" id="selectTipoFiltro">
                                        <option value="" >Seleccione un tipo</option>
                                        <?php echo $combo_int_tipodoc?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group" id="sandbox-container">
                                    <label for="nombre">Fecha del documento:</label>
                                    <input type="text" class="form-control" readonly placeholder="Selecciona la fecha">
                                    <small>Docs. antes de la fecha</small>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="btnBuscar" style="opacity: 0;">Búsqueda</label>
                                    <button id="btnBuscar" onclick="buscarDocumento()" type="button"
                                        class="btn btn-primary form-control"
                                        style="width: inherit; display: block;">Buscar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table id="tbDocumentos" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Tipo</th>
                                        <th>Fecha de registro</th>
                                        <th>Editar</th>
                                        <th>Archivo</th>
                                        </tr>
                                </thead>
                                <tbody id="body_docs">
                                    <?php echo $docs?>
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
                    <h5 class="modal-title">Datos del documento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="nombreID">Nombre del documento</label>
                                <input class="form-control vecino" id="nombreID" placeholder="Ingrese el nombre del documento">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="selectTipo">Seleccione un tipo</label>
                                <select class="form-control" id="selectTipo">
                                    <option value="" >Seleccione un tipo</option>
                                    <?php echo $combo_int_tipodoc?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="descID">Descripción:</label>
                                <br>
                                <textarea class="form-control" rows="4" id="descID"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="editDatosDoc()" id="btnEditUser">Actualizar</button>
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
                                <input type="file" name="fileImagen" class="custom-file">
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
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo base_url(); ?>public/utils/js/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo base_url();?>public/intranet/js/admin_docs.js"></script>
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
            format: 'dd/mm/yyyy',
            startDate: '01/01/2000',
            endDate: '01/01/2050',
            todayHighlight: true,
            autoclose: true,
            clearBtn: true,
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

            $('#tbDocumentos').DataTable({
                "pagingType": "numbers",
                searching: false,
                info: false,
                "bLengthChange": false,
                "language": {
                    "lengthMenu": "Mostrar _MENU_ documentos por p&aacute;gina",
                    "zeroRecords": "No hay documentos para mostrar",
                }
            });
        });
    </script>
</body>
</html>
