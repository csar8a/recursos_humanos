<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Servicio de atención al vecino</title>
    <link rel="stylesheet" href="<?php echo base_url();?>public/utils/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/utils/css/fontawesome/all.min.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>public/utils/css/utils.css">
    <link rel="stylesheet" href="<?php echo base_url();?>public/utils/css/bootstrap.min.css" crossorigin="anonymous">
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
        <?php echo $this->load->view('sidebar')?>
        <div id="content">
            <?php echo $this->load->view('header') ?>
            <div class="container" style="padding: 20px 0 20px 0">
                <h6>Has un nuevo registro dando click <a href="<?php echo base_url(); ?>sav" rel="noopener noreferrer">aquí</a>.</h6>
                <div class="card" style="margin-top: 40px;">
                    <div class="card-body">
                        <table id="tb" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Categoría</th>
                                    <th>Subcategoría</th>
                                    <th>Medio de contacto</th>
                                    <th>Tema</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody id="body_normas">
                                <?php echo $tb_sav; ?>
                            </tbody>    
                        </table>
                    </div>
                </div>
            </div>
         </div>   
    </div>

    

    <div class="modal fade bd-example-modal-md" id="modalVer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalVerLongTitle">Datos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">NOMBRE:</label>
                        <div class="col-sm-9">
                            <p type="text" readonly class="form-control-plaintext" id="nomID"></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">CATEGORÌA:</label>
                        <div class="col-sm-9">
                            <p type="text" readonly class="form-control-plaintext" id="catID"></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">SUBCATEGORÌA:</label>
                        <div class="col-sm-9">
                            <p type="text" readonly class="form-control-plaintext" id="subcatID"></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">MEDIO:</label>
                        <div class="col-sm-9">
                            <p type="text" readonly class="form-control-plaintext" id="medioID"></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">TEMA:</label>
                        <div class="col-sm-9">
                            <p type="text" readonly class="form-control-plaintext" id="temaID"></p>
                        </div>
                    </div>
                        <div class="form-group row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">MENSAJE:</label>
                        <div class="col-sm-9">
                            <p type="text" readonly class="form-control-plaintext" id="mensajeID"></p>
                        </div>
                    </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url();?>public/utils/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/utils/js/bootstrap.min.js"></script>

    <script src="<?php echo base_url();?>public/sav/js/admin_sav.js"></script>
    <script src="<?php echo base_url();?>public/utils/js/utils.js"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
        integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
        crossorigin="anonymous"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

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