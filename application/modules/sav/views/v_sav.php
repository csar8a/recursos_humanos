<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Servicio de atención al vecino</title>
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
        <?php echo $this->load->view('sidebar')?>
        <div id="content">
            <?php echo $this->load->view('header') ?>
            <div class="container" style="padding: 20px 0 20px 0">
                <h6>Consulta los anteriores registros haciendo click <a href="<?php echo base_url(); ?>admin_sav" rel="noopener noreferrer">aquí</a>.</h6>
                <div class="card" style="margin-top: 40px; background: #f1f1f1">
                    <div class="card-body">
                        <h4 style="margin-bottom: 20px">Datos del solicitante</h4>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="selectTipoDoc">Documento</label>
                                    <select class="form-control" id="selectTipoDoc" onChange="changeTipoDoc()">
                                        <option value="">Seleccione un tipo de documento</option>
                                        <?php echo $combo_tipodoc?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <label for="documentoID">N° de documento</label>
                                    <input class="form-control" id="documentoID" aria-describedby="nombreHelp" placeholder="Ingrese número de documento">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="documentoID" style="opacity: 0;">Búsqueda</label>
                                    <button id="btnBuscar" onclick="buscarPersona()" type="button" class="btn btn-primary form-control" style="width: inherit; display: block;" disabled>Buscar</button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="paternoID">Apellido Paterno</label>
                                    <input class="form-control" id="paternoID" placeholder="Ingrese su apellido paterno">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="maternoID">Apellido Materno</label>
                                    <input type="form-control" class="form-control" id="maternoID" placeholder="Ingrese su apellido materno">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nombresID">Nombres</label>
                                    <input type="form-control" class="form-control" id="nombresID" placeholder="Ingrese sus Nombres">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="telefonoID">Telefono</label>
                                    <input class="form-control" id="telefonoID" placeholder="Ingrese telefono o celular">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="correoID">Correo</label>
                                    <input type="email" class="form-control" id="correoID" placeholder="Ingrese correo">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php /*Segundo Card*/  ?>

                <div class="card" style="margin-top: 40px; background: #f1f1f1">
                    <div class="card-body">
                        <h4 style="margin-bottom: 20px">Domicilio del solicitante</h4>

                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="selectDistrito">Distrito</label>
                                    <select class="form-control" id="selectDistrito">
                                        <option value="">Seleccione un Distrito</option>
                                        <?php echo $combo_distritos?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <label for="viaID">Vía Pública</label>
                                    <input class="form-control" id="viaID" placeholder="Ingrese vía pública">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="urbanizacionID">Urbanización</label>
                                    <input class="form-control" id="urbanizacionID" placeholder="Ingrese urbanización">
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-group">
                                    <label for="numeroID">Número</label>
                                    <input type="email" class="form-control" id="numeroID" placeholder="Ingrese número">
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-group">
                                    <label for="interiorID">Interior</label>
                                    <input type="email" class="form-control" id="interiorID" placeholder="Ingrese interior">
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-group">
                                    <label for="manzanaID">Manzana</label>
                                    <input type="email" class="form-control" id="manzanaID" placeholder="Ingrese manzana">
                                </div>
                            </div>


                            <div class="col-2">
                                <div class="form-group">
                                    <label for="loteID">Lote</label>
                                    <input type="email" class="form-control" id="loteID" placeholder="Ingrese lote">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card" style="margin-top: 40px; background: #f1f1f1">
                    <div class="card-body">
                        <h4 style="margin-bottom: 20px">Datos del servicio</h4>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="selectCategoria">Categoría</label>
                                    <select class="form-control" id="selectCategoria" onchange="getSubcategoria()">
                                        <option value="">Seleccione una categoría</option>
                                        <?php echo $combo_categoria?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="selectSubCategoria">Sub-categoría</label>
                                    <select class="form-control" id="selectSubCategoria">
                                        <option value="">Seleccione una sub-categoría</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="selectMedio">Medio de comunicación</label>
                                    <select class="form-control" id="selectMedio">
                                        <option value="">Seleccione un medio</option>
                                        <?php echo $combo_medio?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <label for="temaID">Tema/Motivo</label>
                                    <input class="form-control" id="temaID" placeholder="Ingrese un tema/motivo">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="descID">Descripción: </label>
                                    <textarea class="form-control" rows="4" id="descID"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="float: right; margin-top: 20px">
                            <div class="col-12">
                                <button onclick="insertarReclamo()" type="button" style="background-color:#79AAFF !important;" class="btn btn-primary">Registrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url();?>public/utils/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/utils/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>public/sav/js/sav.js"></script>
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