function modalVer(e) {

    var id_caso = $(e).closest("tr").data('id');
    var nom    = $(e).closest("tr").find("td[attr='nom']").text();
    var cat    = $(e).closest("tr").find("td[attr='cat']").text();
    var subcat = $(e).closest("tr").find("td[attr='subcat']").text();
    var medio  = $(e).closest("tr").find("td[attr='medio']").text();
    var tema   = $(e).closest("tr").find("td[attr='tema']").text();

    $.ajax({
        url: 'sav/C_sav/verMensaje',
        type: 'POST',
        data: {
            id_caso,
        }
    }).done(function (response) {
        let data = JSON.parse(response);
        if (data.error == 0) {
            $('#nomID').text(nom);
            $('#catID').text(cat);
            $('#subcatID').text(subcat);
            $('#medioID').text(medio);
            $('#temaID').text(tema);

            $('#modalVer').modal('show'); 
        }
    }).fail(function () {
        alert("error");
    });


    
}