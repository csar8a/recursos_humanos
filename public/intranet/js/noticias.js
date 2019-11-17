function insertarNoticia() {
    /* DATOS SOLICITANTE */
    
    var titulo          = $('#tituloNoticia').val();
    var descripcion     = $('#descNoticia').val();
    var extracto        = $('#extracto').val();
    var fotoprincipal = $('#principal').val();
    var fotosextras = $('#extras').val();
    

   
    if (titulo.length == 0)         { alert('No debe dejar vacío el campo de título'); return; }
    if (descripcion.length == 0)    { alert('No debe dejar vacío el campo descripcion'); return; }
    if (fotoprincipal.length == 0)    { alert('Debe seleccionar una imagen principal'); return; }
    //if (fotosextras.length == 0)    { alert('Debe seleccionar al menos una imagen extra'); return; }

    var formData = new FormData();
    
    formData.append('titulo', titulo);
    formData.append('descripcion', descripcion);
    formData.append('extracto', extracto);

    
    
    formData.append('archivo', $('input[name=principal]')[0].files[0]);
    for(var i = 0; i<$('input[name=extras]')[0].files.length; i++){
        formData.append('archivo'+(i+1), $('input[name=extras]')[0].files[i]);
    }
    
    $.ajax({
        url: 'intranet/C_noticias/insertarNoticia',
        data: formData,
        type: 'POST',
        contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
        processData: false, // NEEDED, DON'T OMIT THIS
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            alert('Se registró la noticia correctamente');
            location.reload();
        } else {
            alert(data.msj);
        }
    }).fail(function () {
        alert("error");
    });
}