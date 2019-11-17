var ideve = null;
var obj = null;

function modalEditEvento(idevento, e){
    if (idevento.length == 0 || e.length == 0){
        alert('No se puede actualizar en este momento'); return; 
    }
    ideve = idevento;
    obj = e;
    $.ajax({
        url: 'intranet/C_admin_eventos/modalEditEvento',
        data: {
            idevento
        },
        type: 'POST'
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            var evento = data.result[0];
            //console.log(evento);
            $('#tituloEvento').val(evento.txttitulo);
            $('#descEvento').val(evento.txtdescripcion);
            $('#locacionEvento').val(evento.txtlocacion);
            $('#categoriaEvento').val(evento.idcategoria);
            $('#costoEvento').val(evento.txtcosto);
            $('#contactoEvento').val(evento.txtcontacto);

            $('#fechainicio').datepicker('setDate',new Date(GetFormattedDate(evento.fechainicio)));
            $('#fechafin').datepicker('setDate',new Date(GetFormattedDate(evento.fechafin)));
            $('#horainicio').timepicker('setTime', new Date(GetFormattedDate(evento.fechainicio)));
            $('#horafin').timepicker('setTime', new Date(GetFormattedDate(evento.fechafin)));
            $('#tagsEvento').val(evento.txttags);
            tags = evento.txttags.split(".");

            $('#modalEditEvento').modal('show');
        }
    }).fail(function () {
        alert("error");
    });
}

function editDatosEvento(){
    if (ideve.length == 0 || obj.length == 0 ){
        alert('No se puede actualizar en este momento'); return; 
    }
    var titulo      = $('#tituloEvento').val();
    var descripcion = $('#descEvento').val();
    var lugar       = $('#locacionEvento').val();
    var categoria   = $('#categoriaEvento').val();
    var costo       = $('#costoEvento').val();
    var contacto    = $('#contactoEvento').val();
    var fechainicio = $('#fechainicio').val();
    var fechafin    = $('#fechafin').val();
    var horainicio  = $('#horainicio').val();
    var horafin     = $('#horafin').val();
    var tagsEvento  = tags.join(";");
    if (titulo.length == 0)       { alert('No debe dejar vacío el campo de título'); return; }
    if (descripcion.length == 0)  { alert('No debe dejar vacío el campo descripcion'); return; }

    if (lugar.length == 0)     { alert('No debe dejar vacío el campo de lugar'); return; }
    if (categoria.length == 0) { alert('No debe dejar vacío el campo de categoría'); return; }

    if (costo.length == 0)     { alert('No debe dejar vacío el campo de costo'); return; }
    if (!validarCosto(costo))  { alert('Ingrese un precio correcto'); return; }
    if (contacto.length == 0)  { alert('No debe dejar vacío el campo de contacto'); return; }

    if (fechainicio.length == 0)  { alert('No debe dejar vacío el campo de fecha inicio'); return; }
    if (horainicio.length == 0)   { alert('No debe dejar vacío el campo de hora inicio'); return; }
    if (fechafin.length == 0)     { alert('No debe dejar vacío el campo de fecha fin'); return; }
    if (horafin.length == 0)      { alert('No debe dejar vacío el campo de hora fin'); return; }
    var fec1 = new Date(GetFormattedDate(fechainicio) + ' ' + horainicio);
    var fec2 = new Date(GetFormattedDate(fechafin)    + ' ' + horafin);
    if (!compare_dates(fec1,fec2))   { alert('Debe colocar colocar fecha y hora de fin del evento después del inicio del evento.'); return; }

    if (tagsEvento.length == 0)   { alert('Debe indicar palabras clave del evento'); return; }
    
    $.ajax({
        url: 'intranet/C_admin_eventos/editEvento',
        data: {
            idevento : ideve,
            titulo,descripcion,lugar,categoria,
            costo,contacto,
            fechainicio:fechainicio+' '+horainicio,
            fechafin:fechafin+' '+horafin,
            tagsEvento
        },
        type: 'POST'
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            $(obj).closest("tr").find("td[attr='nombre']").html(titulo);
            $(obj).closest("tr").find("td[attr='desc']").html(descripcion);
            $(obj).closest("tr").find("td[attr='fecinicio']").html(fechainicio+' '+horainicio);
            $(obj).closest("tr").find("td[attr='fecfin']").html(fechafin+' '+horafin);
            alert('Se actualizó el evento correctamente');
            $('#modalEditEvento').modal('hide');
        }
    }).fail(function () {
        alert("error");
    });
}

function modalEditArchivo(idevento, e){
    if (idevento.length == 0 ){
        alert('No se puede actualizar en este momento'); return; 
    }
    $('#modalEditArchivo').modal('show');
    ideve = idevento;
    obj = e;
    $.ajax({
        url: 'intranet/C_admin_eventos/modalEditArchivo',
        data: {
            idevento
        },
        type: 'POST'
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            $('#body_imagen').html(data.html);
            $('#modalEditDoc').modal('show');
        }
    }).fail(function () {
        alert("error");
    });
}

function editImagenEvento(){
    if(ideve == null){
        alert('No se puede editar en este momento');
        return;
    }
    if ($('input[type=file]')[0].files[0] == null) {
        alert("Debe seleccionar una imagen");
        return;
    }
    var fileSplit = $('input[type=file]')[0].files[0].name.split(".");
    var ext = fileSplit[fileSplit.length - 1].toUpperCase();
    if (ext != 'PNG' && ext != 'JPG' && ext != 'JPEG'){
        alert('Debe seleccionar el tipo de archivo correcto (PNG,JPG,JPEG)');
        return;
    }
    var formData = new FormData();
    formData.append('idevento', ideve);
    formData.append('archivo', $('input[type=file]')[0].files[0]);
    $.ajax({
        url: 'intranet/C_admin_eventos/editImagenEvento',
        data: formData,
        type: 'POST',
        contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
        processData: false, // NEEDED, DON'T OMIT THIS
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            $("#body_imagen").html(data.html);
            alert('Se editó la imagen correctamente');
        } else {
            alert(data.msj);
        }
    }).fail(function () {
        alert("error");
    });

}

var tags = [];
function modalAddTag(){
    $('#tagNuevo').val(null);
    $('#modalTags').modal('show');
    $('#body_tags').html(null);
    if(tags.length != 0){
        tableTags(tags);
    }
}

function agregarTag(){
    var newTag = $('#tagNuevo').val().trim();
    if(newTag.length == 0){
        alert('Debes escribir una palabra');
        return;
    }
    if (!/^[a-zA-ZÀ-ÿ\u00f1\u00d1]*$/g.test(newTag)) {
        alert("Sólo puedes ingresar letras");
        return false;
    }
    if(newTag.length < 3){
        alert('Debe contener como mínimo 3 letras');
        return;
    }
    if(newTag.length > 20){
        alert('Debe contener como máximo 20 letras');
        return;
    }
    if(tags.length == 10){
        alert('Sólo puedes ingresar 10 palabras clave');
        return;
    }
    tags.push(newTag);
    $('#tagNuevo').val(null);
    tableTags(tags);
}

function tableTags(arr){
    var html_content  = "";
    arr.forEach((element,index) => {
        html_content +='<tr><td>'+(index+1)+'</td><td>'+element+'</td><td>'
                    +'<div class="block_container">'
                    +'<div class="block" onclick="removeTag('+index+')"><i class="far fa-trash-alt tooltip-test" title="Eliminar"></i>'
                    +'</div></div></td>'
                +'</tr>';
    });
    
    $('#tagsEvento').val(tags.join(";"));
    $('#body_tags').html(html_content);
}

function removeTag(i){
    tags.splice(i, 1);
    tableTags(tags);
}