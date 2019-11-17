<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Noticias</title>

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

.modal-full2 {
    min-width: 40%;
    margin: 8px;
    position: absolute;
}
.modal-full2 .modal-content {
    min-height: 50vh;
    min-width: 50vh;
}


.linea
{
    display: inline-block;
}

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
                <h4 style="margin-bottom: 20px">Administrar - Noticias</h4>
              
                <h6>Registra una nueva noticia haciendo click <a href="<?php echo base_url(); ?>noticias" rel="noopener noreferrer" style="color:#2699ce">aquí</a>.</h6>
                <div class="card" style="margin-top: 20px; background: #f1f1f1">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="nombre">Nombre de Noticia:</label>
                                    <input class="form-control" id="nombre" name="nombre" aria-describedby="searching" placeholder="Noticia">
                                    <small id="searching" style="display: none;" class="form-text text-muted">Buscando...</small>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                        <label for="buscarNoticias"  style="opacity: 0;">Búsqueda</label>
                                    <button id="btnBuscar" onclick="buscarNoticia()" type="button" class="btn btn-primary form-control" style="width: inherit; display: block; background-color:#79AAFF !important;">Buscar</button>
                                    <small id="searching2" style="display: none;" class="form-text text-muted">Cargando...</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div id="body_noticias" class="table-responsive"></div>
                        </div>
                    </div>
                </div>
            </div>
         </div>
    </div>

    <div class="modal" id="modal_foto_principal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Imagen Principal</h5>
                    <button  type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="limpiar()">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="card">
                        <div class="card-body">
                            <div id="body_fotop" class="table-responsive"></div>
                        </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        Modificar Imagen :
                        <input type="file" id="imagenprincipal" name="fileImagen" class="custom-file" accept="image/*">
                        </tr>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <button onclick="editArchivo()" type="button" class="btn btn-primary form-control" style="width: inherit; display: block;">Cambiar Foto</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="modal_foto_extra" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Imagen(es) Extras </h5>
                    <button  type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <table class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Imagen</th>
                                    <th>Ver</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody id="body_fotoe">
                            </tbody>
                        </table>
                        <div class="col-12">
                            <div class="form-group">
                                <input id="addFileExtra" type="file" name="fileImagen" class="custom-file" accept="image/*">
                                </tr>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <button onclick="addFotoExtra()" type="button" class="btn btn-primary form-control" style="width: inherit; display: block;">Agregar Foto</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalEditDoc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar - Datos de la Noticia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <input style="display:none" class="form-control vecino" id="idnoticia" placeholder="Ingrese titulo">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="titulo">Titulo:</label>
                                <input maxlength="150" class="form-control vecino" id="titulo" placeholder="Ingrese titulo">
                            </div>
                        </div>
                    </div>
                    <div class="row">    
                        <div class="col-8">
                            <div class="form-group">
                            <label for="extracto">Extracto (opcional):</label>
                                <input maxlength="200" class="form-control vecino" id="extracto" placeholder="Ingrese extracto (opcional)">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="descripcion">Descripción:</label>
                                <br>
                                <textarea class="form-control" rows="4" id="descripcion"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="editDatosNoticia()" id="btnEditUser">Actualizar</button>
                </div>
            </div>
        </div>
    </div>
        
    
   

    <div class="modal" id="modalVerFotoExtra" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Imagen Extra</h5>
                    <button  type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="card">
                        <div class="card-body">
                            <div id="body_ver_foto_extra" class="table-responsive"></div>
                        </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <input id="fileExtra" type="file" name="fileImagen" class="custom-file" accept="image/*">
                        </tr>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <button onclick="editFotoExtra()" type="button" class="btn btn-primary form-control" style="width: inherit; display: block;">Cambiar Foto</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url(); ?>public/utils/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/utils/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>public/intranet/js/admin_noticias.js"></script>
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