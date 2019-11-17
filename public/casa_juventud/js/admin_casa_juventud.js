var familiares = [];
var id_ficha = "";

function openModalFamiliares(_id_ficha) {
    id_ficha = _id_ficha;
    $('#nombreMod').val(null);
    $('#appaternoMod').val(null);
    $('#apmaternoMod').val(null);
    $('#edadMod').val(null);
    $('#selectParentesco').val(null);
    familiares = [];
    $("#btnAddFamiliares").css('display', 'none');
    $("#tablaAddFamiliares").css('display', 'none');

    $('#modalFamiliares').modal('show');
    console.log(1);
    
}

function openListaFamiliares() {
    var id = id_ficha;
    $('#modalListaFamiliares').modal('show');
    getFamiliaresAjax(id);
}

function getFamiliaresAjax(id){
    var formData = new FormData();
    formData.append('id_ficha', id);

    $.ajax({
        url: 'casa_juventud/C_admin_c_juventud/getFamiliaresVista',
        data: formData,
        type: 'POST',
        contentType: false,
        processData: false, 
    }).done(function (response) {
        let data = JSON.parse(response);
        $('#body_tags2').html(data.html);
    }).fail(function () {
        alert("error");
    });
}


function agregarFamiliar() {
    var nombre = $('#nombreMod').val();
    var appaterno = $('#appaternoMod').val();
    var apmaterno = $('#apmaternoMod').val();
    var edad = $('#edadMod').val();
    var parentesco = $('#selectParentesco').val();

    if (!validate_family(nombre, appaterno, apmaterno, edad, parentesco)) { return; }


    var familia = [nombre, appaterno, apmaterno, edad, parentesco];

    familiares.push(familia);
    $('#nombreMod').val(null);
    $('#appaternoMod').val(null);
    $('#apmaternoMod').val(null);
    $('#edadMod').val(null);
    $('#selectParentesco').val(null);
    tableFamiliar(familiares);

    $("#btnAddFamiliares").css('display', 'block');
    $("#tablaAddFamiliares").css('display', '');

}

function tableFamiliar(arr){
  console.log(arr);
  var html_content  = "";
  arr.forEach((element,index) => {
      html_content +='<tr><td>'+(index+1)+'</td><td>'+element[0]+'</td><td>'+element[1]+'</td><td>'+element[2]+'</td><td>'+element[3]+'</td><td>'+element[4]+'</td>'
                  +'<td><div class="block_container" style="text-align: center">'
                  +'<div class="block" onclick="removeFamiliar('+index+')"><i class="far fa-trash-alt tooltip-test" style="color: red" title="Eliminar"></i></div>'
                  +'</div></td>'
              +'</tr>';

      
  });
  $('#tagsEvento').val(familiares.join(";"));
  $('#body_tags').html(html_content);
  
}

function removeFamiliar(i) {
    familiares.splice(i, 1);
    tableFamiliar(familiares);
}

function deleteFamiliar(idpersona){
    
    var id = id_ficha;

    var formData = new FormData();
    formData.append('idpersona', idpersona);

    $.ajax({
        url: 'casa_juventud/C_admin_c_juventud/deleteFamiliar',
        data: formData,
        type: 'POST',
        contentType: false,
        processData: false, 
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            alert('Se elimino al familiar correctamente');
            getFamiliaresAjax(id);
        } else {
            alert(data.msj);
        }
    }).fail(function () {
        alert("error");
    });
}


function registrarFamiliares() {
    var familiares = $('#tagsEvento').val();

    if (familiares == '') {
        alert('Ingrese familiares antes de asignar.');
        return;
    }

    var formData = new FormData();

    formData.append('familiares', familiares);
    formData.append('id_ficha', id_ficha);

    $.ajax({
        url: 'casa_juventud/C_admin_c_juventud/insertarFamiliar',
        data: formData,
        type: 'POST',
        contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
        processData: false, // NEEDED, DON'T OMIT THIS
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            alert('Se registró los familiares correctamente');
            location.reload();
        } else {
            alert(data.msj);
        }
    }).fail(function () {
        alert("error");
    });

}

function ModalFotoP(idjoven, imagen) {
    if (imagen == null) {
        alert('No se puede mostrar la imagen');
        return;
    }
    $.ajax({
        url: 'casa_juventud/C_admin_c_juventud/modalFotoP',
        data: {
            idjoven, imagen
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

function buscarFicha() {
    var nombre = $('#nombre').val().trim();
    var codigo = $('#codigo').val().trim();

    $.ajax({
        url: 'casa_juventud/C_admin_c_juventud/buscarFicha',
        data: {
            nombre, codigo
        },
        type: 'POST'
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            $("#btnBuscar").prop('disabled', false);
            $("#searching2").hide();
            $("#body_eventos").html(data.html);

        }
    }).fail(function () {
        alert("error");
    });
}

function editArchivo() {
    //var idnoticia=$('#idnoticia').val();
    var idjoven = document.getElementById("idjoven").textContent;
    var nombre = $('input[type=file]')[0].files[0].name;

    //var myElement = document.getElementById("intro");

    if ($('input[type=file]')[0].files[0] == null) {
        alert("Debe seleccionar un archivo");
        return;
    }
    var formData = new FormData();
    formData.append('idjoven', idjoven);
    formData.append('archivo', $('input[type=file]')[0].files[0]);
    console.log(formData);


    $.ajax({
        url: 'casa_juventud/C_admin_c_juventud/editArchivo',
        data: formData,
        type: 'POST',
        contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
        processData: false, // NEEDED, DON'T OMIT THIS
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            $("#body_fotop").html(data.html);
            $(obj).attr("onclick", 'ModalFotoP(this)');
            $('#body_fotop').html('<img style="width: 50%;height: 50%;" src="../server_files/modulos/casajuventud/' + nombre + '" />');
            alert('La imagen ha sido modificada');
            $('#modal_foto_principal').modal('hide');
            $('#btnBuscar').click();

        } else {
            alert(data.msj);
        }
    }).fail(function () {
        alert("error");
    });
}

var obj = null;

function validate_family(nombre, appaterno, apmaterno, edad, parentesco) {
    if (nombre == '') { alert('Debe ingresar un nombre'); return; }
    if (appaterno == '') { alert('Debe ingresar apellido paterno'); return; }
    if (apmaterno == '') { alert('Debe ingresar apellido materno'); return; }
    if (edad == '') { alert('Debe ingresar edad'); return; }
    if (parentesco == '') { alert('Debe seleccionar un parentesco'); return; }
    if (edad <= 0 || edad > 99) { alert('Debe ingresar una edad correcta'); return; }
    if (nombre.length >= 30) { alert('Solo puede ingresar hasta 30 digitos en el nombre'); return; }
    if (appaterno.length >= 30) { alert('Solo puede ingresar hasta 20 digitos en los apellidos'); return; }
    if (apmaterno.length >= 30) { alert('Solo puede ingresar hasta 20 digitos en los apellidos'); return; }


    return true;
}

function opencardpage(_id_ficha) {
    
    window.open("qr?id="+_id_ficha);

}

function modalEditDatosJoven(idficha, e) {
    if (idficha == null || e == null) {
        alert('No se puede editar en este momento');
        return;
    }
    iddoc = idficha;
    obj = e;
    $.ajax({
        url: 'casa_juventud/C_admin_c_juventud/modalEditDatosJoven',
        data: {
            idficha
        },
        type: 'POST'
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            var ficha = data.result[0];
            
            var ficha_joven = JSON.parse(ficha.joven);
            var ficha_apoderado = JSON.parse(ficha.apoderado);
           
           
            $('#JovenID').val(ficha_joven.idpersona);
            $('#documentoID').val(ficha_joven.txtdocumento);
            $('#selectTipoDoc').val(ficha_joven.tipodocumento);
            $('#selectTipoDoc').attr('disabled',true);
            $('#FechaNacimientoID').val(ficha_joven.txtfechanacimiento);
            $('#nombresID').val(ficha_joven.txtnompersona);
            $('#paternoID').val(ficha_joven.txtapepaterno);
            $('#maternoID').val(ficha_joven.txtapematerno);
            $('#telefonoID').val(ficha_joven.txttelefono);
            $('#celularID').val(ficha_joven.txtcelular);
            $('#correoID').val(ficha_joven.txtcorreo);
            $('#selectEstadoCivil').val(ficha_joven.txtestadocivil);
            $('#SexoID').val(ficha_joven.txtsexo);
            $('#gradoInstruccionID').val(ficha_joven.txtgrado);
            $('#ocupacionID').val(ficha_joven.txtocupacion);
            $('#centroEstudioID').val(ficha_joven.txtcentro);
            

            $('#selectDistrito').val(ficha_joven.distrito);
            $('#viaID').val(ficha_joven.txtviapublica);
            $('#urbanizacionID').val(ficha_joven.txturbanizacion);
            $('#numeroID').val(ficha_joven.txtnumero);
            $('#interiorID').val(ficha_joven.txtinterior);
            $('#manzanaID').val(ficha_joven.txtmanzana);
            $('#loteID').val(ficha_joven.txtlote);
           /* 


            $('#documentoID').val(ficha_joven.txtdocumento);
            $('#selectTipoDoc').val(ficha_joven.tipodocumento);
            $('#FechaNacimientoID').val(ficha_joven.txtfechanacimiento);
            $('#edadID').html(getAge2(new Date(getFormatted(ficha_joven.txtfechanacimiento))));
            $('#SexoID').val(ficha_joven.txtsexo);
            $('#paternoID').val(ficha_joven.txtapepaterno);
            $('#maternoID').val(ficha_joven.txtapematerno);
            $('#nombresID').val(ficha_joven.txtnompersona);
            $('#telefonoID').val(ficha_joven.txttelefono);
            $('#celularID').val(ficha_joven.txtcelular);
            $('#correoID').val(ficha_joven.txtcorreo);


            $('#idnorma2').val(data.idficha);
            $('#norma2').val(data.norma);
            $('#descripcion2').val(data.descripcion);
            $('#tipo2').val(data.tipo);
            $('#fecha2').val(data.fecha);
            $('#archivo2').val(data.archivo);*/
            $('#modalEditDoc').modal('show');
        }
    }).fail(function () {
        alert("error");
    });
}


function editDatosJoven(){
    var idjoven = $('#JovenID').val().trim();
  var apPaternoJoven = $('#paternoID').val().trim();
  var apMaternoJoven = $('#maternoID').val().trim();
  var nombresJoven = $('#nombresID').val().trim();
  var telefonoJoven = $('#telefonoID').val().trim();
  var celularJoven = $('#celularID').val().trim();
  var correoJoven = $('#correoID').val().trim();
  var gradoInstruccionJoven = $('#gradoInstruccionID').val().trim();
  var ocupacionJoven = $('#ocupacionID').val().trim();
  var centroEstudiosTrabajoJoven = $('#centroEstudioID').val().trim();
  var estadoCivilJoven = $('#selectEstadoCivil').val().trim();
  var fechaNacJoven      = $('#FechaNacimientoID').val().trim();

  var distrito = $('#selectDistrito').val();
  var viaPublica = $('#viaID').val().trim();
  var urbanizacion = $('#urbanizacionID').val().trim();
  var numero = $('#numeroID').val().trim();
  var interior = $('#interiorID').val().trim();
  var manzana = $('#manzanaID').val().trim();
  var lote = $('#loteID').val().trim();

  

    $.ajax({
        url: 'casa_juventud/C_admin_c_juventud/editDatosJoven',
        data: {
            idjoven,apPaternoJoven,apMaternoJoven,nombresJoven,
            telefonoJoven,celularJoven,correoJoven,
            gradoInstruccionJoven,ocupacionJoven,centroEstudiosTrabajoJoven,
            estadoCivilJoven,fechaNacJoven,distrito,viaPublica,
            urbanizacion,numero,interior,manzana,lote
        },
        type: 'POST'
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            alert('Se editó correctamente');
            $('#modalEditDoc').modal('hide');
            //location.reload();
            $('#btnBuscar').click();
        }
    }).fail(function () {
        alert("error");
    });
    }


    function isEmpty(obj) {
        for(var key in obj) {
            if(obj.hasOwnProperty(key))
                return false;
        }
        return true;
    }

function modalEditDatosApoderado(idficha, e) {
    if (idficha == null || e == null) {
        alert('No se puede editar en este momento');
        return;
    }
    iddoc = idficha;
    obj = e;
    $.ajax({
        url: 'casa_juventud/C_admin_c_juventud/modalEditDatosJoven',
        data: {
            idficha
        },
        type: 'POST'
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            var ficha = data.result[0];
            var ficha_apoderado = JSON.parse(ficha.apoderado);
            
           
      if(isEmpty(ficha_apoderado)){
                   
                   
                    $('#idnorma2').val(idficha);
                    $('#documentoApoderadoID').val("");
                    var campo = document.getElementById('documentoApoderadoID');
                    campo.readOnly = false;     
                    $("#btnBuscar").show();
                    $('#selectTipoDocApoderado').val("");
                    $('#selectTipoDocApoderado').attr('disabled',false);
                    var campo2 = document.getElementById('selectTipoDocApoderado');
                    campo2.readOnly = false;     
                    $('#ApoderadoID').val("");
                    $('#FechaNacimientoAID').val("");
                    $('#sexoApoderado').val("");
                    $('#paternoApoderadoID').val("");
                    $('#maternoApoderadoID').val("");
                    $('#nombresApoderadoID').val("");
                    $('#telefonoApoderadoID').val("");
                    $('#celularApoderadoID').val("");
                    $('#correoApoderadoID').val("");
                    $('#selectEstadoCivilApoderado').val("");
                    $('#gradoApoderadoID').val("");
                    $('#ocupacionApoderadoID').val("");
                    $('#modalEditDoc2').modal('show');
        }
         else {
        
      
        $('#idnorma2').val(idficha);
        $('#selectTipoDocApoderado').val(ficha_apoderado.tipodocumento);
        $("#btnBuscar").hide();
        $('#selectTipoDocApoderado').attr('disabled',true);
        var campo2 = document.getElementById('selectTipoDocApoderado');
        campo2.readOnly = true;  
        $('#documentoApoderadoID').val(ficha_apoderado.txtdocumento);
        var campo = document.getElementById('documentoApoderadoID');
        campo.readOnly = true;     
        
        
        $('#FechaNacimientoAID').val(ficha_apoderado.txtfechanacimiento);
        //$('#edadApoderadoID').html(getAge2(new Date(getFormatted(ficha_apoderado.txtfechanacimiento))));
        $('#sexoApoderado').val(ficha_apoderado.txtsexo);
        $('#paternoApoderadoID').val(ficha_apoderado.txtapepaterno);
        $('#maternoApoderadoID').val(ficha_apoderado.txtapematerno);
        $('#nombresApoderadoID').val(ficha_apoderado.txtnompersona);
        $('#telefonoApoderadoID').val(ficha_apoderado.txttelefono);
        $('#celularApoderadoID').val(ficha_apoderado.txtcelular);
        $('#correoApoderadoID').val(ficha_apoderado.txtcorreo);
        $('#selectEstadoCivilApoderado').val(ficha_apoderado.txtestadocivil);
        $('#SexoID').val(ficha_apoderado.txtsexo);
        $('#gradoApoderadoID').val(ficha_apoderado.txtgrado);
        $('#ocupacionApoderadoID').val(ficha_apoderado.txtocupacion);
        $('#modalEditDoc2').modal('show');
        }
    }
    
    }).fail(function () {
        alert("error");
    });
}


function editDatosApoderado(){
        var idficha = $('#idnorma2').val().trim();
        //var idapoderado = $('#ApoderadoID').val().trim();
        var tipodocapoderado = $('#selectTipoDocApoderado').val().trim();
        var docapoderado = $('#documentoApoderadoID').val().trim();
        var apPaternoApoderado = $('#paternoApoderadoID').val().trim();
        var apMaternoApoderado = $('#maternoApoderadoID').val().trim();
        var nombresApoderado = $('#nombresApoderadoID').val().trim();
        var telefonoApoderado = $('#telefonoApoderadoID').val().trim();
        var celularApoderado = $('#celularApoderadoID').val().trim();
        var correoApoderado = $('#correoApoderadoID').val().trim();
        var gradoInstruccionApoderado = $('#gradoApoderadoID').val().trim();
        var ocupacionApoderado = $('#ocupacionApoderadoID').val().trim();
        var tipo_docApoderado = $('#selectTipoDocApoderado').val().trim();
        var estadoCivilApoderado = $('#selectEstadoCivilApoderado').val().trim();
        var sexoa = $('input:radio[name=sexoApoderado]:checked').val();
        var fechaNacApoderado      = $('#FechaNacimientoAID').val().trim();

       

    $.ajax({
        url: 'casa_juventud/C_admin_c_juventud/editDatosApoderado',
        data: {
            idficha,tipodocapoderado,docapoderado,apPaternoApoderado,apMaternoApoderado,nombresApoderado,telefonoApoderado,celularApoderado,correoApoderado,gradoInstruccionApoderado,
            ocupacionApoderado,ocupacionApoderado,tipo_docApoderado,estadoCivilApoderado,sexoa,fechaNacApoderado
        },
        type: 'POST'
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
          
            alert('Se editó correctamente');
            $('#modalEditDoc2').modal('hide');
            //location.reload();
            $('#btnBuscar').click();
        }
    }).fail(function () {
        alert("error");
    });
    }
