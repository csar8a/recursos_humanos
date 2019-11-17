function buscarGrados() {
    $("#body_consulta").html(null);
    var tipodoc = $('#selectTipoDoc').val();
    var numdoc  = $('#numdoc').val().trim();
    $("#btnBuscar").prop('disabled', true);
    $("#searching").show();
    if (tipodoc.length == 0)
    {
        alert('Debe seleccionar TIPO DE DOCUMENTO'); return; 
    }
    if (numdoc.length == 0) 
    {
        alert('Debe colocar NÚMERO DE DOCUMENTO'); return; 
    }

    $.ajax({
        url: 'pide/C_consulta_sunedu_grados/buscarGrados',
        data: {
            tipodoc, numdoc
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
        }
    }).fail(function () {
        alert("error");
    });
}
