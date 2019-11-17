<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="Ingresarport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Mantenimiento - SB</title>

    <link rel="stylesheet" href="<?php echo base_url();?>public/utils/css/bootstrap.min.css" crossorigin="anonymous">

    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/utils/css/style2dashboard.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <!-- Font Awesome JS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/utils/css/fontawesome/all.min.css">

</head>

<body>

    <div class="wrapper">
        <!-- Sidebar  -->


        <!-- Page Content  -->
        <div id="content">

            <!-- HEADER  -->
            <?php include 'header.php';?>



            <?php if((strlen($modulos_usuario) != 0 ? 1 : 2) == 2): ?>
            <div>
                <h2>Bienvenido</h2>
                <p>Solicita tu acceso a los m&oacute;dulos <a href="#" style="color: blue">aqu&iacute;.</a> </p> <br>
            </div>
            <?php else: ?>

            <div>
                <h2>Bienvenido</h2>
                <p>Seleccione el m&oacute;dulo al que desea ingresar</p> <br>
            </div>



            <?php endif ?>



            <div class="row">
                <?php echo $modulos_usuario?>
            </div>

            <!--<div class="container">
                
                
            </div>-->

        </div>
    </div>

    <script src="<?php echo base_url();?>public/utils/js/jquery-3.3.1.min.js"></script>

    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
        integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
        crossorigin="anonymous"></script>

    <script type="text/javascript" src="<?php echo base_url(); ?>public/utils/js/bootstrap.min.js"></script>

    <!-- jQuery Custom Scroller CDN -->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

</body>

</html>