<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="generator" content="Jekyll v3.8.5">
  <title>Mantenimiento - Login</title>
  <link rel="stylesheet" href="<?php echo base_url(); ?>public/utils/css/bootstrap.min.css">
  <link href="<?php echo base_url(); ?>public/utils/css/signin.css" rel="stylesheet">

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>
  <!-- Custom styles for this template -->

</head>

<body class="text-center">
  <div class="form-signin">
  <img src="<?php echo base_url(); ?>public/utils/img/logo_bellavista.png" alt="logo" width="200px" height="85px">
    <h1 class="h3 mb-3 font-weight-normal">Mantenimiento Sistema Bellavista</h1>
    <label for="usuarioID" class="sr-only">Usuario</label>
    <input type="email" id="usuarioID" class="form-control" placeholder="Usuario" required autofocus>
    <label for="passwordID" class="sr-only">Contrase&ntilde;a</label>
    <input type="password" id="passwordID" class="form-control" placeholder="Contrase&ntilde;a" required>
    <button class="btn btn-lg btn-primary btn-block" style="background:#79AAFF" onclick="loguear()">Iniciar
      sesi&oacute;n</button>
    
  </div>
  <script src="<?php echo base_url(); ?>public/utils/js/jquery-3.3.1.min.js"></script>
  <script src="<?php echo base_url(); ?>public/utils/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>public/utils/js/login.js"></script>
  <script>
    var base_url = <?php echo json_encode(base_url()); ?>;
  </script>
</body>
</html>