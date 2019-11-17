function enviarSMS() {
    
    var celular = $('#cel').val();
    var mensaje = $('#mensaje').val();
    
    if(validaciones(celular, mensaje)) {
        $("#btnBuscar").prop('disabled', true);
        $("#searching").show();
    } else {
        return;
    }

    $.ajax({
        url: 'pide/C_consulta_PCM/enviarMensaje',
        data: {
            celular, mensaje
        },
        type: 'POST'
    }).done(function (response) {

        console.log(response);
        
        let data = JSON.parse(response);
        if (data.error == 0) {
            $("#btnBuscar").prop('disabled', false);
            $("#searching").hide();

            $("#body_consulta").html(data.html);
        } else {
            $("#btnBuscar").prop('disabled', false);
            $("#searching").hide();
            $("#body_consulta").html(null);
            alert('Incorrecto');
        }
    }).fail(function () {
        alert("error");
    });
}

function validaciones(celular, mensaje) {
    if (celular.length == 0 ) {alert('Debe colocar numero de celular'); return;}
    if (mensaje.length == 0 ) {alert('Debe colocar mensaje'); return;}
    if (celular.length != 11 ) {alert('Debe ingresar 9 d&iacute;gitos'); return;}
    if (mensaje.length > 160 ) {alert('Solo puede ingresar hasta 160 caracteres'); return;}
    return true;
}