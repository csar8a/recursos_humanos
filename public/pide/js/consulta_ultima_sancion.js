function buscarUltimaSancion(){

    var tipo_doc = $('#selectTipoDoc').val();
    var numeroDoc = $('#doc').val();

    if(tipo_doc.length == 0){
        alert('Debe seleccionar un tipo de documento');
        return;
    }
    if(numeroDoc.length == 0){
        alert('No debe dejar vacío el campo de documento');
        return;
    }

    $("#btnBuscar").prop('disabled', true);
    $("#searching").show();

    $.ajax({
        url: 'pide/C_consulta_ultima_sancion/buscarUltimaSancion',
        data: {
            tipo_doc,
            numeroDoc
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
            alert('Dato incorrecto');
        }
    }).fail(function () {
        alert("error");
    });



}