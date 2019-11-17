<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container" style="padding-top: 40px">
        <h1>Procedimientos TUPA</h1>
        <div class="card" style="margin-top: 40px; background: #f1f1f1">
        <div class="card-body">
            <h4>TUPA</h4>
            <form>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <div class="form-group">
                                <select class="form-control" id="moduloSelect">
                                    <option value="">Seleccione un Modulo</option>
                                    <?php echo $combo_area?>
                                </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">   
                <div class="col-10">
                    <div class="form-group">
                        <input class="form-control" id="modulo" aria-describedby="nombreHelp" placeholder="Procedimientos">
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <button type="button" class="btn btn-success">Buscar</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
        </div>

        <div class="card" style="margin-top: 40px; background: #f1f1f1">
        <div class="card-body">
            <form>
                <div class="row">
                    <div class="col-md-2" align="center">
                                <label for="informe_id">Módulo</label>  
                    </div>

                    <div class="col-md-4" align="center">
                                <label  for="informe_id">Procedimiento</label>  
                    </div>

                    <div class="col-md-2" align="center">
                                <label for="informe_id">Pago</label>  
                    </div>

                    <div class="col-md-2" align="center">
                                <label for="informe_id">Atención</label>  
                    </div>

                    <div class="col-md-2" align="center">
                                <label for="informe_id">Opción</label>  
                    </div>
                    
                </div>
            </form>
        </div>
        </div>
    </div>
    <script src="<?php echo base_url();?>public/utils/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url();?>public/js/tupa.js"></script>
</body>
</html>



