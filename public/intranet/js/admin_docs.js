var iddoc = null
var obj = null;
function modalEditDoc(iddocumento, e) {
    if (iddocumento == null || e == null) {
        alert('No se puede editar en este momento');
        return;
    }
    iddoc = iddocumento;
    obj = e;
    $.ajax({
        url: 'intranet/C_admin_docs/modalEditArchivo',
        data: {
            iddocumento
        },
        type: 'POST'
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            $('#nombreID').val(data.nombre);
            $('#descID').val(data.desc);
            $('#selectTipo').val(data.idtipo);
            $('#modalEditDoc').modal('show');
        }
    }).fail(function () {
        alert("error");
    });
}

function editDatosDoc() {
    if (iddoc == null && obj == null) {
        alert('No se puede editar en este momento');
        return;
    }
    var nombre = $('#nombreID').val().trim();
    if (nombre.length == 0) {
        alert('Debes especificar un nombre'); return;
    }
    var desc = $('#descID').val().trim();
    if (desc.length == 0) {
        alert('Debes especificar una descripción'); return;
    }
    var idtipo = $('#selectTipo').val();
    if (idtipo.length == 0) {
        alert('Debes especificar un tipo'); return;
    }
    var tipotext = $("#selectTipo option[value='" + idtipo + "']").text();
    $.ajax({
        url: 'intranet/C_admin_docs/editDatosDoc',
        data: {
            iddoc, nombre, desc, idtipo
        },
        type: 'POST'
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            $(obj).closest("tr").find("td[attr='nombre']").html(nombre);
            $(obj).closest("tr").find("td[attr='desc']").html(desc);
            $(obj).closest("tr").find("td[attr='tipo']").html(tipotext);
            alert('Se editó correctamente');
            $('#modalEditDoc').modal('hide');
        }
    }).fail(function () {
        alert("error");
    });
}

function modalEditArchivo(iddocumento, e) {
    if (iddocumento == null || e == null) {
        alert('No se puede editar en este momento');
        return;
    }
    iddoc = iddocumento;
    $.ajax({
        url: 'intranet/C_admin_docs/modalEditArchivo',
        data: {
            iddocumento
        },
        type: 'POST'
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            $("#body_archivo").html(data.html);
            $('#modalEditArchivo').modal('show');
        }
    }).fail(function () {
        alert("error");
    });
}

function editArchivo() {
    if (iddoc == null) {
        alert('No se puede editar en este momento');
        return;
    }
    if ($('input[type=file]')[0].files[0] == null) {
        alert("Debe seleccionar un archivo");
        return;
    }
    var formData = new FormData();
    formData.append('iddocumento', iddoc);
    formData.append('archivo', $('input[type=file]')[0].files[0]);
    $.ajax({
        url: 'intranet/C_admin_docs/editArchivo',
        data: formData,
        type: 'POST',
        contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
        processData: false, // NEEDED, DON'T OMIT THIS
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            $("#body_archivo").html(data.html);
            alert('Se editó el documento correctamente');
        } else {
            alert(data.msj);
        }
    }).fail(function () {
        alert("error");
    });
}

function buscarDocumento() {
    $("#body_docs").html(null);
    var documento = $('#documento').val();
    var idtipo = $('#selectTipoFiltro').val();
    var fecha = $('#sandbox-container input').val();

    $
        .ajax({
            url: 'intranet/C_admin_docs/filtrarDocumento',
            type: 'POST',
            data: {
                documento,
                fecha,
                idtipo
            }
        })
        .done(function (response) {
            let data = JSON.parse(response);

            if (data.error == 0) {
                $("#body_docs").html(data.html);
            } else {
                $("#body_docs").html(data.html);
            }
        })
        .fail(function () {
            alert("error");
        });
}

$('#documento').keyup(function (e) {
    buscarDocumento();
});