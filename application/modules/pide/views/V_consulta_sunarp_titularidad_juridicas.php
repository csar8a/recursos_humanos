<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SUNARP</title>

    <link rel="stylesheet" href="<?php echo base_url(); ?>public/utils/css/bootstrap.min.css" crossorigin="anonymous">
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
.modal-full {
    min-width: 100%;
    
    margin: 8px;
}
.modal-full .modal-content {
    min-height: 100vh;
    min-width: 100vh;
    
}
</style>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <?php echo $this->load->view('sidebar') ?>
        <div id="content">
            <!-- HEADER  -->
            <?php echo $this->load->view('header') ?>
            <div class="container" style="padding: 20px 0 20px 0">
                <h4 style="margin-bottom: 20px">Consulta SUNARP - Titularidad de Persona Juridica</h4>

                <div class="card" style="margin-top: 20px; background: #f1f1f1">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="dni">Raz&oacute;n Social:</label>
                                    <input class="form-control" id="razonSocial" aria-describedby="searching" placeholder="Raz&oacute;n Social">
                                    <small id="searching" style="display: none;" class="form-text text-muted">Buscando...</small>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                        <label for="buscarNormas"  style="opacity: 0;">Búsqueda</label>
                                    <button id="btnBuscar" onclick="BuscarSunarp()" type="button" class="btn btn-primary form-control" style="width: inherit; display: block; background-color:#79AAFF !important;">Buscar</button>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div id="body_consulta" class="table-responsive"></div>
                        </div>
                    </div>
                </div>
            </div>
         </div>
    </div>
    <div class="modal" id="my_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-full" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Consulta de Asientos por predio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body p-4" id="result" style="width:500px; background:#FFCC00; float:left;">
                        <p >Numero de Partida:</p>
                        <div class="col-3">
                            <div class="form-group">
                                <label style="color:#063f5d" for="tiponorma">N° de Asiento:</label>
                                    <select class="form-control" id="tiponorma">
                                        <option value="">Asiento 1</option>
                                        <option value="">Asiento 2</option>
                                        <option value="">Asiento 3</option>
                                    </select>
                            </div>
                        </div>  
                        <div class="col-3">
                            <div class="form-group">
                                <label style="color:#063f5d" for="tiponorma">N° de Pagina:</label>
                                    <select class="form-control" id="tiponorma">
                                        <option value="">Pagina 1</option>
                                        <option value="">Pagina 2</option>
                                        <option value="">Pagina 3</option>
                                        <option value="">Pagina 4</option>
                                        <option value="">Pagina 5</option>
                                    </select>
                            </div>
                        </div> 
                        <div class="col-3">
                                <div class="form-group">
                                        <label for="buscarNormas"  style="opacity: 0;">Búsqueda</label>
                                    <button id="btnBuscar" onclick="BuscarSunarp2()" type="button" class="btn btn-primary form-control" style="width: inherit; display: block; background-color:#79AAFF !important;">Buscar</button>

                                </div>
                        </div> 
                        
                </div>
                <div class="col-12" style="width:500px; background:#CCFF66; float:right;">
                            <div class="row">
                                <div id="body_asientos" class="table-responsive">
                                    
                                </div>
                            
                            </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url(); ?>public/utils/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/utils/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>public/pide/js/consulta_sunarp_titularidad_juridicas.js"></script>
    <script src="<?php echo base_url(); ?>public/utils/js/utils.js"></script>

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