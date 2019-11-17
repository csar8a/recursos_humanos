function insertarEvento() {
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
    if ($('input[type=file]')[0].files[0] == null) {
        alert("Debe seleccionar un archivo");
        return;
    }
    var fileSplit = $('input[type=file]')[0].files[0].name.split(".");
    var ext = fileSplit[fileSplit.length - 1].toUpperCase();
    if (ext != 'PNG' && ext != 'JPG' && ext != 'JPEG'){
        alert('Debe seleccionar el tipo de archivo correcto (PNG,JPG,JPEG)');
        return;
    }

    if (lugar.length == 0)     { alert('No debe dejar vacío el campo de lugar'); return; }
    if (categoria.length == 0) { alert('No debe dejar vacío el campo de categoría'); return; }

    //if (costo.length == 0)     { alert('No debe dejar vacío el campo de costo'); return; }
    //if (!validarCosto(costo))  { alert('Ingrese un precio correcto'); return; }
    if (contacto.length == 0)  { alert('No debe dejar vacío el campo de contacto'); return; }

    if (fechainicio.length == 0)  { alert('No debe dejar vacío el campo de fecha inicio'); return; }
    if (horainicio.length == 0)   { alert('No debe dejar vacío el campo de hora inicio'); return; }
    if (fechafin.length == 0)     { alert('No debe dejar vacío el campo de fecha fin'); return; }
    if (horafin.length == 0)      { alert('No debe dejar vacío el campo de hora fin'); return; }
    var fec1 = new Date(GetFormattedDate(fechainicio) + ' ' + horainicio);
    var fec2 = new Date(GetFormattedDate(fechafin)    + ' ' + horafin);
    if (!compare_dates(fec1,fec2))   { alert('Debe colocar colocar fecha y hora de fin del evento después del inicio del evento.'); return; }

    if (tagsEvento.length == 0)   { alert('Debe indicar palabras clave del evento'); return; }
    var formData = new FormData();
    
    formData.append('titulo', titulo);
    formData.append('descripcion', descripcion);
    formData.append('archivo', $('input[type=file]')[0].files[0]);
    formData.append('lugar', lugar);
    formData.append('categoria', categoria);
    formData.append('costo', costo);
    formData.append('contacto', contacto);
    formData.append('fechainicio', fechainicio+' '+horainicio);
    formData.append('fechafin', fechafin+' '+horafin);
    formData.append('tags', tagsEvento);
    
    $.ajax({
        url: 'intranet/C_eventos/insertarEvento',
        data: formData,
        type: 'POST',
        contentType: false,
        processData: false,
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            alert('Se registró el evento correctamente');
            location.reload();
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
