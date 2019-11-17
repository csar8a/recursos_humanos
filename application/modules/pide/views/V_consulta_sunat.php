<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SUNAT</title>

    <link rel="stylesheet" href="<?php echo base_url(); ?>public/utils/css/bootstrap.min.css" crossorigin="anonymous">
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
        <?php echo $this->load->view('sidebar') ?>
        <div id="content">
            <!-- HEADER  -->
            <?php echo $this->load->view('header') ?>
            <div class="container" style="padding: 20px 0 20px 0">
                <h4 style="margin-bottom: 20px">Consulta SUNAT</h4>

                <div class="card" style="margin-top: 20px; background: #f1f1f1">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="ruc">RUC:</label>
                                    <input class="form-control" id="ruc" placeholder="RUC" aria-describedby="searching">
                                    <small id="searching" style="display: none;"
                                        class="form-text text-muted">Buscando...</small>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="buscarNormas" style="opacity: 0;">Búsqueda</label>
                                    <button id="btnBuscar" onclick="buscarSunat()" type="button"
                                        class="btn btn-primary form-control"
                                        style="width: inherit; display: block; background-color:#79AAFF !important;">Buscar</button>
                                </div>
                                <small id="codigo_sunat"></small>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                  <a class="nav-link active" id="principal-tab" data-toggle="tab" href="#principalData" role="tab" aria-controls="principalData" aria-selected="true">Datos principales</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" id="secundario-tab" data-toggle="tab" href="#secundarioData" role="tab" aria-controls="secundarioData" aria-selected="false">Datos secundarios</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" id="tercer-tab" data-toggle="tab" href="#tercerData" role="tab" aria-controls="tercerData" aria-selected="false">Representantes legales</a>
                                </li>
                              </ul>
                              <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="principalData" role="tabpanel" aria-labelledby="principal-tab" style="padding: 15px">
                                    <div id="body_consulta"></div>
                                </div>
                                <div class="tab-pane fade" id="secundarioData" role="tabpanel" aria-labelledby="secundario-tab" style="padding: 15px">
                                    <div id="body_consulta2"></div>
                                </div>
                                <div class="tab-pane fade" id="tercerData" role="tabpanel" aria-labelledby="tercer-tab" style="padding: 15px">
                                    <div id="body_consulta3"></div>
                                </div>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url(); ?>public/utils/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/utils/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>public/pide/js/consulta_sunat.js"></script>
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

            $(".nav-tabs a").click(function () {
                $(this).tab('show');
            });
        });
    </script>
</body>

</html>