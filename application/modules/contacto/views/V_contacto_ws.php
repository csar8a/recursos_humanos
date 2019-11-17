<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contacto-ws</title>
</head>

<body>
    <div class="wrapper">
        Has recibido una nueva llamada
    </div>
    <!-- Scripts -->
    <script src="<?php echo base_url(); ?>public/utils/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url(); ?>public/contacto/js/contactowebsocket.js"></script>
    <script src="<?php echo base_url(); ?>public/contacto/js/contactows.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            console.log('V_contacto_ws');
            setTimeout(function() {
                var llamada = <?php echo $llamada ?>;
                ws(llamada);
            }, 3000);
        });
    </script>
</body>

</html>