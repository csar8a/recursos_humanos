function BuscarNormas() {
    var nid_tipo = $('#tiponorma').val();
    var year     = $('#yearnorma').val();
    var nombre     = $('#nombre').val();
    var descripcion = $('#descripcion').val();

    if (nid_tipo.length == 0 && year.length == 0 && nombre.length == 0 && descripcion.length == 0 ) 
    {
        alert('Debes elegir un tipo de busqueda'); return; 
    }

    $.ajax({
        url: 'normas/C_admin_normas/BuscarNormas',
        data: {
            nid_tipo,
            year,
            nombre,
            descripcion
        },
        type: 'POST'
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            $("#body_normas").html(data.html);
        } else {
            $("#body_normas").html(null);
        }
    }).fail(function () {
        alert("error");
    });
}

function hit(e) {
    setTimeout(function(){
        var hit = $(e).closest("tr").find("td[attr='hits']");
        hit.text(parseInt(hit.text(), 10) + 1);
    }, 1000);
}

function modalEditArchivo(iddocumento, e) {
    if (iddocumento == null || e == null) {
        alert('No se puede editar en este momento');
        return;
    }
    iddoc = iddocumento;
    $.ajax({
        url: 'normas/C_admin_normas/modalEditArchivo',
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
        url: 'normas/C_admin_normas/editArchivo',
        data: formData,
        type: 'POST',
        contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
        processData: false, // NEEDED, DON'T OMIT THIS
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            $("#body_archivo").html(data.html);
            alert('Se editó el documento correctamente');
            $('#modalEditArchivo').modal('hide');
            location.reload();
        } else {
            alert(data.msj);
        }
    }).fail(function () {
        alert("error");
    });
}

function modalEditDatosNorma(idnorma, e) {
    if (idnorma == null || e == null) {
        alert('No se puede editar en este momento');
        return;
    }
    iddoc = idnorma;
    obj = e;
    $.ajax({
        url: 'normas/C_admin_normas/modalEditDatosNormas',
        data: {
            idnorma
        },
        type: 'POST'
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            $('#idnorma2').val(data.idnorma);
            $('#norma2').val(data.norma);
            $('#descripcion2').val(data.descripcion);
            $('#tipo2').val(data.tipo);
            $('#fecha2').val(data.fecha);
            $('#archivo2').val(data.archivo);
            $('#modalEditDoc').modal('show');
        }
    }).fail(function () {
        alert("error");
    });
}

function editDatosNormas(){
    var idnorma = $('#idnorma2').val().trim();
    var norma = $('#norma2').val().trim();
    var descripcion = $('#descripcion2').val().trim();
    var tipo = $('#tipo2').val().trim();
    var fecha = $('#fecha2').val().trim();
   
    if (norma.length == 0 ){
        alert('Debes especificar titulo'); return; 
    }
    var descripcion = $('#descripcion2').val().trim();
    if (descripcion.length == 0 ){
        alert('Debes especificar una descripción'); return; 
    }
    
    $.ajax({
        url: 'normas/C_admin_normas/editDatosNorma',
        data: {
            idnorma,norma,descripcion,tipo,fecha
        },
        type: 'POST'
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            $(obj).closest("tr").find("td[attr='norma']").html(norma);
            $(obj).closest("tr").find("td[attr='descnorma']").html(descripcion);
            $(obj).closest("tr").find("td[attr='fechanorma']").html(fecha);
            
            alert('Se editó correctamente');
            $('#modalEditDoc').modal('hide');
            location.reload();
            $('#btnBuscar').click();
        }
    }).fail(function () {
        alert("error");
    });
    }
