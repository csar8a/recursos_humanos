function BuscarSunarp() {
    
    var razonsocial = $('#razonSocial').val();
    $("#btnBuscar").prop('disabled', true);
    $("#searching").show();
    

    if (razonsocial.length == 0  ) 
    {
        alert('Debe colocar Razon Social correcto'); return; 
    }

    

    $.ajax({
        url: 'pide/C_consulta_sunarp/buscarSUNARP',
        data: {
            razonsocial
        },
        type: 'POST'
    }).done(function (response) {
        
        let data = JSON.parse(response);
        if (data.error == 0) {
            $("#btnBuscar").prop('disabled', false);
            $("#searching").hide();
            $("#body_consulta").html(data.html);
        } else {
            $("#btnBuscar").prop('disabled', false);
            $("#searching").hide();
            $("#body_consulta").html(null);
            alert('Razon Social incorrecto');
        }
    }).fail(function () {
        alert("error");
    });
}


