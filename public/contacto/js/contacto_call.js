var idcontacto = null;
function guardarContacto(){
    //datos
    var paterno   = $('#paternoID').val();
    var materno   = $('#maternoID').val();
    var nombres   = $('#nombresID').val();
    var estado    = $('#selectEstado').val();
    var mensaje    = $('#mensajeID').val();
    var asunto    = $('#asuntoID').val();
    
    
    $.ajax({
        url: 'contacto/C_contacto_call/guardarContacto',
        data: {
            idcontacto, paterno, materno, nombres, estado, mensaje,asunto
        },
        type: 'POST'
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            /*var datos = data.result[0];
            var movs = JSON.parse(datos.MOVIMIENTOS);
            movs.forEach( function(valor, indice, array) {
                htmlMovs+=   "<tr>"
                            +"<td>"+(indice+1)+"</td>"
                            +"<td>"+valor.IDAREAINICIAL+"</td>"
                            +"<td>"+(valor.IDAREADERIVADA != null ? valor.IDAREADERIVADA : "-")+"</td>"
                            +"<td>"+(valor.TXTMENSAJE     != null ? valor.TXTMENSAJE     : "-")+"</td>"
                            +"<td>"+valor.FECHA+"</td>"
                        +"</tr>";
            });
            $('#body_movimientos').html(htmlMovs);
            $("#tipoID").html(datos.TIPOCONTACTO);
            $("#telfID").html(datos.TXTTELEFONO);
            $("#correoID").html(datos.TXTCORREO);
            $("#direcID").html(datos.TXTDIRECCION);
            $("#mensID").html(datos.TXTMENSAJE);
            $("#respID").html(datos.TXTRESPUESTA);
            $('#modalVer').modal('show');*/
            window.close();
            alert('Se guardó correctamente');
        } else {
            alert('Ha ocurrido un error');
        }
    }).fail(function () {
        alert('Ha ocurrido un error');
    });
}