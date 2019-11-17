var htmlMovs = "";
function modalVer(e){
    var idcontacto = $(e).closest("tr").data('id');
    var nomb = $(e).closest("tr").find("td[attr='nomb']").text();
    var asun = $(e).closest("tr").find("td[attr='asun']").text();
    var fech = $(e).closest("tr").find("td[attr='fech']").text();
    var esta = $(e).closest("tr").find("td[attr='esta']").text();
    $('#nombID').text(nomb);
    $('#asunID').text(asun);
    $('#fechID').text(fech);
    $('#estaID').text(esta);
    htmlMovs = "";
    $.ajax({
        url: 'libro_reclamaciones/C_admin_reclamos/getMensaje',
        data: {
            idcontacto 
        },
        type: 'POST'
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            var datos = data.result[0];
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
            $("#telfID").html(datos.TXTTELEFONO);
            $("#correoID").html(datos.TXTCORREO);
            $("#direcID").html(datos.TXTDIRECCION);
            $("#respID").html(datos.TXTRESPUESTA);
            $('#modalVer').modal('show');
        } else {
            toastr.error('Ha ocurrido un error', '', {"positionClass": "toast-top-center"}); return;
        }
    }).fail(function () {
        alert("error");
    });
}
var idcontacto = null;
var obj = null;
function modalEnviar(e){
    obj = e;
    idcontacto = $(e).closest("tr").data('id');
    $('#mensajeID').val(null);
    $('#dependenciaSelectID').val(null);
    $('#modalEnviar').modal('show'); 
}

function asignarArea(){
    if(idcontacto == null){
        alert('Ha ocurrido un error'); return;
    }
    if(obj == null){
        alert('Ha ocurrido un error'); return;
    }
    var objparent = $(obj).parent().parent();
    var mensaje = $('#mensajeID').val();
    if (mensaje.length == 0) { alert('Debe escribir un mensaje al área asignada.'); return; }
    var area_asignada = $('#dependenciaSelectID').val();
    if (area_asignada.length == 0) { alert('Debe asignar una área'); return; }

    $.ajax({
        url: 'libro_reclamaciones/C_admin_reclamos/asignarArea',
        data: {
            idcontacto: idcontacto,
            mensaje: mensaje,
            area_asignada: area_asignada
        },
        type: 'POST'
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            $('#modalEnviar').modal('hide'); 
            $(obj).closest("tr").find("td[attr='esta']").html("<div class='badge badge-primary'>ASIGNADO</div>");
            objparent.find('.btn-archivar').remove();
            objparent.find('.btn-enviar').remove();
            objparent.find('.btn-responder').remove();
            alert('Se envió al área asignada correctamente');
        } else {
            alert('Ha ocurrido un error');
        }
    }).fail(function () {
        alert("error");
    });

}

function modalArchivar(e){
    obj = e;
    idcontacto = $(e).closest("tr").data('id');
    $('#modalArchivar').modal('show'); 
}

function archivarContacto(){
    if(idcontacto == null){
        alert('Ha ocurrido un error'); return;
    }
    if(obj == null){
        alert('Ha ocurrido un error'); return;
    }
    var objparent = $(obj).parent().parent();
    $.ajax({
        url: 'libro_reclamaciones/C_admin_reclamos/archivarContacto',
        data: {
            idcontacto: idcontacto
        },
        type: 'POST'
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            $('#modalArchivar').modal('hide');
            $(obj).closest("tr").find("td[attr='esta']").html("<div class='badge badge-danger'>ARCHIVADO</div>");
            objparent.find('.btn-archivar').remove();
            objparent.find('.btn-enviar').remove();
            objparent.find('.btn-responder').remove();
            alert('Se archivó correctamente');
        } else {
            alert('Ha ocurrido un error');
        }
    }).fail(function () {
        alert("error");
    });
}

function modalResponder(e){
    obj = e;
    idcontacto = $(e).closest("tr").data('id');
    $('#mensajeVecino').val(null);
    $('#modalResponder').modal('show'); 
}

function responderVecino(){
    console.log('entro');
    if(idcontacto == null){
        alert('Ha ocurrido un error'); return;
    }
    if(obj == null){
        alert('Ha ocurrido un error'); return;
    }
    var objparent = $(obj).parent().parent();
    var mensaje = $('#mensajeVecino').val();
    if (mensaje.length == 0) { alert('Debe escribir un mensaje al vecino.'); return; }
    
    $.ajax({
        url: 'libro_reclamaciones/C_admin_reclamos/responderVecino',
        data: {
            idcontacto: idcontacto,
            mensaje: mensaje
        },
        type: 'POST'
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            $('#modalResponder').modal('hide');
            $(obj).closest("tr").find("td[attr='esta']").html("<div class='badge badge-warning'>RESPONDIDO</div>");
            objparent.find('.btn-archivar').remove();
            objparent.find('.btn-enviar').remove();
            objparent.find('.btn-responder').remove();
            alert('Se respondió correctamente');
        } else {
            alert('Ha ocurrido un error');
        }
    }).fail(function () {
        alert("error");
    });
    
}