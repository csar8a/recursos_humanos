function numeroAleatorio(min, max) {
  return Math.round(Math.random() * (max - min) + min);
}

function insertarFicha(){
  
  var responsable      = $('#responsableID').val();
  var emergencia = $('#emergenciaID').val();
  var fechaInscripcion       = $('#inscripcion-container input').val();
  //DETALLE DE JOVEN15
  var numDocumentoJoven = $('#documentoID').val();
  var apPaternoJoven = $('#paternoID').val();
  var apMaternoJoven = $('#maternoID').val();
  var nombresJoven = $('#nombresID').val();
  var telefonoJoven = $('#telefonoID').val();
  var celularJoven = $('#celularID').val();
  var correoJoven = $('#correoID').val();
  var gradoInstruccionJoven = $('#gradoInstruccionID').val();
  var ocupacionJoven = $('#ocupacionID').val();
  var centroEstudiosTrabajoJoven = $('#centroEstudioID').val();
  var tipo_docJoven = $('#selectTipoDoc').val();
  var estadoCivilJoven = $('#selectEstadoCivil').val();
  var fechaNacJoven      = $('#fechanacjov-container input').val();
  //var sexoJoven = $('.sexoJoven:checked').val();
  var sexoJoven = $('input:radio[name=sexoJoven]:checked').val();
  

  if (tipo_docJoven.length == 0) { toastr.warning('Debe seleccionar un tipo de documento', '', {"positionClass": "toast-top-center"}); return; }
  if (numDocumentoJoven.length == 0) { toastr.warning('No debe dejar vacío el campo de documento', '', {"positionClass": "toast-top-center"}); return; }
  if (fechaNacJoven.length == 0) { toastr.warning('No debe dejar vacío el fecha de Nacimiento', '', {"positionClass": "toast-top-center"}); return; }

  regexDocDNI = /^[0-9]+$/;
  matchDocDNI = numDocumentoJoven.match(regexDocDNI);
  if(tipo_docJoven == 3 && matchDocDNI != numDocumentoJoven) { toastr.warning('Ingrese solo números en número de documento', '', {"positionClass": "toast-top-center"}); return;}
  if (tipo_docJoven == 3 && numDocumentoJoven.length != 8) { toastr.warning('Para DNI debe ingresar 8 dígitos', '', {"positionClass": "toast-top-center"}); return;}

  regexDocCE = /^[a-z0-9]+$/;
  matchDocCE = numDocumentoJoven.match(regexDocCE);
  if(tipo_docJoven == 5 && matchDocCE != numDocumentoJoven) { toastr.warning('Ingrese solo valores alfanuméricos en número de documento', '', {"positionClass": "toast-top-center"}); return;}
  if (tipo_docJoven == 5 && numDocumentoJoven.length > 12) { toastr.warning('Para CE debe ingresar máximo 12 valores', '', {"positionClass": "toast-top-center"}); return; }

  regexDocPasaporte = /^[a-z0-9]+$/;
  matchDocPasaporte = numDocumentoJoven.match(regexDocPasaporte);
  if(tipo_docJoven == 6 && matchDocPasaporte != numDocumentoJoven) { toastr.warning('Ingrese solo valores alfanuméricos en número de documento', '', {"positionClass": "toast-top-center"}); return;}
  if (tipo_docJoven == 6 && numDocumentoJoven.length > 12) { toastr.warning('Para Pasaporte debe ingresar máximo 12 valores', '', {"positionClass": "toast-top-center"}); return; }


  regexPaterno = /^[a-z-A-ZñÑáéíóúÁÉÍÓÚ´\' ]+$/;
  matchPaterno = apPaternoJoven.match(regexPaterno);
  if (apPaternoJoven.length == 0) { toastr.warning('No debe dejar vacío el campo de apellido paterno', '', {"positionClass": "toast-top-center"}); return; }
  if (matchPaterno != apPaternoJoven) { toastr.warning('Solo ingrese letras en apellido paterno', '', {"positionClass": "toast-top-center"}); return; }


  regexMaterno = /^[a-z-A-ZñÑáéíóúÁÉÍÓÚ´\' ]+$/;
  matchMaterno = apMaternoJoven.match(regexMaterno);
  if (apMaternoJoven.length == 0) { toastr.warning('No debe dejar vacío el campo de apellido materno', '', {"positionClass": "toast-top-center"}); return; }
  if (matchMaterno != apMaternoJoven) { toastr.warning('Solo ingrese letras en apellido materno', '', {"positionClass": "toast-top-center"}); return;}

  regexNombres = /^[a-z-A-ZñÑáéíóúÁÉÍÓÚ´\' ]+$/;
  matchNombres = nombresJoven.match(regexNombres);
  if (nombresJoven.length == 0) { toastr.warning('No debe dejar vacío el campo de nombres', '', {"positionClass": "toast-top-center"}); return; }
  if (matchNombres != nombresJoven) { toastr.warning('Solo ingrese letras en nombre', '', {"positionClass": "toast-top-center"}); return;}

  regexCelular = /^[0-9]+$/;
  matchTelefono = celularJoven.match(regexCelular);
  if(matchTelefono != celularJoven) { toastr.warning('Ingrese solo números en celular', '', {"positionClass": "toast-top-center"}); return;}

  regexCorreo = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
  matchCorreo = correoJoven.match(regexCorreo);
  if (correoJoven.length == 0) { toastr.warning('No debe dejar vacío el campo de Correo electrónico', '', {"positionClass": "toast-top-center"}); return; }
  if(correoJoven.length != 0 && matchCorreo != correoJoven) { toastr.warning('Ingrese una dirección de correo válido', '', {"positionClass": "toast-top-center"}); return;}

  regexGrado = /^[a-z-A-ZñÑáéíóúÁÉÍÓÚ´\' ]+$/;
  matchGrado = gradoInstruccionJoven.match(regexGrado);
  if (gradoInstruccionJoven.length == 0) { toastr.warning('No debe dejar vacío el campo de grado', '', {"positionClass": "toast-top-center"}); return; }
  if (matchGrado != gradoInstruccionJoven) { toastr.warning('Solo ingrese letras en grado', '', {"positionClass": "toast-top-center"}); return;}

  regexOcupacion = /^[a-z-A-ZñÑáéíóúÁÉÍÓÚ´\' ]+$/;
  matchOcupacion = ocupacionJoven.match(regexOcupacion);
  if (ocupacionJoven.length == 0) { toastr.warning('No debe dejar vacío el campo de ocupación', '', {"positionClass": "toast-top-center"}); return; }
  if (matchOcupacion != ocupacionJoven) { toastr.warning('Solo ingrese letras en ocupación', '', {"positionClass": "toast-top-center"}); return;}

  regexCentro = /^[a-z-A-ZñÑáéíóúÁÉÍÓÚ´\' ]+$/;
  matchCentro = centroEstudiosTrabajoJoven.match(regexCentro);
  if (centroEstudiosTrabajoJoven.length == 0) { toastr.warning('No debe dejar vacío el campo de centro de estudios', '', {"positionClass": "toast-top-center"}); return; }
  if (matchCentro != centroEstudiosTrabajoJoven) { toastr.warning('Solo ingrese letras en centro de estudios', '', {"positionClass": "toast-top-center"}); return;}

  //DETALLE DE DOMICILIO
  var distrito = $('#selectDistrito').val();
  var viaPublica = $('#viaID').val().trim();
  var urbanizacion = $('#urbanizacionID').val().trim();
  var numero = $('#numeroID').val().trim();
  var interior = $('#interiorID').val().trim();
  var manzana = $('#manzanaID').val().trim();
  var lote = $('#loteID').val().trim();
  
  if (distrito.length == 0) { toastr.warning('Debe seleccionar un distrito', '', {"positionClass": "toast-top-center"}); return; }

  //DETALLE DE APODERADO
  var numDocumentoApoderado = $('#documentoApoderadoID').val();
  var edadApoderado = $('#edadApoderadoID').val();
  var apPaternoApoderado = $('#paternoApoderadoID').val();
  var apMaternoApoderado = $('#maternoApoderadoID').val();
  var nombresApoderado = $('#nombresApoderadoID').val();
  var telefonoApoderado = $('#telefonoApoderadoID').val();
  var celularApoderado = $('#celularApoderadoID').val();
  var correoApoderado = $('#correoApoderadoID').val();
  var gradoInstruccionApoderado = $('#gradoApoderadoID').val();
  var ocupacionApoderado = $('#ocupacionApoderadoID').val();
  var tipo_docApoderado = $('#selectTipoDocApoderado').val();
  var estadoCivilApoderado = $('#selectEstadoCivilApoderado').val();
  var fechaNacApoderado      = $('#fechaNacApoderado-container input').val();
  //var sexoApoderado = $('.sexoApoderado:checked').val();
  var sexoApoderado = $('input:radio[name=sexoApoderado]:checked').val();


  
  var codigo="";
  //ficha4
  
  if(tipo_docJoven == 3){
     codigo   =numDocumentoJoven+'0000';
  }
  else if(tipo_docJoven == 5){
     codigo   =numDocumentoJoven;
  }
  else if(tipo_docJoven == 6){
     codigo   =numDocumentoJoven;
  }


  $.ajax({
    url: 'casa_juventud/C_ficha_casa_juventud/insertarFicha',
    type: 'POST',
    data: {
        fechaInscripcion :fechaInscripcion,
        codigo :codigo,
        responsable:responsable,
        emergencia:emergencia,

        numDocumentoJoven :numDocumentoJoven,

        apPaternoJoven    :apPaternoJoven,
        apMaternoJoven    :apMaternoJoven,
        nombresJoven      :nombresJoven,
        telefonoJoven     :telefonoJoven,
        celularJoven      :celularJoven,
        correoJoven       :correoJoven,
        gradoInstruccionJoven  :gradoInstruccionJoven,
        ocupacionJoven  :ocupacionJoven,
        centroEstudiosTrabajoJoven   :centroEstudiosTrabajoJoven,
        tipo_docJoven  :tipo_docJoven,
        estadoCivilJoven :estadoCivilJoven,
        fechaNacJoven :fechaNacJoven,
        sexoJoven :sexoJoven,

        distrito     :distrito,
        viaPublica   :viaPublica,
        urbanizacion :urbanizacion,
        numero       :numero,
        interior     :interior,
        manzana      :manzana,
        lote         :lote,

        numDocumentoApoderado   :numDocumentoApoderado,
        apPaternoApoderado   :apPaternoApoderado,
        apMaternoApoderado   :apMaternoApoderado,
        nombresApoderado   :nombresApoderado,
        telefonoApoderado     :telefonoApoderado,
        celularApoderado    :celularApoderado,
        correoApoderado     :correoApoderado,
        gradoInstruccionApoderado    :gradoInstruccionApoderado,
        ocupacionApoderado       :ocupacionApoderado,
        tipo_docApoderado       :tipo_docApoderado,
        estadoCivilApoderado   :estadoCivilApoderado,
        fechaNacApoderado   :fechaNacApoderado,
        sexoApoderado  :sexoApoderado

    }
}).done(function (response) {
 
    let data = JSON.parse(response);
   
    if (data.error == 0) {
      toastr.success('Se insertó correctamente la ficha','', {"positionClass": "toast-top-full-width"});
      setTimeout(function(){
        window.open(base_url + "admin_casa_juventud", "_self");
      }, 2000);
    } else {
      
      toastr.error(data.msj);
      $("#btnInsertar").prop('disabled', false);
      $('#btnInsertar').button('reset');
      
      
    }
}).fail(function () {
  $("#btnInsertar").prop('disabled', false);
  $('#btnInsertar').button('reset');
  toastr.error("Error");
  
});

}