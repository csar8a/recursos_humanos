<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>REPORTE CONSULTA PIDE - MUNICIPALIDAD DE BELLAVISTA </title>
   
    <link rel="stylesheet" href="<?php echo base_url();?>public/utils/css/bootstrap.min.css" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/utils/css/style2.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/utils/css/bootstrap-datepicker.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

    <!-- Font Awesome JS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/utils/css/fontawesome/all.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <?php echo $this->load->view('sidebar')?>
        <div id="content">
            <!-- HEADER  -->
            <?php echo $this->load->view('header') ?>
            <div class="container" style="padding: 20px 0 20px 0">
                <h4 style="margin-bottom: 20px">Reporte de uso</h4>
             

                <div class="card" style="margin-top: 20px; background: #f1f1f1">
                    <div class="card-body">
                        <div class="row">
                                
                            <div class="col-md-4">
                                <div class="form-group" id="fecha1-container">
                                    <label for="nombre">Fecha: De</label>
                                    <input id="Fecha1" type="text" class="form-control" readonly placeholder="Selecciona la fecha">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group" id="fecha2-container">
                                    <label for="nombre">Fecha: Hasta</label>
                                    <input id="Fecha2" type="text" class="form-control" readonly placeholder="Selecciona la fecha">
                                </div>
                            </div>
   
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="buscarPide"  style="opacity: 0;">Ver Reporte -PDF</label>
                                    <button id="btnBuscar" onclick="cargarReporte()" type="button" class="btn btn-primary form-control" style="width: inherit; display: block;">Filtrar</button>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                    <div class="card">
                        
                        <div class="card-body">
                            <div id="descfecha">
                            </div>
                            <div id="div_table">
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
         </div>   
    </div>
    <div class="overlay"></div>
    <script src="<?php echo base_url();?>public/utils/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/utils/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>public/utils/js/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo base_url();?>public/pide/js/reporte_pide.js"></script>
    <script src="<?php echo base_url();?>public/utils/js/utils.js"></script>
    
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
        integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
        crossorigin="anonymous"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
    <script type="text/javascript">
      
        var getDate = function (input) {
            return new Date(input.date.valueOf());
        }
                                            
        $('#fecha1-container input, #fecha2-container input').datepicker({
                format: "dd/mm/yyyy",
                language: 'es'
            });
        $('#fecha2-container input').datepicker({
                startDate: '+6d',
                endDate: '+36d',
            });
        $('#fecha1-container input').datepicker({
                startDate: '+5d',
                endDate: '+35d',
            }).on('changeDate',
                function (selected) {
                    $('#fecha2-container input').datepicker('clearDates');
                    $('#fecha2-container input').datepicker('setStartDate', getDate(selected));
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

        $(document).ready(function () {
        $('#example').DataTable({
            "pagingType": "numbers", // "simple" option for 'Previous' and 'Next' buttons only
            searching: false,
            info: false,
            "bLengthChange": false,
            "language": {
            "lengthMenu": "Mostrar _MENU_ documentos por p&aacute;gina",
            "zeroRecords": "No hay documentos para mostrar",
        }
        });
        $('.dataTables_length').addClass('bs-select');
        });
    </script>
</body>
</html>
