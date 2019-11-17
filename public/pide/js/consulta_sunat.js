function buscarSunat() {
    
    var ruc = $('#ruc').val();
    
    if(validaciones(ruc)) {
        $("#btnBuscar").prop('disabled', true);
        $("#searching").show();
    } else {
        return;
    }

    $.ajax({
        url: 'pide/C_consulta_sunat/buscarSUNAT',
        data: {
            ruc
        },
        type: 'POST'
    }).done(function (response) {

        console.log(response);
        
        let data = JSON.parse(response);
        if (data.error == 0) {
            $("#btnBuscar").prop('disabled', false);
            $("#searching").hide();
            $("#codigo_sunat").html(data.html4);
            $("#body_consulta").html(data.html);
            $("#body_consulta2").html(data.html2);
            $("#body_consulta3").html(data.html3);
        } else {
            $("#btnBuscar").prop('disabled', false);
            $("#searching").hide();
            $("#codigo_sunat").html(data.html4);
            $("#body_consulta").html(null);
            $("#body_consulta2").html(null);
            $("#body_consulta3").html(null);
            alert('Incorrecto');
        }
    }).fail(function () {
        alert("error");
    });
}

function validaciones(ruc) {
    if (ruc.length == 0 ) {alert('Debe colocar RUC'); return;}
    if (ruc.length != 11 ) {alert('Debe ingresar 11 d&iacute;gitos'); return;}
    return true;
}