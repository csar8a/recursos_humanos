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
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/casa_juventud/css/tarjeta.css">

    <style>
        @media print {
            @page {
                margin: 0;
                
            }

            .card-footer {
                background: #2c464b !important;
                -webkit-print-color-adjust: exact;
            }
            
        }
    </style>
</head>

<body>
    <div class="container">
        <!--2c464b<canvas id="myCanvas" width="359" height="226" style="border:1px solid #000000;"></canvas>-->
        <div class="card">
            <figure class="card__figure">
                <img src="<?php echo base_url(); ?>public/utils/img/logo_bellavista.png"
                    class="card__figure--logo"></img>
            </figure>
            <p class="card__number"><?php echo $tarjeta?></p>
            <div class="card__dates">
                <span class="card__dates--first"><?php echo $dni?></span>
                <span class="card__dates--second"><?php echo $fechafin?></span>
            </div>
            <p class="card__name"><?php echo $nombre?><p>
                <div class="card__flag">
                    <?php echo $qr?>
                </div>
                <div class="card-footer" style="background: #2c464b;color: white; font-style: italic; text-align: center; padding-right: 60px; padding-top: 3px">
                        <p style="margin: 0; padding-top: 0;font-size: 0.6em">Daniel Malpartida Filio</p><p style="margin: 0; padding: 0;font-size: 0.4em">Alcalde</p>
                </div>
        </div>
    </div>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="<?php echo base_url(); ?>public/utils/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/utils/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>public/casa_juventud/js/casa_juventud.js"></script>
    <script src="<?php echo base_url(); ?>public/utils/js/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo base_url(); ?>public/utils/js/utils.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

    <script>
        var base_url = <?php echo json_encode(base_url()); ?>;
    </script>
</body>

</html>