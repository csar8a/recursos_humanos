
function modalVer(e){
    var idcontacto = $(e).closest("tr").data('id');
    var nomb = $(e).closest("tr").find("td[attr='nomb']").text();
    var fech = $(e).closest("tr").find("td[attr='fech']").text();
    var esta = $(e).closest("tr").find("td[attr='esta']").text();
    $('#nombID').text(nomb);
    $('#fechID').text(fech);
    $('#estaID').text(esta);
    $.ajax({
        url: 'audiencias/C_admin_audiencias/getMensaje',
        data: {
            idcontacto 
        },
        type: 'POST'
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            var datos = data.result[0];
            $("#telfID").html(datos.TXTTELEFONO);
            $("#correoID").html(datos.TXTCORREO);
            $("#direcID").html(datos.TXTDIRECCION);
            $("#mensID").html(datos.TXTMENSAJE);
            $("#respID").html(datos.TXTRESPUESTA);
            var fechTen = new Date(datos.DAFECHATENTATIVA);
            var fechTen = fechTen.getDate()+"/"+(fechTen.getMonth()+1)+"/"+fechTen.getFullYear();
            $("#fechtenID").html(fechTen);

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
        url: 'audiencias/C_admin_audiencias/asignarArea',
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
        url: 'audiencias/C_admin_audiencias/archivarContacto',
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
        url: 'audiencias/C_admin_audiencias/responderVecino',
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