<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MTC</title>
  
    <link rel="stylesheet" href="<?php echo base_url();?>public/utils/css/bootstrap.min.css" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/utils/css/style2.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

    <!-- Font Awesome JS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/utils/css/fontawesome/all.min.css">

    <style>
        table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        }

        td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
        font-size: 0.8em;
        }

        tr:nth-child(even) {
        background-color: #dddddd;
        }
    </style>

</head>
<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <?php echo $this->load->view('sidebar')?>
        <div id="content">
            <!-- HEADER  -->
            <?php echo $this->load->view('header') ?>
            <div class="container" style="padding: 20px 0 20px 0">
                <h4 style="margin-bottom: 20px">Consulta última licencia</h4>

                <div class="card" style="margin-top: 20px; background: #f1f1f1">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="dni">Seleccione un tipo de documento</label>
                                    <select class="form-control" id="selectTipoDoc">
                                        <option value="">Tipo de documento</option>	
                                        <option value="1">RUC</option>
                                        <option value="2">DNI</option>
                                        <option value="4">CE</option>
                                        <option value="5">CS</option>
                                        <option value="6">PASAPORTE</option>
                                        <option value="13">TI</option>
                                        <option value="14">PTP</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="dni">Ingrese su número de Documento</label>
                                    <input class="form-control" id="doc" aria-describedby="searching" placeholder="Número de documento">
                                    
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                        <label for="buscarPapeletas"  style="opacity: 0;">Búsqueda</label>
                                    <button id="btnBuscar" onclick="buscarUltimaLicencia()" type="button" class="btn btn-primary form-control" style="width: inherit; display: block; background-color:#79AAFF !important;">Buscar</button>
                                    <small id="searching" style="display: none;" class="form-text text-muted">Buscando...</small> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div id="body_consulta"></div>    
                        </div>
                    </div>
                </div>
            </div>
         </div>   
    </div>
    <script src="<?php echo base_url();?>public/utils/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/utils/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>public/pide/js/consulta_ultima_licencia.js"></script>
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