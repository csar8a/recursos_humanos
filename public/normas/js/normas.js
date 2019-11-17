function insertarNorma() {
    /* DATOS SOLICITANTE */

    var fecha       = $('#sandbox-container input').val();

    var nid_tipo    = $('#tiponorma').val();
    var nombre      = $('#nombre').val();
    var descripcion = $('#descripcion').val();

    if (fecha.length == 0)          { alert('Debes elegir la fecha del documento'); return; }
    if (nid_tipo.length == 0)       { alert('Debes seleccionar un tipo de documento'); return; }
    if (nombre.length == 0)         { alert('No debe dejar vacío el campo de nombre'); return; }
    if (descripcion.length == 0)    { alert('No debe dejar vacío el campo descripcion'); return; }

    var formData = new FormData();
    
    formData.append('fecha', fecha);
    formData.append('nid_tipo', nid_tipo);
    formData.append('nombre', nombre);
    formData.append('descripcion', descripcion);
    formData.append('archivo', $('input[type=file]')[0].files[0]); 
    
    $.ajax({
        url: 'normas/C_normas/insertarNorma',
        data: formData,
        type: 'POST',
        contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
        processData: false, // NEEDED, DON'T OMIT THIS
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            alert('Se registró la norma correctamente');
            location.reload();
        } else {
            alert(data.msj);
        }
    }).fail(function () {
        alert("error");
    });
}