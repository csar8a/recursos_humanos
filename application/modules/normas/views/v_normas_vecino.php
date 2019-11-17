<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Normas Institucionales</title>
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




    <div class="container" style="padding: 50px 0 10px 0px">

        <div class="card" style="margin-top: 20px; background: #f1f1f1">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="tiponorma">Tipo de Norma:</label>
                            <select class="form-control" id="tiponorma">
                                <option value="">Seleccione un tipo de norma</option>
                                <?php echo $combo_tiponorma?>
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="poryear">Año:</label>
                            <select class="form-control" id="yearnorma">
                                <option value="">Seleccione año</option>
                                <?php echo $combo_year?>
                            </select>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="form-group">
                            <label for="buscarNormas" style="opacity: 0;">Búsqueda</label>
                            <button id="btnBuscar" onclick="buscarNormas()" type="button"
                                class="btn btn-primary form-control"
                                style="width: inherit; display: block; background-color:#79AAFF !important;">Buscar</button>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="nombre">Nombre del Documento:</label>
                            <input class="form-control" id="nombre" placeholder="Documento">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="nombre">Descripción del Documento:</label>
                            <input class="form-control" id="descripcion" placeholder="Descripción">
                        </div>
                    </div>

                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Fecha</th>
                                <th>Hits</th>
                                <th>Archivo</th>
                            </tr>
                        </thead>
                        <tbody id="body_normas">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript" src="<?php echo base_url();?>public/utils/js/jquery-3.3.1.min.js"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
        integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
        crossorigin="anonymous"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/utils/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/normas/js/normas_vecino.js"></script>
    



</body>

</html>