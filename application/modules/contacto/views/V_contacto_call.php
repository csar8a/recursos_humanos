<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Contacto-Sugerencias</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/utils/css/jquery.dropdown.min.css">
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body>
    <div class="container">
        <h1>Se ha registrado una nueva llamada</h1>
        <br>
        <!-- Sidebar  -->
        <div class="card">
            <div class="card-body">
                <h4 >Información del vecino</h4>
                <h6 class="titleCrd">Código/caso : <?php echo $codigo ?></h6>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="paternoID">Apellido Paterno</label>
                            <input class="form-control vecino" id="paternoID" placeholder="Ingrese su apellido paterno">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="maternoID">Apellido Materno</label>
                            <input type="form-control" class="form-control vecino" id="maternoID" placeholder="Ingrese su apellido materno">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nombresID">Nombres</label>
                            <input type="form-control" class="form-control vecino" id="nombresID" placeholder="Ingrese sus Nombres">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="selectEstado">Estado</label>
                            <select class="form-control" id="selectEstado">
                                <option value="">Seleccione un estado</option>
                                <option value="1">Atendido</option>
                                <option value="2">Derivada</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="telefonoID">Teléfono</label>
                            <input disabled class="form-control vecino" id="telefonoID" placeholder="Ingrese teléfono o celular">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="fechaID">Fecha/Hora</label>
                            <input disabled class="form-control vecino" id="fechaID" placeholder="Ingrese teléfono o celular">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="asuntoID">Asunto</label>
                            <input type="form-control" class="form-control" id="asuntoID" placeholder="Ingrese el asunto del mensaje">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="mensajeID">Mensaje</label>
                            <textarea class="form-control" id="mensajeID" rows="4" placeholder="Ingrese el mensaje"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row" style="float: right; margin-top: 20px">
                    <div class="col-12">
                        <button type="button" class="btn btn-primary btn-lg" id="btnContacto" onclick="guardarContacto()">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="<?php echo base_url(); ?>public/utils/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/utils/js/Popper.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/utils/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-dropdown/2.0.3/jquery.dropdown.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script type="text/javascript" src="<?php echo base_url(); ?>public/utils/js/bootstrap-select.js"></script>
    <script src="<?php echo base_url(); ?>public/contacto/js/contacto_call.js"></script>
    <script src="<?php echo base_url(); ?>public/utils/js/utils.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            idcontacto = <?php echo $idcontacto; ?>;
            var llamada    = <?php echo $llamada; ?>;
            var fecha      = "<?php echo $fecha; ?>";
            
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar, #content').toggleClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
            $('#telefonoID').val(llamada);
            $('#fechaID').val(fecha);
        });
    </script>
</body>

</html>