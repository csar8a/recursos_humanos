<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Casa de la Juventud</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/utils/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/casa_juventud/css/casa_juventud.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/utils/css/bootstrap-datepicker.css">

    <style>
        @media print {
            @page {
                margin: 0;
            }

            body {
                font-size: 10pt;
                margin: 1.3cm;
            }
        }

        @media screen,
        print {
            body {
                line-height: 1.2;
            }
        }
    </style>

</head>

<body>
    <div class="container" id="body_ficha">

        <div class="row" style="margin-top: 20px">
            <div class="col-4">
                <img src="<?php echo base_url(); ?>public/casa_juventud/img/logo_muni.png" alt="" class="center-img">
            </div>
            <div class="col-4">
                <h4 style="text-align: center; font-weight: bold">Ficha de Inscripción Casa de la Juventud</h4>
            </div>
            <div class="col-4">
                <input id="id_ficha" value="<?php echo $id ?>" style="display: none">
            </div>
        </div>
        <div class="card" style="margin-top: 15px">
            <div class="card-body" style="padding-bottom: 0">
                <div class="row">
                    <div class="col-8">
                        <h5 class="titleCrd">Datos de la ficha</h5>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <span for="codigoID"><b>Código: </b></span>
                                    <span id="codigoID"></span>&emsp;
                                    <span for="nombre"><b>Fecha Inscripcion: </b></span>
                                    <span id="fechainscrip"></span>&emsp;

                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <span for="paternoID"><b>Responsable de Incripción: </b></span>
                                    <span id="responsableID"></span>
                                </div>
                            </div>


                            <div class="col-12">
                                <div class="form-group">
                                    <span for="selectTipoDoc"><b>En caso de emergencia llamar a: </b></span>
                                    <span type="form-control" id="emergenciaID"></span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-4" style="text-align: center">
                        <img id="img_joven" class="img-profile" height="120px" width="120px">
                    </div>
                </div>
                <!--    <div class="row">
                    <div class="col-12" align="center">
                        <div class="form-group">
                            <span type="file" name="fileToUpload" id="fileToUpload">
                            <div id='preview'>

                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>

        <!-- 2do card Datos del joven -->

        <div class="card" style="margin-top: 5px">
            <div class="card-body" style="padding-bottom: 0">
                <h5 class="titleCrd">Datos del Joven</h5>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <span for="nombresID"><b>Nombre: </b></span>
                            <span type="form-control" id="nombresID"></span>&emsp;

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-4">
                        <div class="form-group">

                            <span id="documentoLb" for="documentoID"><b>N° de documento: </b></span>
                            <span id="documentoID" name="documento"></span>&emsp;
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">

                            <span for="nombre"><b>Fecha de nacimiento: </b></span>
                            <span type="text" id="fechanacjov-container"></span>&emsp;
                        </div>
                    </div>

                    <div class="col-2">
                        <div class="form-group">

                            <span for="nombre"><b>Sexo: </b></span>
                            <span id="sexoJovenID" name="documento"></span>&emsp;
                        </div>
                    </div>


                    <div class="col-2">
                        <div class="form-group">

                            <span id="documentoLb" for="documentoID"><b>Edad: </b></span>
                            <span style="background: none; border: none; width: auto" id="edadID"
                                name="documento"></span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">

                            <span for="selectTipoDoc"><b>Estado civil: </b></span>
                            <span id="estadoCivilJovenID" name="documento"></span>&emsp;
                            <span for="telefonoID"><b>Teléfono: </b></span>
                            <span id="telefonoID"></span>&emsp;
                            <span for="telefonoID"><b>Celular: </b></span>
                            <span id="celularID"></span>&emsp;
                            <span for="correoID"><b>Correo electrónico: </b></span>
                            <span type="email" id="correoID"></span>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-6">
                        <div class="form-group">
                            <span for="telefonoID"><b>Grado de instrucci&oacute;n: </b></span>
                            <span id="gradoInstruccionID"></span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <span for="correoID"><b>Ocupaci&oacute;n: </b></span>
                            <span type="email" id="ocupacionID"></span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <span for="selectTipoDoc"><b>Centro de estudios o trabajo: </b></span>
                            <span type="form-control" id="centroEstudioID"></span>
                        </div>
                    </div>
                </div>



            </div>
        </div>

        <!-- 2do card Datos de domicilio -->

        <div class="card" style="margin-top: 5px">
            <div class="card-body" style="padding-bottom: 0">
                <h5 class="titleCrd">Datos de domicilio</h5>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <span for="selectDistrito"><b>Distrito: </b></span>
                            <span id="distritoID"></span>&emsp;
                            <span for="viaID"><b>Vía Pública: </b></span>
                            <span id="viaID"></span>&emsp;
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">

                            <span for="urbanizacionID"><b>Urbanización: </b></span>
                            <span id="urbanizacionID"></span>&emsp;
                            <span for="numeroID"><b>Número: </b></span>
                            <span type="email" id="numeroID"></span>&emsp;
                            <span for="interiorID"><b>Interior: </b></span>
                            <span type="email" id="interiorID"></span>&emsp;
                            <span for="manzanaID"><b>Manzana: </b></span>
                            <span type="email" id="manzanaID"></span>&emsp;
                            <span for="loteID"><b>Lote: </b></span>
                            <span type="email" id="loteID"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 3er card  Apoderado -->

        <div class="card" style="margin-top: 5px">
            <div class="card-body" style="padding-bottom: 0">
                <h5 class="titleCrd">Datos del Apoderado</h5>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <span for="nombresID"><b>Nombre: </b></span>
                            <span type="form-control" id="nombresApoderadoID"></span>&emsp;
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-4">
                        <div class="form-group">

                            <span id="documentoLb" for="documentoID"><b>N° de documento: </b></span>
                            <span id="documentoApoderadoID" name="documento"></span>&emsp;
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">

                            <span for="nombre"><b>Fecha de nacimiento: </b></span>
                            <span type="text" id="fechaNacApoderado-container"></span>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">

                            <span for="nombre"><b>Sexo: </b></span>
                            <span id="sexoApoderadoID" name="documento"></span>&emsp;
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">

                            <span id="documentoLb" for="documentoID"><b>Edad: </b></span>
                            <span id="edadApoderadoID" name="documento"></span>&emsp;
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">


                            <span for="selectTipoDoc"><b>Estado civil: </b></span>
                            <span id="estadoCivilID" name="documento"></span>&emsp;
                            <span for="telefonoID"><b>Teléfono: </b></span>
                            <span id="telefonoApoderadoID"></span>&emsp;
                            <span for="telefonoID"><b>Celular: </b></span>
                            <span id="celularApoderadoID"></span>&emsp;
                            <span for="correoID"><b>Correo electrónico: </b></span>
                            <span type="email" id="correoApoderadoID"></span>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-6">
                        <div class="form-group">
                            <span for="telefonoID"><b>Grado de instrucci&oacute;n: </b></span>
                            <span id="gradoApoderadoID"></span>&emsp;
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <span for="correoID"><b>Ocupaci&oacute;n: </b></span>
                            <span type="email" id="ocupacionApoderadoID"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
if ($familiares != '<tbody></tbody>') {
    $tabla = '
                <div class="card" style="margin-top: 5px;">
                    <div class="card-body" style="padding-bottom: 0">
                        <h5 class="titleCrd">Familiares</h5>
                        <div class="row">
                            <div class="col-md-12" style="text-align: center">
                                <table class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Ap. Paterno</th>
                                            <th>Ap. Materno</th>
                                            <th>Edad</th>
                                            <th>Parentesco</th>
                                        </tr>
                                    </thead>

                ';
    $tabla .= $familiares;

    $tabla .= '
                                    </table>


                                        </div>
                                    </div>

                                </div>
                            </div>

                ';
    echo $tabla;
}
?>

        <div class="card" style="margin-top: 5px">
            <div class="card-body" style="padding-bottom: 0">

                <div class="row">
                    <div class="col-md-12" style="text-align: center">
                        <p>
                            Certifico que la informaci&oacute;n contenida en esta ficha de inscripci&oacute;n son
                            veridicas y se
                            ajustan
                            a la realidad, de no serlo cualquier declaraci&oacute;n falsa hecha por el suscrito,
                            voluntaria o
                            involuntariamente,
                            invalida la presente ficha de inscripci&oacute;n y libera de toda responsabilidad y
                            compromiso a la
                            Casa
                            de la Juventud de Bellavista quedando la inscripci&oacute;n nula y sin efecto.
                        </p>
                    </div>
                </div>
                <div class="row" style="text-align: center; margin-top: 15px;padding-bottom: 0">
                    <div class="col-md-4">
                        <canvas id="myCanvas" width="130" height="150" style="border:1px solid #d4d4d4;">
                            <p>ho</p>
                        </canvas>
                        <p><strong>Huella</strong></p>
                    </div>

                    <div class="col-md-8">
                        <canvas id="myCanvas" width="500" height="150" style="border:1px solid #d3d3d3;"></canvas>
                        <p><strong>Firma del Joven o Apoderado en caso de menor de edad</strong></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card" style="margin-top: 5px">
            <div class="card-body" style="padding-bottom: 0">
                <h5 class="titleCrd">Responsable de Inscripción</h5>
                <div class="row" style="text-align: center; margin-top: 15px; padding-left: 100px">
                    <div class="col-md-4">
                        <canvas id="myCanvas" width="280" height="100" style="border:1px solid #d4d4d4;"></canvas>
                        <p><strong>Responsable de inscripción</strong></p>
                    </div>

                    <div class="col-md-8">
                        <canvas id="myCanvas" width="280" height="100" style="border:1px solid #d3d3d3;"></canvas>
                        <p><strong>Sub Gerente</strong></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- 5to card CODIGO DE SEGURIDAD -->



    </div>
    <div class="card">
        <div class="card-body">


            <div class="row" style="text-align: center">
                <div class="col-12">
                    <button type="button" onclick="javascript:printDiv(body_ficha);" class="btn btn-info"
                        style="background-color: #2598cd !important;">Imprimir</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="<?php echo base_url(); ?>public/utils/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/utils/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>public/casa_juventud/js/final_casa_juventud.js"></script>
    <script src="<?php echo base_url(); ?>public/utils/js/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo base_url(); ?>public/utils/js/utils.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

    <script type="text/javascript">

        var base_url = <?php echo json_encode(base_url()); ?>;
        var URL_SERVER = <?php echo json_encode(URL_SERVER); ?>;

        function printDiv(body_ficha) {
            var printContents = document.getElementById('body_ficha').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
        mostrarFichaCompleta();



    </script>
</body>

</html>