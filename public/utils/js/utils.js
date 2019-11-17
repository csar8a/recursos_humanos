function consulta() {

    var tipodoc = $('#selectTipoDoc').val();
    var doc = $('#documentoID').val();

    if (!validarConsulta(tipodoc, doc)) return;



    if (tipodoc == 1) //DNI
    {
        $.ajax({
            url: 'http://aplicaciones007.jne.gob.pe/srop_publico/Consulta/Afiliado/GetNombresCiudadano?DNI=' + doc,
            type: 'GET'
        }).done(function (response) {
            var nombre = response;
            var arrayN = nombre.split("|");
            $('#nombreID').val() = arrayN[2] + " " + arrayN[0] + " " + arrayN[1];
        }).fail(function () {
            alert('error');
        });
    }
    else if (tipodoc == 2) //RUC
    {
        $.ajax({
            url: 'https://api.sunat.cloud/ruc/' + doc,
            type: 'GET',
            dataType: 'jsonp'
        }).done(function (response) {
            let data = response;
            $('#nombreID').val() = data.razon_social;
        }).fail(function () {
            alert('error');
        });
    }

}

function validarConsulta(tipodoc, doc) {
    if (tipodoc.length == 0) { alert('Debes seleccionar un tipo de documento'); return; }
    if (tipodoc == 1 && doc.length != 8) { alert('Para DNI debe ingresar 8 digitos'); return; }
    if (tipodoc == 2 && doc.length != 11) { alert('Para RUC debe ingresar 11 digitos'); return; }
    return true;
}

function changeTipoDoc() {
    $('#documentoID').val(null);
    limpiarDatosPersona();
    var tipodoc = $('#selectTipoDoc').val();
    if (tipodoc.length != 0) {
        $("#btnBuscar").prop('disabled', false);
    } else {
        $("#btnBuscar").prop('disabled', true);
    }
}

function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

function buscarPersona() {
    var tipodoc = $('#selectTipoDoc').val();
    var doc     = $('#documentoID').val();
    if (tipodoc.length == 0) { alert('Debes seleccionar un tipo de documento'); return; }
    if (doc.length == 0) { alert('Debes especificar un documento'); return; }
    if (tipodoc == 3 && doc.length != 8) { alert('Para DNI debe ingresar 8 digitos'); return; }
    if (tipodoc == 4 && doc.length != 11) { alert('Para RUC debe ingresar 11 digitos'); return; }
    $.ajax({
        url: 'C_utils/buscarPersona',
        data: {
            tipodoc,
            doc
        },
        type: 'POST'
    }).done(function (response) {
        let data = JSON.parse(response);
        persona = data.result;
        
        if (data.error == 0) {
            $('#paternoID').val(persona.TXTAPEPATERNO);
            $('#maternoID').val(persona.TXTAPEMATERNO);
            $('#nombresID').val(persona.TXTNOMPERSONA);
            $('#telefonoID').val(persona.TXTTELEFONO);
            $('#celularID').val(persona.TXTCELULAR);
            $('#correoID').val(persona.TXTCORREO);
            $('#FechaNacimientoID').val(persona.DANACIMIENTO);
            $('#SexoID').val(persona.TXTSEXO);
            $('#selectEstadoCivil').val(persona.ESTADOCIVIL);
            $('#gradoInstruccionID').val(persona.TXTGRADOINSTRUCCION);
            $('#ocupacionID').val(persona.TXTOCUPACION);
            $('#centroEstudioID').val(persona.TXTCENTRO);
            $('#selectDistrito').val(persona.IDDISTRITO);
            $('#viaID').val(persona.TXTVIAPUBLICA);
            $('#urbanizacionID').val(persona.TXTURBANIZACION);
            $('#numeroID').val(persona.TXTNUMERO);
            $('#interiorID').val(persona.TXTINTERIOR);
            $('#manzanaID').val(persona.TXTMANZANA);
            $('#loteID').val(persona.TXTLOTE);
            //disabledEnableDatosPersona(1);
        } else {
            //disabledEnableDatosPersona(2);
            limpiarDatosPersona();
            alert('No se ha registrado antes el documento especificado.');
        }
    }).fail(function () {
        alert("error");
    });    
}

function buscarApoderado() {
    var tipodoc = $('#selectTipoDocApoderado').val();
    var doc     = $('#documentoApoderadoID').val();
    if (tipodoc.length == 0) { alert('Debes seleccionar un tipo de documento'); return; }
    if (doc.length == 0) { alert('Debes especificar un documento'); return; }
    if (tipodoc == 3 && doc.length != 8) { alert('Para DNI debe ingresar 8 digitos'); return; }
    if (tipodoc == 4 && doc.length != 11) { alert('Para RUC debe ingresar 11 digitos'); return; }
    $.ajax({
        url: 'C_utils/buscarPersona',
        data: {
            tipodoc,
            doc
        },
        type: 'POST'
    }).done(function (response) {
        let data = JSON.parse(response);
        persona = data.result;
        
        if (data.error == 0) {
            $('#paternoApoderadoID').val(persona.TXTAPEPATERNO);
            $('#maternoApoderadoID').val(persona.TXTAPEMATERNO);
            $('#nombresApoderadoID').val(persona.TXTNOMPERSONA);
            $('#telefonoApoderadoID').val(persona.TXTTELEFONO);
            $('#celularApoderadoID').val(persona.TXTCELULAR);
            $('#correoApoderadoID').val(persona.TXTCORREO);
            $('#FechaNacimientoAID').val(persona.DANACIMIENTO);
            $('#sexoApoderado').val(persona.TXTSEXO);
            $('#selectEstadoCivilApoderado').val(persona.ESTADOCIVIL);
            $('#gradoApoderadoID').val(persona.TXTGRADOINSTRUCCION);
            $('#ocupacionApoderadoID').val(persona.TXTOCUPACION);
            $('#c').val(persona.TXTCENTRO);
           
            //disabledEnableDatosPersona(1);
        } else {
            //disabledEnableDatosPersona(2);
            limpiarDatosApoderado();
            alert('No se ha registrado antes el documento especificado.');
        }
    }).fail(function () {
        alert("error");
    });    
}

function disabledEnableDatosPersona(flg) {
    bool = (flg == 1) ? true : false;
    $('#paternoID').prop('disabled',bool);
    $('#maternoID').prop('disabled',bool);
    $('#nombresID').prop('disabled',bool);
    $('#telefonoID').prop('disabled',bool);
    $('#correoID').prop('disabled',bool);
    $('#selectDistrito').prop('disabled',bool);
    $('#viaID').prop('disabled',bool);
    $('#urbanizacionID').prop('disabled',bool);
    $('#numeroID').prop('disabled',bool);
    $('#interiorID').prop('disabled',bool);
    $('#manzanaID').prop('disabled',bool);
    $('#loteID').prop('disabled',bool);
}

function limpiarDatosApoderado(){
    //disabledEnableDatosPersona(2);
    $('#paternoApoderadoID').val(null);
    $('#maternoApoderadoID').val(null);
    $('#nombresApoderadoID').val(null);
    $('#telefonoApoderadoID').val(null);
    $('#correoApoderadoID').val(null);
    $('#FechaNacimientoAID').val(null);
    $('#sexoApoderado').val(null);
    $('#selectEstadoCivilApoderado').val(null);
    $('#gradoApoderadoID').val(null);
    $('#ocupacionApoderadoID').val(null);

}


function limpiarDatosPersona(){
    //disabledEnableDatosPersona(2);
    $('#paternoID').val(null);
    $('#maternoID').val(null);
    $('#nombresID').val(null);
    $('#telefonoID').val(null);
    $('#correoID').val(null);
    $('#selectDistrito').val(null);
    $('#viaID').val(null);
    $('#urbanizacionID').val(null);
    $('#numeroID').val(null);
    $('#interiorID').val(null);
    $('#manzanaID').val(null);
    $('#loteID').val(null);
}

function GetFormattedDate(fecha) {
    var fec = fecha.split('/');
    var month = fec[1];
    var day = fec[0];
    var year = fec[2];
    return month + "/" + day + "/" + year;
}

function validarCosto(valor) {
    var RE = /^\d+\.?\d*$/;
    if (RE.test(valor)) {
        if(valor > 0){
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

var compare_dates = function(date1,date2){
    if (date1<date2) {
        return true;
    } else {
        return false;
    }
}