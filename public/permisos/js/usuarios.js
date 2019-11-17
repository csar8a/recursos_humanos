function buscarUsuarioNombre(){
    $("#body_usuarios_busqueda").html(null);
    var nombres  = $('#nombresBusquedaID').val().trim();
    if (nombres.length == 0) { alert('Debe escribir un nombre'); return; }
    if (nombres.length < 3) { alert('Debe escribir más de 2 letras'); return; }
    $.ajax({
        url: 'permisos/C_usuarios/buscarUsuarioNombre',
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
var obj = null;
var idusuario = null;
function modalEditArea(user,e){
    if(user == null || e == null){
        alert('No se puede editar en este momento');
        return;
    }
    obj = e;
    idusuario = user;

    $.ajax({
        url: 'permisos/C_usuarios/modalEditArea',
        data: {
            idusuario
        },
        type: 'POST'
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            $('#areaUsuarioID').val(data.result[0].idarea);
            $('#fechaInicioID input').datepicker('setDate',new Date(data.result[0].fechainicio));
            console.log(data.result[0].fechafin);
            if(data.result[0].fechafin != null){
                $('#fechaFinID input').datepicker('setDate',new Date(data.result[0].fechafin));
            } else {
                $('#fechaFinID input').datepicker('setDate',null);
            }
            
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
    var fechainicio  = $('#fechaInicioID input').val();
    if (fechainicio.length == 0) { alert('Debes elegir la fecha inicio'); return; }
    var fechafin  = $('#fechaFinID input').val();
    //if (fechafin.length == 0) { alert('Debes elegir la fecha fin'); return; }
    var areatext  = $("#areaUsuarioID option[value='"+idarea+"']").text();

    $.ajax({
        url: 'permisos/C_usuarios/asignarArea',
        data: {
            idarea,idusuario,fechainicio,fechafin
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

function registrarUsuario() {
    var tipodoc = $('#selectTipoDoc').val();
    var doc     = $('#documentoID').val();
    if (tipodoc.length == 0) { alert('Debes seleccionar un tipo de documento'); return; }
    if (doc.length == 0) { alert('Debes especificar un documento'); return; }
    if (tipodoc == 3 && doc.length != 8) { alert('Para DNI debe ingresar 8 digitos'); return; }
    if (tipodoc == 4 && doc.length != 11) { alert('Para RUC debe ingresar 11 digitos'); return; }

    var apellidos  = $('#apellidosID').val().trim();
    var nombres  = $('#nombresID').val().trim();
    var usuario  = $('#usuarioID').val().trim();
    var password  = $('#passwordID').val().trim();
    var telefono = $('#telefonoID').val();
    var correo   = $('#correoID').val();

    
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
    var fecini = $('#fecIniReg').val();
    var fecfin = $('#fecFinReg').val();
    if (fecini.length == 0) { alert('Debes elegir la fecha de inicio'); return; }
    if (fecfin.length == 0) { alert('Debes elegir la fecha de fin'); return; }

    $.ajax({
        url: 'permisos/C_usuarios/registrarUsuario',
        data: {
            tipodoc, doc,
            apellidos, nombres,
            usuario, password,
            telefono,
            correo,
            fecha,
            area, fecini, fecfin
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

function modalEditUser(user,e){
    if(user == null || e == null){
        alert('No se puede editar en este momento');
        return;
    }
    obj = e;
    idusuario = user;
    limpiarModalUser();
    $.ajax({
        url: 'permisos/C_usuarios/getDatosUsuario',
        data: {
            idusuario
        },
        type: 'POST'
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {           
            $('#selectTipoDoc').val(data.result[0].tipodocumento);
            $('#documentoID').val(data.result[0].txtdocumento);
            $('#apellidosID').val(data.result[0].txtapellidos);
            $('#nombresID').val(data.result[0].txtnombres);
            $('#correoID').val(data.result[0].txtcorreo);
            $('#usuarioID').val(data.result[0].txtusername);
            $('#passwordID').val(data.result[0].txtpassword);
            $('#telefonoID').val(data.result[0].txttelefono);
            $('#fechaID input').datepicker('setDate',new Date(data.result[0].danacimiento));

            $("#selectTipoDoc").prop('disabled', true);
            $("#documentoID").prop('disabled', true);
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

function limpiarModalUser(){
    $('#selectTipoDoc').val(null);
    $('#documentoID').val(null);
    $('#apellidosID').val(null);
    $('#nombresID').val(null);
    $('#correoID').val(null);
    $('#usuarioID').val(null);
    $('#passwordID').val(null);
    $('#telefonoID').val(null);
    $('#fechaID input').val(null);
    $('#selectArea').val(null);
    $('#fecIniReg').val(null);
    $('#fecFinReg').val(null);
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
        url: 'permisos/C_usuarios/editarUsuario',
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

function estadoUsuario(user,e){
    if(user == null || e == null){
        alert('No se puede editar en este momento');
        return;
    }
    var obj = $(e).closest('input');
    var flg = obj.is(':checked') ? 1 : 0;
    $.ajax({
        url: 'permisos/C_usuarios/estadoUsuario',
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

function modalEditRol(user){
    if(user == null){
        alert('No se puede editar en este momento');
        return;
    }
    $('#selectRolAsignar').val(null);
    idusuario = user;
    $.ajax({
        url: 'permisos/C_usuarios/getRolesUsuario',
        data: {
            user
        },
        type: 'POST'
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            $("#body_roles").html(data.html);
            $('#modalEditRol').modal('show');
        } else {
            alert('No se puede editar en este momento');
        }
    }).fail(function () {
        alert("error");
    });
}

function asignarRolUsuario(){
    if(idusuario == null){
        alert('No se puede asignar en este momento');
        return;
    }
    var rol = $('#selectRolAsignar').val();
    if(rol.length == 0){
        alert('Seleccione un rol'); return;
    }
    $.ajax({
        url: 'permisos/C_usuarios/asignarRolUsuario',
        type: 'POST',
        data: {
            idusuario, rol
        }
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            $("#body_roles").html(data.html);
            $('#selectRolAsignar').val(null);
            alert('Se asignó el rol correctamente');
        } else {
            if (typeof data.msj !== 'undefined') {
                alert(data.msj);
            } else {
                alert('No se pudo asignar el rol');
            }
        }
    }).fail(function () {
        alert('error');
    });
}

function modalConfirmarQuitarRol(rol){
    if(idusuario == null){
        alert('No se puede asignar en este momento');
        return;
    }
    if(rol.length == 0){
        alert('Ha ocurrido un error'); return;
    }
    $("#btnEliminarRol").attr("onclick","removeRolUsuario("+rol+")");
    $('#modalConfirmarQuitarRol').modal('show');
}

function removeRolUsuario(rol){
    if(idusuario == null){
        alert('No se puede asignar en este momento');
        return;
    }
    if(rol.length == 0){
        alert('Ha ocurrido un error'); return;
    }
    $.ajax({
        url: 'permisos/C_usuarios/removeRolUsuario',
        type: 'POST',
        data: {
            idusuario, rol
        }
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            $("#body_roles").html(data.html);
            alert('Se quitó el rol correctamente');
            $('#modalConfirmarQuitarRol').modal('hide');
        } else {
            if (typeof data.msj !== 'undefined') {
                alert(data.msj);
            } else {
                alert('No se pudo quitar el rol');
            }
        }
    }).fail(function () {
        alert('error');
    });
}

function modalPermisos(user,e){
    if(user == null || e == null){
        alert('No se puede editar en este momento');
        return;
    }
    obj = e;
    idusuario = user;
    $('#selectModulo').val(null);
    $("#selectPermiso").html('<option value="">Seleccione un permiso</option>');
    $.ajax({
        url: 'permisos/C_usuarios/getPermisosUsuario',
        type: 'POST',
        data: {
            user
        }
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            $("#body_permisos").html(data.html);
            $('#modalPermisos').modal('show');
        }
    }).fail(function () {
        alert('error');
    });
    
}

function getPermisosByModulo() {
    $("#body_roles").html(null);
    var modulo = $('#selectModulo').val();
    $("#selectPermiso").html('<option value="">Seleccione un permiso</option>');
    if(modulo.length == 0){
        return;
    }
    $.ajax({
        url: 'permisos/C_usuarios/getPermisosByModulo',
        type: 'POST',
        data: {
            modulo
        }
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            $("#selectPermiso").html('<option value="">Seleccione un permiso</option>' + data.html);
        }
    }).fail(function () {
        alert('error');
    });
}

function asignarPermisoUsuario(){
    if(idusuario == null){
        alert('No se puede asignar en este momento');
        return;
    }
    var modulo = $('#selectModulo').val();
    var permiso = $('#selectPermiso').val();
    if(modulo.length == 0){
        alert('Seleccione un sistema'); return;
    }
    if(permiso.length == 0){
        alert('Seleccione un permiso'); return;
    }
    $.ajax({
        url: 'permisos/C_usuarios/asignarPermisoUsuario',
        type: 'POST',
        data: {
            idusuario,
            permiso
        }
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            $('#selectModulo').val(null);
            $("#selectPermiso").html('<option value="">Seleccione un permiso</option>' + data.html);
            $("#body_permisos").html(data.html);
            alert('Se asignó el permiso correctamente');
        } else {
            if (typeof data.msj !== 'undefined') {
                alert(data.msj);
            } else {
                alert('No se puede asignar en este momento');
            }
        }
    }).fail(function () {
        alert('error');
    });
}

function modalConfirmarQuitarPermiso(permiso){
    if(idusuario == null){
        alert('No se puede asignar en este momento');
        return;
    }
    if(permiso.length == 0){
        alert('Ha ocurrido un error'); return;
    }
    $("#btnEliminarPermiso").attr("onclick","removePermisoUsuario("+permiso+")");
    $('#modalConfirmarQuitarPermiso').modal('show');
}

function removePermisoUsuario(permiso){
    if(idusuario == null){
        alert('No se puede asignar en este momento');
        return;
    }
    if(permiso.length == 0){
        alert('Ha ocurrido un error'); return;
    }
    
    $.ajax({
        url: 'permisos/C_usuarios/removePermisoUsuario',
        type: 'POST',
        data: {
            idusuario,permiso
        }
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            $("#body_permisos").html(data.html);
            alert('Se quitó el permiso correctamente');
            $('#modalConfirmarQuitarPermiso').modal('hide');
        } else {
            if (typeof data.msj !== 'undefined') {
                alert(data.msj);
            } else {
                alert('No se pudo quitar el permiso');
            }
        }
    }).fail(function () {
        alert('error');
    });
}