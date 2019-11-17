function insertarDocumento() {
    /* DATOS SOLICITANTE */
    //var area        = $('#selectArea').val();
    var titulo      = $('#tituloDoc').val();
    var descripcion = $('#descDocumento').val();
    var tipo = $('#selectTipo').val();

    //if (area.length == 0)           { alert('Debes seleccionar un área'); return; }
    if (titulo.length == 0)         { alert('No debe dejar vacío el campo de título'); return; }
    if (tipo.length == 0)           { alert('No debe dejar vacío el campo tipo'); return; }
    if (descripcion.length == 0)    { alert('No debe dejar vacío el campo descripcion'); return; }
    if ($('input[type=file]')[0].files[0] == null) {
        alert("Debe seleccionar un archivo");
        return;
    }
    var formData = new FormData();
    formData.append('titulo', titulo);
    formData.append('tipo', tipo);
    formData.append('descripcion', descripcion);
    formData.append('archivo', $('input[type=file]')[0].files[0]);
    
    $.ajax({
        url: 'intranet/C_documentos/insertarDocumento',
        data: formData,
        type: 'POST',
        contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
        processData: false, // NEEDED, DON'T OMIT THIS
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            alert('Se registró el documento correctamente');
            location.reload();
        } else {
            alert(data.msj);
        }
    }).fail(function () {
        alert("error");
    });
}