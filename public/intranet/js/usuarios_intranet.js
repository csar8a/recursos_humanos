function buscarUsuarioNombre(){
    $("#body_usuarios_busqueda").html(null);
    var nombres  = $('#nombresBusquedaID').val().trim();
    if (nombres.length == 0) { alert('Debe escribir un nombre'); return; }
    if (nombres.length < 3) { alert('Debe escribir más de 2 letras'); return; }
    $.ajax({
        url: 'intranet/C_usuarios_intranet/buscarUsuarioNombre',
        data: {
            nombres
        },
        type: 'POST'
    }).done(function (response) {
        let data = JSON.parse(response);   
        if (data.error == 0) {
            $("#body_usuarios_busqueda").html(data.html);
        }
    }).fail(function () {
        alert("error");
    });
}

function estadoUsuario(user,e){
    if(user == null || e == null){
        alert('No se puede editar en este momento');
        return;
    }
    var obj = $(e).closest('input');
    var flg = obj.is(':checked') ? 1 : 0;
    $.ajax({
        url: 'intranet/C_usuarios_intranet/estadoUsuario',
        data: {
            user,
            flg
        },
        type: 'POST'
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            alert('El usuario se editó correctamente');
        } else {
            alert(data.msj);
        }
    }).fail(function () {
        alert("error");
    });
}

function modalRegUser(){
    limpiarModalUser();
    $("#selectTipoDoc").prop('disabled', false);
    $("#documentoID").prop('disabled', false);
    $("#usuarioID").prop('disabled', false);
    $('#row_area').show();
    $('#btnEditUser').text('Registrar usuario');
    $("#btnEditUser").attr("onclick","registrarUsuario()");
    $('#modalEditUser').modal('show');
}

function registrarUsuario() {
    var apellidos  = $('#apellidosID').val().trim();
    var nombres    = $('#nombresID').val().trim();
    var usuario    = $('#usuarioID').val().trim();
    var password   = $('#passwordID').val().trim();
    var telefono   = $('#telefonoID').val();
    var correo     = $('#correoID').val();
    
    if (apellidos.length == 0) { alert('No debe dejar vacío el campo de apellidos'); return; }
    if (nombres.length == 0) { alert('No debe dejar vacío el campo de nombres'); return; }
    if (usuario.length == 0) { alert('No debe dejar vacío el campo de usuario'); return; }
    if (password.length == 0) { alert('No debe dejar vacío el campo de contraseña'); return; }
    if (telefono.length == 0) { alert('No debe dejar vacío el campo de teléfono'); return; }
    if (correo.length == 0) { alert('No debe dejar vacío el campo de Correo'); return; }
    regexCorreo = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
    matchCorreo = correo.match(regexCorreo);
    if (matchCorreo != correo) { alert('Ingrese una dirección de correo válido'); return;}

    var fecha  = $('#fechaID input').val();
    if (fecha.length == 0) { alert('Debes elegir la fecha de nacimiento'); return; }
    var area   = $('#selectArea').val();
    if (area.length == 0) { alert('Debes elegir un área'); return; }

    $.ajax({
        url: 'intranet/C_usuarios_intranet/registrarUsuario',
        data: {
            apellidos, nombres,
            usuario, password,
            telefono,
            correo,
            fecha,
            area
        },
        type: 'POST'
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            alert('El usuario se registró correctamente');
            $('#modalEditUser').modal('hide');
        } else {
            alert(data.msj);
        }
    }).fail(function () {
        alert("error");
    });
}

var obj = null;
var idusuario = null;
function modalEditUser(user,e){
    if(user == null || e == null){
        alert('No se puede editar en este momento');
        return;
    }
    obj = e;
    idusuario = user;
    limpiarModalUser();
    $.ajax({
        url: 'intranet/C_usuarios_intranet/getDatosUsuario',
        data: {
            idusuario
        },
        type: 'POST'
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {           
            $('#apellidosID').val(data.result[0].txtapellidos);
            $('#nombresID').val(data.result[0].txtnombres);
            $('#correoID').val(data.result[0].txtcorreo);
            $('#usuarioID').val(data.result[0].txtusername);
            $('#passwordID').val(data.result[0].txtpassword);
            $('#telefonoID').val(data.result[0].txttelefono);
            $('#fechaID input').datepicker('setDate',new Date(data.result[0].danacimiento));

            $("#usuarioID").prop('disabled', true);
            $('#row_area').hide();
            $('#btnEditUser').text('Editar usuario');
            $("#btnEditUser").attr("onclick","editarUsuario()");
            $('#modalEditUser').modal('show');
        } else {
            alert('No se puede editar en este momento');
        }
    }).fail(function () {
        alert("error");
    });
}

function editarUsuario(){
    if(idusuario == null || obj == null){
        alert('No se puede editar en este momento');
        return;
    }
    var apellidos  = $('#apellidosID').val().trim();
    var nombres  = $('#nombresID').val().trim();
    var password  = $('#passwordID').val().trim();
    var telefono = $('#telefonoID').val();
    var correo   = $('#correoID').val();

    
    if (apellidos.length == 0) { alert('No debe dejar vacío el campo de apellidos'); return; }
    if (nombres.length == 0) { alert('No debe dejar vacío el campo de nombres'); return; }
    if (password.length == 0) { alert('No debe dejar vacío el campo de contraseña'); return; }
    if (telefono.length == 0) { alert('No debe dejar vacío el campo de teléfono'); return; }
    if (correo.length == 0) { alert('No debe dejar vacío el campo de Correo'); return; }
    regexCorreo = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
    matchCorreo = correo.match(regexCorreo);
    if (matchCorreo != correo) { alert('Ingrese una dirección de correo válido'); return;}

    var fecha  = $('#fechaID input').val();
    if (fecha.length == 0) { alert('Debes elegir la fecha de nacimiento'); return; }

    $.ajax({
        url: 'intranet/C_usuarios_intranet/editarUsuario',
        data: {
            idusuario,
            apellidos, nombres,
            password,
            telefono,
            correo,
            fecha
        },
        type: 'POST'
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            $(obj).closest("tr").find("td[attr='nombres']").html(nombres+' '+apellidos);
            alert('El usuario se editó correctamente');
            $('#modalEditUser').modal('hide');
        } else {
            alert(data.msj);
        }
    }).fail(function () {
        alert("error");
    });

}

function modalEditArea(user,e){
    if(user == null || e == null){
        alert('No se puede editar en este momento');
        return;
    }
    obj = e;
    idusuario = user;

    $.ajax({
        url: 'intranet/C_usuarios_intranet/modalEditArea',
        data: {
            idusuario
        },
        type: 'POST'
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            $('#areaUsuarioID').val(data.result[0].idarea);
            $('#fechaInicioID input').datepicker('setDate',new Date(data.result[0].fechainicio));
            $('#fechaFinID input').datepicker('setDate',new Date(data.result[0].fechafin));
            $('#modalEditArea').modal('show');
        } else {
            alert('No se puede editar en este momento');
        }
    }).fail(function () {
        alert("error");
    });
}


function asignarArea(){
    if(idusuario == null || obj == null){
        alert('No se puede asignar en este momento');
        return;
    }

    var idarea  = $('#areaUsuarioID').val().trim();
    if (idarea.length == 0) { alert('Debe seleccionar un area'); return; }
    var areatext  = $("#areaUsuarioID option[value='"+idarea+"']").text();

    $.ajax({
        url: 'intranet/C_usuarios_intranet/asignarArea',
        data: {
            idarea,idusuario
        },
        type: 'POST'
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            $(obj).closest("tr").find("td[attr='area']").html(areatext);
            alert('El área se asignó correctamente');
            $('#modalEditArea').modal('hide');
        } else {
            alert('No se puede asignar en este momento');
        }
    }).fail(function () {
        alert("error");
    });
}



function limpiarModalUser(){
    $('#apellidosID').val(null);
    $('#nombresID').val(null);
    $('#correoID').val(null);
    $('#usuarioID').val(null);
    $('#passwordID').val(null);
    $('#telefonoID').val(null);
    $('#fechaID input').val(null);
    $('#selectArea').val(null);
}