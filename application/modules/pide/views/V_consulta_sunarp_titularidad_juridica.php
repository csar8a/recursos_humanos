<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SUNARP</title>

    <link rel="stylesheet" href="<?php echo base_url(); ?>public/utils/css/bootstrap.min.css" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/utils/css/style2.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

    <!-- Font Awesome JS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/utils/css/fontawesome/all.min.css">

    <style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
  font-size: 0.8em;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
.modal-full {
    min-width: 100%;
    margin: 8px;
}
.modal-full .modal-content {
    min-height: 100vh;
    min-width: 100vh;
}

.right {
  position: absolute;
  right: 0px;
  width: 800px;
  height: 400px;
  border: 3px solid #063f5d;
  padding: 10px;
}

.linea
{
    display: inline-block;
}


/*
#my_modal2 {
    min-width: 60%;
    margin: 8px;
}

#my_modal2 .modal-full .modal-content {
    min-height: 60vh;
    min-width: 60vh;
}*/




</style>

</head>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <?php echo $this->load->view('sidebar') ?>
        <div id="content">
            <!-- HEADER  -->
            <?php echo $this->load->view('header') ?>
            <div class="container" style="padding: 20px 0 20px 0">
                <h4 style="margin-bottom: 20px">Consulta SUNARP - Titularidad de Persona Juridica</h4>

                <div class="card" style="margin-top: 20px; background: #f1f1f1">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="dni">Raz&oacute;n Social:</label>
                                    <input class="form-control" id="razonSocial" name="razonSocial" aria-describedby="searching" placeholder="Raz&oacute;n Social">
                                    <label id="codigo" for="buscarNormas"  style="opacity: 0;">Imagen</label>
                                    <small id="searching" style="display: none;" class="form-text text-muted">Buscando...</small>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                        <label for="buscarNormas"  style="opacity: 0;">Búsqueda</label>
                                    <button id="btnBuscar" onclick="BuscarSunarp()" type="button" class="btn btn-primary form-control" style="width: inherit; display: block; background-color:#79AAFF !important;">Buscar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            
                            <div id="body_consulta" class="table-responsive"></div>
                        </div>
                    </div>
                </div>
            </div>
         </div>
    </div>
    <div class="modal" id="my_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-full" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Consulta de Asientos por predio</h5>
                    <button onclick="limpiar()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body p-4" id="result">
                    <p input style="display:none;" >Numero de Partida:</p>
                    <input style="display:none" type="text" id="numpartida" name="bookId" value=""/>
                    <input style="display:none" type="text" id="numregistro" name="bookId2" value=""/>
                    <input style="display:none" type="text" id="numzona" name="bookId3" value=""/>
                    <input style="display:none" type="text" id="numoficina" name="bookId4" value=""/>
                    
                        
                    <div class="row">    
                        <div class="col-4">
                            <div id="body_asientos" class="table-responsive"></div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="buscarNormas"  style="opacity: 0;">Imagen</label>
                                    <button id="btnBuscar" onclick="VerAsiento()" type="button" class="btn btn-primary form-control" style="width: inherit; display: block; background-color:#79AAFF !important;">Ver</button>
                                    <small id="searching2" style="display: none;" class="form-text text-muted">Cargando...</small>
                                </div>
                            </div>

                        </div>
                        
                        <div class="col-8">
                            <div class="row">
                                <div class="col-4">
                                    <button type="button" onclick="javascript:imprim1(body_foto);" class="btn btn-primary form-control" style="width: inherit; display: block; background-color:#79AAFF !important;" >Guardar / Imprimir</button>    
                                </div>
                            </div>
                             <br>
                            
                            <div id="body_foto" class="right"></div>
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="limpiar()" class="btn btn-secondary" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
    
   
    <script src="<?php echo base_url(); ?>public/utils/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/utils/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>public/pide/js/consulta_sunarp_titularidad_juridica.js"></script>
    <script src="<?php echo base_url(); ?>public/utils/js/utils.js"></script>

    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
        integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
        crossorigin="anonymous"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

    <script type="text/javascript">

        function imprim1(body_foto){
        var printContents = document.getElementById('body_foto').innerHTML;
                w = window.open();
                w.document.write(printContents);
                w.document.close(); // necessary for IE >= 10
                w.focus(); // necessary for IE >= 10
                w.print();
                w.close();
                return true;}

        $('#my_modal').on('show.bs.modal', function(e) {
            var bookId = $(e.relatedTarget).data('book-id');
            var bookId2 = $(e.relatedTarget).data('book-id2');
            var bookId3 = $(e.relatedTarget).data('book-id3');       
            var bookId5 = $(e.relatedTarget).data('book-id5');

            $(e.currentTarget).find('input[name="bookId"]').val(bookId);
            $(e.currentTarget).find('input[name="bookId3"]').val(bookId3);
            $(e.currentTarget).find('input[name="bookId5"]').val(bookId5);
        });


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