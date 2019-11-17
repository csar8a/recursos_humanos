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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    
</head>

<body>
    <div class="container" id="body_ficha">
        <div class="row" style="margin-top: 20px">
            <div class="col-4">
                <img src="<?php echo base_url(); ?>public/casa_juventud/img/logo_muni.png" alt="" class="center-img">
            </div>
            <div class="col-4">
                <h2 style="text-align: center; font-weight: bold">Ficha de Inscripción Casa de la Juventud</h2>
            </div>
            <div class="col-4">
                <h2></h2>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                        <div class="row">
                            
                            <div class="col-4">
                                <div class="form-group" id="inscripcion-container">
                                    <label for="nombre">Fecha de inscripción</label>
                                    <input type="text" class="form-control" readonly placeholder="Selecciona la fecha">
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="paternoID">Responsable de Incripción</label>
                                    <input readonly class="form-control" id="responsableID" value="<?php echo $this->session->userdata('s_nombreUsuario')?>"
                                        placeholder="Ingrese al responsable de Incripción">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="selectTipoDoc"> Telefono de Emergencia:</label>
                                    <input type="form-control" class="form-control vecino" id="emergenciaID"
                                        placeholder="Ingrese persona o numero">
                                </div>
                            </div>

                        </div>
                    </div>
                   
                </div>
                <!--    <div class="row">   
                    <div class="col-12" align="center">
                        <div class="form-group">
                            <input type="file" name="fileToUpload" id="fileToUpload">              
                            <div id='preview'>
        
                            </div> 
                        </div>
                    </div>
                </div> -->
            </div>
        </div>

        <!-- 2do card Datos del joven -->

        <div class="card">
            <div class="card-body">
                <h4 class="titleCrd">Datos del Joven</h4>

                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="selectTipoDoc">Documento</label>
                            <select class="form-control" id="selectTipoDoc">
                                <option value="">Seleccione un tipo de documento</option>
                                <?php echo $combo_tipodoc?>
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group doc">
                            <label id="documentoLb" for="documentoID">N° de documento</label>
                            <input class="form-control" id="documentoID" name="documento"
                                onkeydown="limpiarDatosPersona()" aria-describedby="nombreHelp"
                                placeholder="Ingrese número de documento" maxlength="20">
                        </div>
                    </div>
                    
                    <div class="col-3">
                        <div class="form-group">
                            <label for="btnBuscar" style="opacity: 0;">Búsqueda</label>
                            <button id="btnBuscar" onclick="buscarPersona()" type="button" class="btn btn-primary form-control" style="width: inherit; display: block;">Buscar</button>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group" id="fechanacjov-container">
                            <label for="nombre">Fecha de nacimiento</label>
                            <input id="FechaNacimientoID" type="text" class="form-control" readonly placeholder="Selecciona la fecha">
                        </div>
                    </div>

                    

                    <div class="col-md-4">
                        <label for="nombre">Sexo</label>
                        <div class="form-group">
                            <label class="radio-inline">
                                <input id="SexoID" class="sexoJoven" type="radio" value="M" name="sexoJoven">M
                            </label>
                            <label class="radio-inline" style="margin-left: 20px;">
                                <input id="SexoID" class="sexoJoven" type="radio" value="F" name="sexoJoven">F
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="paternoID">Apellido Paterno</label>
                            <input class="form-control vecino" id="paternoID" maxlength="20" placeholder="Ingrese su apellido paterno">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="maternoID">Apellido Materno</label>
                            <input type="form-control" class="form-control vecino" maxlength="20" id="maternoID"
                                placeholder="Ingrese su apellido materno">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nombresID">Nombres</label>
                            <input type="form-control" class="form-control vecino" maxlength="30" id="nombresID"
                                placeholder="Ingrese sus Nombres">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="telefonoID">Teléfono</label>
                            <input class="form-control vecino" id="telefonoID" maxlength="30"  placeholder="Ingrese teléfono">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="celularID">Celular</label>
                            <input class="form-control vecino" id="celularID" maxlength="30"  placeholder="Ingrese celular">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="correoID">Correo electrónico</label>
                            <input type="email" class="form-control vecino" maxlength="100" id="correoID"
                                placeholder="Ingrese correo electrónico">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="selectTipoDoc">Estado civil</label>
                            <select class="form-control" id="selectEstadoCivil">
                                <option value="">Seleccione un tipo</option>
                                <?php echo $combo_estado_civil?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="telefonoID">Grado de instrucci&oacute;n</label>
                            <input class="form-control vecino" id="gradoInstruccionID" maxlength="50"
                                placeholder="Ingrese grado de instrucci&oacute;n">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="correoID">Ocupaci&oacute;n</label>
                            <input type="email" class="form-control vecino" id="ocupacionID" maxlength="150"
                                placeholder="Ingrese ocupaci&oacute;n">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="selectTipoDoc">Centro de estudios o trabajo</label>
                            <input type="form-control" class="form-control vecino" id="centroEstudioID" maxlength="180"
                                placeholder="Ingrese centro de estudios o trabajo">
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- 2do card Datos de domicilio -->

        <div class="card">
            <div class="card-body">
                <h4 class="titleCrd">Datos de domicilio</h4>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="selectDistrito">Distrito</label>
                            <select class="form-control" id="selectDistrito">
                                <option value="" selected>Seleccione distrito</option>
                                <?php echo $combo_distritos?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="viaID">Vía Pública</label>
                            <input class="form-control" id="viaID" placeholder="Ingrese vía pública" maxlength="50"> 
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="urbanizacionID">Urbanización</label>
                            <input class="form-control" id="urbanizacionID" placeholder="Ingrese urbanización" maxlength="50">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="numeroID">Número</label>
                            <input type="email" class="form-control" id="numeroID" placeholder="Ingrese número" maxlength="10">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="interiorID">Interior</label>
                            <input type="email" class="form-control" id="interiorID" placeholder="Ingrese interior" maxlength="10">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="manzanaID">Manzana</label>
                            <input type="email" class="form-control" id="manzanaID" placeholder="Ingrese manzana" maxlength="10">
                        </div>
                    </div>


                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="loteID">Lote</label>
                            <input type="email" class="form-control" id="loteID" placeholder="Ingrese lote" maxlength="10">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>
        <!-- 3er card  Apoderado -->
        

        <div class="card">
            <div class="card-body">
                <h4 class="titleCrd">Datos del Apoderado</h4>

                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="selectTipoDoc">Documento</label>
                            <select class="form-control" id="selectTipoDocApoderado">
                                <option value="">Seleccione un tipo de documento</option>
                                <?php echo $combo_tipodoc?>
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group doc">
                            <label id="documentoLb" for="documentoID">N° de documento</label>
                            <input class="form-control" id="documentoApoderadoID" name="documento" maxlength="20"
                                aria-describedby="nombreHelp" placeholder="Ingrese número de documento">
                        </div>
                    </div>
                    <div class="col-3">
                            <div class="form-group">
                                <label for="btnBuscar" style="opacity: 0;">Búsqueda</label>
                                <button id="btnBuscar" onclick="buscarApoderado()" type="button"
                                    class="btn btn-primary form-control" style="width: inherit;display: block;"
                                    >Buscar</button>
                            </div>
                        </div>

                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group" id="fechaNacApoderado-container">
                            <label for="nombre">Fecha de nacimiento</label>
                            <input id="FechaNacimientoAID" type="text" class="form-control" readonly placeholder="Selecciona la fecha">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="nombre">Sexo</label>
                        <div class="form-group">
                            <label class="radio-inline">
                                <input id="sexoApoderado" class="sexoApoderado" type="radio" value="M" name="sexoApoderado">M
                            </label>
                            <label class="radio-inline" style="margin-left: 20px;">
                                <input id="sexoApoderado" class="sexoApoderado" type="radio" value="F" name="sexoApoderado">F
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="paternoID">Apellido Paterno</label>
                            <input class="form-control vecino" id="paternoApoderadoID" maxlength="20"
                                placeholder="Ingrese su apellido paterno">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="maternoID">Apellido Materno</label>
                            <input type="form-control" class="form-control vecino" id="maternoApoderadoID" maxlength="20"
                                placeholder="Ingrese su apellido materno">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nombresID">Nombres</label>
                            <input type="form-control" class="form-control vecino" id="nombresApoderadoID" maxlength="30"
                                placeholder="Ingrese sus Nombres">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="telefonoID">Teléfono</label>
                            <input class="form-control vecino" id="telefonoApoderadoID"  maxlength="30" placeholder="Ingrese teléfono">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="telefonoID">Celular</label>
                            <input class="form-control vecino" id="celularApoderadoID" maxlength="30" placeholder="Ingrese celular">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="correoID">Correo electrónico</label>
                            <input type="email" class="form-control vecino" maxlength="100" id="correoApoderadoID"
                                placeholder="Ingrese correo electrónico">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="selectTipoDoc">Estado civil</label>
                            <select class="form-control" id="selectEstadoCivilApoderado">
                                <option value="">Seleccione un tipo</option>
                                <?php echo $combo_estado_civil?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="telefonoID">Grado de instrucci&oacute;n</label>
                            <input class="form-control vecino" id="gradoApoderadoID" maxlength="50"
                                placeholder="Ingrese grado de instrucci&oacute;n">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="correoID">Ocupaci&oacute;n</label>
                            <input type="email" class="form-control vecino" id="ocupacionApoderadoID" maxlength="150"
                                placeholder="Ingrese ocupaci&oacute;n">
                        </div>
                    </div>
                </div>
            </div>
        </div>

       

       

        <!-- 5to card CODIGO DE SEGURIDAD -->


        <div class="card">
            <div class="card-body">
                <div class="row" style="float: right; margin-top: 20px">    
                    <div class="col-12">
                        <button id="btnInsertar" href="<?php echo base_url(); ?>admin_casa_juventud" type="button" style="background-color: #2598cd !important;" class="btn btn-info"
                            onclick="insertarFicha()">Enviar</button>
                    </div>
                </div>
                
            </div>
        </div>
    </div>


    <!-- Scripts -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="<?php echo base_url(); ?>public/utils/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/utils/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>public/casa_juventud/js/casa_juventud.js"></script>
    <script src="<?php echo base_url();?>public/utils/js/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo base_url(); ?>public/utils/js/utils.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

    <script type="text/javascript">
        $('#inscripcion-container input').datepicker({
            format: 'dd/mm/yyyy',
            startDate: '01/01/2000',
            endDate: '01/01/2050',
            autoclose: true
        });
        function printDiv(body_ficha){
			var printContents = document.getElementById('body_ficha').innerHTML;
			var originalContents = document.body.innerHTML;
			document.body.innerHTML = printContents;
			window.print();
			document.body.innerHTML = originalContents;
		}

        $("#inscripcion-container input").datepicker().datepicker("setDate", new Date());

        $('#fechanacjov-container input').datepicker({
            format: 'dd/mm/yyyy',
            startDate: '01/01/1970',
            endDate: '01/01/2050',
            autoclose: true
        });

        $('#fechaNacApoderado-container input').datepicker({
            format: 'dd/mm/yyyy',
            startDate: '01/01/1930',
            endDate: '01/01/2050',
            autoclose: true
        });

    </script>
    
    <script>
        var base_url = <?php echo json_encode(base_url()); ?>;
    </script>
</body>

</html>