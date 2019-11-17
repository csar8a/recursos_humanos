function buscarNoticia(){
  
    var nombre  = $('#nombre').val().trim();
    if (nombre.length == 0) { alert('Debe escribir un nombre'); return; }
    if (nombre.length < 3) { alert('Debe escribir más de 2 letras'); return; }
    $.ajax({
        url: 'intranet/C_admin_noticias/buscarNoticia',
        data: {
            nombre
        },
        type: 'POST'
    }).done(function (response) {
        let data = JSON.parse(response);   
        if (data.error == 0) {
            $("#btnBuscar").prop('disabled', false);
            $("#searching2").hide();
            $("#body_noticias").html(data.html);

        }
    }).fail(function () {
        alert("error");
    });
}

function ModalFotoP(idnoticia,txturlimagen) {
    if(txturlimagen == null){
        alert('No se puede mostrar la imagen');
        return;
    }
    $.ajax({
        url: 'intranet/C_admin_noticias/modalFotoP',
        data: {
            idnoticia,txturlimagen
        },
        type: 'POST'
    }).done(function (response) {
        let data = JSON.parse(response);
        $('#body_fotop').html(data.html);
        $('#modal_foto_principal').modal('show');
    }).fail(function () {
        alert("error");
    });
}

var noticia = null;
function ModalFotoE(idnoticia) {
    console.log(idnoticia);
    if(idnoticia == null){
        alert('No se puede mostrar el contenido');
        return;
    }
    noticia = idnoticia;
    console.log(noticia);
    $.ajax({
        url: 'intranet/C_admin_noticias/modalFotoE',
        data: {
            idnoticia
        },
        type: 'POST'
    }).done(function (response) {
        let data = JSON.parse(response);
        $('#body_fotoe').html(data.html);
        $('#modal_foto_extra').modal('show');
    }).fail(function () {
        alert("error");
    });
}
var idnoticia=null
var obj = null;


function modalEditDatosNoticia(idnoticia, e) {
    if (idnoticia == null || e == null) {
        alert('No se puede editar en este momento');
        return;
    }
    iddoc = idnoticia;
    
    obj = e;
    $.ajax({
        url: 'intranet/C_admin_noticias/modalEditDatosNoticia',
        data: {
            idnoticia
        },
        type: 'POST'
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            $('#idnoticia').val(data.idnoticia);
            $('#titulo').val(data.titulo);
            $('#descripcion').val(data.descripcion);
            $('#extracto').val(data.extracto);
            $('#modalEditDoc').modal('show');
        }
    }).fail(function () {
        alert("error");
    });
}

function editDatosNoticia(){
var idnoticia = $('#idnoticia').val().trim();
var titulo = $('#titulo').val().trim();
var extracto = $('#extracto').val().trim();
if (titulo.length == 0 ){
    alert('Debes especificar titulo'); return; 
}
var descripcion = $('#descripcion').val().trim();
if (descripcion.length == 0 ){
    alert('Debes especificar una descripción'); return; 
}

$.ajax({
    url: 'intranet/C_admin_noticias/editDatosNoticia',
    data: {
        idnoticia,titulo,extracto,descripcion 
    },
    type: 'POST'
}).done(function (response) {
    let data = JSON.parse(response);
    if (data.error == 0) {
        $(obj).closest("tr").find("td[attr='titulo']").html(nombre);
        $(obj).closest("tr").find("td[attr='descripcion']").html(descripcion);
        $(obj).closest("tr").find("td[attr='extracto']").html(extracto);
        $(obj).closest("tr").find("td[attr='titulonoticia']").html(titulo);
        $(obj).closest("tr").find("td[attr='descripcionnoticia']").html(descripcion);
        $(obj).closest("tr").find("td[attr='extractonoticia']").html(extracto);
        alert('Se editó correctamente');
        $('#modalEditDoc').modal('hide');
    }
}).fail(function () {
    alert("error");
});
}

function editArchivo(){
//var idnoticia=$('#idnoticia').val();
var idnoticia=document.getElementById("idnoticia").textContent;
var nombre=$('input[type=file]')[0].files[0].name;

//var myElement = document.getElementById("intro");

if ($('input[type=file]')[0].files[0] == null) {
    alert("Debe seleccionar un archivo");
    return;
}
var formData = new FormData();
formData.append('idnoticia', idnoticia);
formData.append('archivo', $('input[type=file]')[0].files[0]);



$.ajax({
    url: 'intranet/C_admin_noticias/editArchivo',
    data: formData,
    type: 'POST',
    contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
    processData: false, // NEEDED, DON'T OMIT THIS
}).done(function (response) {
    let data = JSON.parse(response);
    if (data.error == 0) {
        $("#body_fotop").html(data.html);
        $(obj).attr("onclick",'ModalFotoP(this)');
        $('#body_fotop').html('<img style="width: 50%;height: 50%;" src="../server_files/intranet/noticiasimg/'+nombre+'" />');
        alert('La imagen ha sido modificada');
        
    } else {
        alert(data.msj);
    }
}).fail(function () {
    alert("error");
});
}

function estadoNoticia(idnoticia,e){
    if(idnoticia == null || e == null){
        alert('No se puede editar en este momento');
        return;
    }
    
    var obj = $(e).closest('input');
    var flg = obj.is(':checked') ? 1 : 0;
    
    $.ajax({
        url: 'intranet/C_admin_noticias/estadoNoticia',
        data: {
            idnoticia,
            flg
        },
        type: 'POST'
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            alert('El estado de la noticia a sido modificada');
        } else {
            alert(data.msj);
        }
    }).fail(function () {
        alert("error");
    });
}

function limpiar(){
$("#imagenprincipal").val('');
}

var imgExtra = null;
var obj = null;


function modalVerFotoExtra(e){
    if(noticia == null || e == null){
        alert('No se puede mostrar el contenido');
        return;
    }
    var img = $(e).closest("tr").find("td[attr='nombre']").html();
    if(img == null){
        alert('No se puede mostrar el contenido');
        return;
    }
    obj = e;
    imgExtra = img;
    $('#body_ver_foto_extra').html('<img style="width: 50%;height: 50%;" src="../server_files/intranet/noticiasimg/'+img+'" />');
    $('#modalVerFotoExtra').modal('show');
}

function editFotoExtra(){
    if(noticia == null || imgExtra == null || obj == null){
        alert('No se puede actualizar en este momento');
        return;
    }
    if ($('#fileExtra')[0].files[0] == null) {
        alert("Debe seleccionar un archivo");
        return;
    }
    var formData = new FormData();
    formData.append('idnoticia', noticia);
    formData.append('imgextra', imgExtra);
    formData.append('archivo', $('#fileExtra')[0].files[0]);
    $.ajax({
        url: 'intranet/C_admin_noticias/editFotoExtra',
        data: formData,
        type: 'POST',
        contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
        processData: false, // NEEDED, DON'T OMIT THIS
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            $(obj).closest("tr").find("td[attr='nombre']").html(data.img);
            $(obj).attr("onclick",'modalVerFotoExtra(this)');
            $('#body_ver_foto_extra').html('<img style="width: 50%;height: 50%;" src="../server_files/intranet/noticiasimg/'+data.img+'" />');
            alert('Se editó el documento correctamente');
        } else {
            alert('No se puede actualizar en este momento');
        }
    }).fail(function () {
        alert("error");
    });
}

function modalRemoveFotoExtra(idnoticia, e){
    if(idnoticia == null || e == null){
        alert('No se puede eliminar en este momento');
        return;
    }
    var img = $(e).closest("tr").find("td[attr='nombre']").html();
    if(img == null){
        alert('No se puede eliminar en este momento');
        return;
    }

    $.ajax({
        url: 'intranet/C_admin_noticias/modalRemoveFotoExtra',
        data: {
            idnoticia,img
        },
        type: 'POST'
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            $(e).closest("tr").remove();
            alert('Se eliminó correctamente');
        } else {
            alert('Ha ocurrido un error');
        }
    }).fail(function () {
        alert("error");
    });
}

function addFotoExtra(){
    if(noticia == null){
        alert('No se puede agregar en este momento');
        return;
    }
    if ($('#addFileExtra')[0].files[0] == null) {
        alert("Debe seleccionar un archivo");
        return;
    }
    var formData = new FormData();
    formData.append('idnoticia', noticia);
    formData.append('archivo', $('#addFileExtra')[0].files[0]);
    $.ajax({
        url: 'intranet/C_admin_noticias/addFotoExtra',
        data: formData,
        type: 'POST',
        contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
        processData: false, // NEEDED, DON'T OMIT THIS
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            
            $('#body_fotoe').html(data.html);
            alert('Se agregó la imagen correctamente');
        } else {
            alert(data.msj);
        }
    }).fail(function () {
        alert("error");
    });
}
