<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PIDE</title>

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
            <div class="container" style="padding: 20px 0">
                
                <div class="row">
                    
                    
                        
                        <div class="col-md-7">
                                <h4 style="margin-bottom: 20px">Sistemas de Consulta PIDE</h4>
                            <p style="text-align: justify">El "Sistema de Consulta PIDE" consume la "Plataforma de Interoperabilidad del Estado - PIDE"
                                que fue creado mediante Decreto Supremo N° 083-2011-PCM, la PIDE es una infraestructura
                                tecnológica que permite la implementación de servicios públicos en línea, por medios
                                electrónicos y el intercambio electrónico de datos entre entidades del Estado a través de
                                internet, telefonía móvil y otros medios tecnológicos disponibles y tiene por finalidad el
                                intercambio electrónico de datos entre entidades públicas. </p>
                            <hr>
                            <p style="text-align: justify">Para solicitar el acceso al sistema, favor de comunicarse con la Oficina de Tecnologías de la
                                Información. El "Sistema de Consulta PIDE" implementa los siguientes servicios:</p>
                            <ul style="color: #ababab">
                                <li>Contrato de Web Service RENIEC / WS5 – Consulta de DNI</li>
                                <li>Contrato de WebService SUNEDU | WS3 – Consulta Grados y Títulos</li>
                                <li>Contrato de WebService PNP | WS3 – Consulta Antecedentes Policiales</li>
                                <li>Contrato de WebService PJ | WS3 – Consulta Antecedentes Penales</li>
                                <li>Contrato de WebService INPE | WS3 – Consulta Antecedentes Judiciales</li>
                                <li>Contrato de WebService SUNAT | WS3 – Consulta RUC</li>
                                <li>Contrato de WebService SUNARP | WS3 – Consulta Titularidad</li>
                                <li>Contrato de WebService MIGRACIONES | WS3 Consulta de Carnet Extranjería</li>
                                <li>Contrato de WebService MINEDU | Grados y Títulos de Institutos Tecnológicos y
                                    Pedagógicos por DNI</li>
                            </ul>
                            <hr>
                            <p style="text-align: justify"> El "Sistema de Consulta PIDE" contempla bitácoras de acceso y uso del servicio. </p>
    
                        </div>
                        <div class="col-md-5 text-center">
                                <span style="display: inline-block;height: 100%;vertical-align: middle;"></span>
                                <img src="<?php echo base_url(); ?>public/utils/img/interoperar.png" width="350px" alt="logo" style="vertical-align: middle;">
                        </div>
                    
    
                </div>
                
            </div>
        </div>
    </div>
    <script src="<?php echo base_url();?>public/utils/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/utils/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>public/utils/js/utils.js"></script>

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