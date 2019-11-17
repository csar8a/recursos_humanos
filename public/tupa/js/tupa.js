function buscarModulo() {
    var tipomodulo = $('#moduloSelect').val();

    if (tipomodulo.length == 0) {
        alert('Debes seleccionar un Modulo');
        return;
    }

    $.ajax({
        url: 'C_tupa/getModulo',
        type: 'POST',
        data: {
            tipomodulo
        }
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            alert("success");
            alert('modulo encontrado');
        }
    }).fail(function () {
        alert("error");
    }).always(function () {
        alert("complete");
    });
}