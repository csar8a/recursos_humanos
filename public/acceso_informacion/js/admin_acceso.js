
var htmlMovs = "";
function modalVer(e){
    var idcontacto = $(e).closest("tr").data('id');
    var nomb = $(e).closest("tr").find("td[attr='nomb']").text();
    var fech = $(e).closest("tr").find("td[attr='fech']").text();
    var esta = $(e).closest("tr").find("td[attr='esta']").text();
    $('#nombID').text(nomb);
    $('#fechID').text(fech);
    $('#estaID').text(esta);
    htmlMovs = "";
    $.ajax({
        url: 'acceso_informacion/C_admin_acceso/getMensaje',
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
            $("#mensID").html(datos.TXTMENSAJE);
            $("#respID").html(datos.TXTRESPUESTA);
            $("#entregaID").html(datos.TXTFORMAENTREGA);
            
            $('#modalVer').modal('show');
        } else {
            toastr.error('Ha ocurrido un error', '', {"positionClass": "toast-top-center"}); return;
        }
    }).fail(function () {
        toastr.error('error', '', {"positionClass": "toast-top-center"}); return;
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
        toastr.error('Ha ocurrido un error', '', {"positionClass": "toast-top-center"}); return;
    }
    if(obj == null){
        toastr.error('Ha ocurrido un error', '', {"positionClass": "toast-top-center"}); return;
    }
    var objparent = $(obj).parent().parent();
    var mensaje = $('#mensajeID').val();
    if (mensaje.length == 0) { toastr.warning('Debe escribir un mensaje al área asignada', '', {"positionClass": "toast-top-center"}); return;}
    var area_asignada = $('#dependenciaSelectID').val();
    if (area_asignada.length == 0) { toastr.warning('Debe asignar una área', '', {"positionClass": "toast-top-center"}); return;}

    $.ajax({
        url: 'acceso_informacion/C_admin_acceso/asignarArea',
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
            toastr.success('Se envió al área asignada correctamente', '', {"positionClass": "toast-top-center"}); return;
        } else {
            toastr.error('Ha ocurrido un error', '', {"positionClass": "toast-top-center"}); return;
        }
    }).fail(function () {
        toastr.error('error', '', {"positionClass": "toast-top-center"}); return;
    });

}

function modalArchivar(e){
    obj = e;
    idcontacto = $(e).closest("tr").data('id');
    $('#modalArchivar').modal('show'); 
}

function archivarContacto(){
    if(idcontacto == null){
        toastr.error('Ha ocurrido un error', '', {"positionClass": "toast-top-center"}); return;
    }
    if(obj == null){
        toastr.error('Ha ocurrido un error', '', {"positionClass": "toast-top-center"}); return;
    }
    var objparent = $(obj).parent().parent();
    $.ajax({
        url: 'acceso_informacion/C_admin_acceso/archivarContacto',
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
            toastr.success('Se archivó correctamente', '', {"positionClass": "toast-top-center"}); return;
        } else {
            toastr.error('Ha ocurrido un error', '', {"positionClass": "toast-top-center"}); return;
        }
    }).fail(function () {
        toastr.error('error', '', {"positionClass": "toast-top-center"}); return;
    });
}

function modalResponder(e){
    obj = e;
    idcontacto = $(e).closest("tr").data('id');
    $('#mensajeVecino').val(null);
    $('#modalResponder').modal('show'); 
}

function responderVecino(){

    if(idcontacto == null){
        toastr.error('Ha ocurrido un error', '', {"positionClass": "toast-top-center"}); return;
    }
    if(obj == null){
        toastr.error('Ha ocurrido un error', '', {"positionClass": "toast-top-center"}); return;
    }
    var objparent = $(obj).parent().parent();
    var mensaje = $('#mensajeVecino').val();
    if (mensaje.length == 0) { toastr.warning('Debe escribir un mensaje al vecino', '', {"positionClass": "toast-top-center"}); return;}
    
    $.ajax({
        url: 'acceso_informacion/C_admin_acceso/responderVecino',
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
            toastr.success('Se respondió correctamente', '', {"positionClass": "toast-top-center"}); return;
        } else {
            toastr.error('Ha ocurrido un error', '', {"positionClass": "toast-top-center"}); return;
        }
    }).fail(function () {
        toastr.error('error', '', {"positionClass": "toast-top-center"}); return;
    });
    
}