<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Intranet - Noticias</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/utils/css/utils.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/contacto/css/admin_contacto.css">

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
        <!-- Sidebar  -->
        <?php echo $this->load->view('sidebar')?>
        <div id="content">
            <!-- HEADER  -->
            <?php echo $this->load->view('header') ?>
            <div class="container">
                <h4 style="margin-bottom: 20px">Noticias</h4>
                <h6>Administra las noticias haciendo click <a href="<?php echo base_url(); ?>admin_noticias" rel="noopener noreferrer" style="color:#2699ce">aquí</a>.</h6>
                <div class="card" style="margin-top: 20px;">
                    <div class="card-body">
                        <div class="row">
                            
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="tituloNoticia">Título</label>
                                    <input maxlength="150" class="form-control" id="tituloNoticia" placeholder="Título">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="descNoticia">Descripción:</label>
                                    <br>
                                    <textarea class="form-control" rows="4" id="descNoticia"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="extracto">Extracto:</label>
                                    <small class="text-muted">(Opcional)</small>
                                    <input maxlength="200" class="form-control" id="extracto" placeholder="Extracto">
                                    <br>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    Seleccionar foto principal:
                                    <input id="principal" name="principal" type="file"  class="custom-file" accept="image/*">
                                    </tr>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    Seleccionar imagenes extras:
                                    <input id="extras" name="extras" type="file"  class="custom-file" accept="image/*" multiple="multiple">
                                   
                                </tr>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button onclick="insertarNoticia()" type="button" class="btn btn-primary">Registrar</button>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="<?php echo base_url(); ?>public/utils/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/utils/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>public/intranet/js/noticias.js"></script>
    <script src="<?php echo base_url(); ?>public/utils/js/utils.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
    
        


        
    <script type="text/javascript">

            $("input#extras").change(function() {
            var ele = document.getElementById($(this).attr('id'));
            var result = ele.files;
            for(var x = 0;x< result.length;x++){
                var fle = result[x];
                $("#output").append( (x != 0 ? "," : "")+fle.name);        
            }
            
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