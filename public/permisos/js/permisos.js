var sistema_gral = null;
var permiso_gral = null;

function getPermisosByModulo() {
    $("#body_roles").html(null);
    var modulo = $('#selectModulo').val();
    $("#selectPermiso").html('<option value="">Seleccione un permiso</option>');
    if(modulo.length == 0){
        return;
    }
    $.ajax({
        url: 'permisos/C_permisos/getPermisosByModulo',
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
function modalConfirmarQuitarRol(rol){
    if(rol.length == 0){
        alert('Ha ocurrido un error'); return;
    }
    if(sistema_gral.length == 0 || permiso_gral.length == 0){
        alert('Ha ocurrido un error'); return;
    }
    $("#btnEliminarRol").attr("onclick","removeRolPermiso("+rol+")");
    $('#modalConfirmarQuitarRol').modal('show');
}

function removeRolPermiso(rol){
    if(rol.length == 0 || objGral == null){
        alert('Ha ocurrido un error'); return;
    }
    if(sistema_gral.length == 0 || permiso_gral.length == 0){
        alert('Ha ocurrido un error'); return;
    }
    var permiso = permiso_gral;
    $.ajax({
        url: 'permisos/C_permisos/removeRolPermiso',
        type: 'POST',
        data: {
            permiso, rol
        }
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            $("#body_roles").html(data.html);
            alert('Se quitó el rol correctamente');
            var rolColumna = "";
            var roles = $("#body_roles").find("td[attr='rol']");
            for (let index = 0; index < roles.length; index++) {
                const element = roles[index].innerHTML;
                rolColumna+= (index != 0 ? ' | ' : '') + element;
            }
            $(objGral).closest("tr").find("td[attr='roles']").html((rolColumna != "" ? rolColumna : "-"));
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

function getConfigPermisos(){
    $("#body_permisos").html(null);
    var sistema = $('#selectModulo').val();
    var permiso = $('#selectPermiso').val();
    var rol = $('#selectRolPermiso').val();
    if(sistema.length == 0 && permiso.length == 0 && rol.length == 0){
        alert('Debe seleccionar un filtro'); return;
    }
    $.ajax({
        url: 'permisos/C_permisos/getConfigPermisos',
        type: 'POST',
        data: {
            sistema,permiso,rol
        }
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            $("#body_permisos").html(data.html);
        }
    }).fail(function () {
        alert('error');
    });
}
var objGral = null;
function modalEdit(sistema,permiso,e){
    $("#body_roles").html(null);
    $('#selectRolAsignar').val(null);
    if(sistema.length == 0 || permiso.length == 0 || e == null){
        alert('Ha ocurrido un error'); return;
    }
    objGral = e;
    sistema_gral = sistema;
    permiso_gral = permiso;
    $.ajax({
        url: 'permisos/C_permisos/getRolesByPermiso',
        type: 'POST',
        data: {
            permiso
        }
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            $("#body_roles").html(data.html);
            $('#modalEditPermiso').modal('show');
        }
    }).fail(function () {
        alert('error');
    });
}

function asignarPermiso(){
    if(sistema_gral.length == 0 || permiso_gral.length == 0 || objGral == null){
        alert('Ha ocurrido un error'); return;
    }
    var permiso = permiso_gral;
    var rol = $('#selectRolAsignar').val();
    if(rol.length == 0){
        alert('Seleccione un rol'); return;
    }
    $.ajax({
        url: 'permisos/C_permisos/asignarPermiso',
        type: 'POST',
        data: {
            permiso, rol
        }
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            $("#body_roles").html(data.html);
            var roles = $("#body_roles").find("td[attr='rol']");
            var rolColumna = "";
            for (let index = 0; index < roles.length; index++) {
                const element = roles[index].innerHTML;
                rolColumna+= (index != 0 ? ' | ' : '') + element;
            }
            $(objGral).closest("tr").find("td[attr='roles']").html((rolColumna != "" ? rolColumna : "-"));
            $('#selectRolPermiso').val(null);
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
