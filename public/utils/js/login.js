function loguear() {
    var usuario = $('#usuarioID').val();
    var password = $('#passwordID').val();

    $
        .ajax({
            url: 'C_login/login',
            type: 'POST',
            data: {
                usuario,
                password
            }
        })
        .done(function (response) {
            let data = JSON.parse(response);
            if (data.error == 0) {
                window.open(base_url + "main", "_self");
            } else {
                alert('Usuario incorrecto');
            } //location.reload();}
        })
        .fail(function () {
            alert('error');
        });
}

$('#passwordID').keyup(function (e) {
    if (e.which == 13) {
        loguear();
    }
});