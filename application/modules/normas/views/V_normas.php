<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro de Normas Institucionales</title>

    <link rel="stylesheet" href="<?php echo base_url(); ?>public/utils/css/bootstrap.min.css" crossorigin="anonymous">
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
        <?php echo $this->load->view('sidebar') ?>
         <!-- Page Content  -->
         <div id="content">

         <?php echo $this->load->view('header') ?>


            <div class="container" style="padding: 20px 0 20px 0">
                <h4 style="margin-bottom: 20px">Datos del documento</h4>
                <h6>Consulta los anteriores registros haciendo click <a href="<?php echo base_url(); ?>admin_normas" rel="noopener noreferrer" style="color:#2699ce">aquí</a>.</h6>

                <div class="card" style="margin-top: 20px; background: #f1f1f1">
                    <div class="card-body">
                        <div class="row">
                            <div class='col-sm-4'>
                                <div class="form-group" id="sandbox-container">
                                    <label for="nombre">Fecha del documento:</label>
                                    <input type="text" class="form-control"  readonly placeholder="Selecciona la fecha">
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <label for="tiponorma">Tipo de Norma</label>
                                    <select class="form-control" id="tiponorma">
                                        <option value="">Seleccione un tipo de norma</option>
                                        <?php echo $combo_tiponorma ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="nombre">Nombre del Documento:</label>
                                    <input class="form-control" id="nombre" placeholder="Documento">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="descripcion">Descripción:</label>
                                    <br>
                                    <textarea class="form-control" rows="4" id="descripcion"></textarea>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    Archivo:
                                    <input type="file" name="fileImagen" class="custom-file" accept="image/gif, image/jpg, image/jpeg, image/png">
                                    </tr>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button onclick="insertarNorma()" type="button" style="background-color:#79AAFF !important;" class="btn btn-primary" data-dismiss="modal">Registrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="overlay"></div>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="<?php echo base_url(); ?>public/utils/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/utils/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>public/utils/js/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo base_url(); ?>public/normas/js/normas.js"></script>
    <script src="<?php echo base_url(); ?>public/utils/js/utils.js"></script>
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