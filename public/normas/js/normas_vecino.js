function buscarNormas() {
    var nid_tipo = $('#tiponorma').val();
    var year     = $('#yearnorma').val();
    var nombre     = $('#nombre').val();
    var descripcion = $('#descripcion').val();

    if (nid_tipo.length == 0 && year.length == 0 && nombre.length == 0 && descripcion.length == 0 ) 
    {
        alert('Debes elegir un tipo de busqueda'); return; 
    }

    $.ajax({
        url: 'normas/C_normas_vecino/buscarNormas',
        data: {
            nid_tipo : nid_tipo,
            year : year,
            nombre : nombre,
            descripcion : descripcion
        },
        type: 'POST'
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            $("#body_normas").html(data.html);
        } else {
            $("#body_normas").html(null);
        }
    }).fail(function () {
        alert("error");
    });
}

/*document.getElementById("btnBuscar").addEventListener("click",buscarNormas,false);*/


function hit(e) {
    setTimeout(function(){
        var hit = $(e).closest("tr").find("td[attr='hits']");
        hit.text(parseInt(hit.text(), 10) + 1);
    }, 1000);
}
