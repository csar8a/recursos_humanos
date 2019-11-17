function ws(llamada){
    console.log('llamada '+llamada);
    $.ajax({
        type: "POST",
        url: 'contacto/C_contacto_ws/addContacto',
        data: {
            llamada 
        },
        type: 'POST',
        /*data: "llamada="+llamada,
        dataType: "html",*/
        success: function(data) {
            console.log('Function ws');
            console.log(data);
            send(data); // array JSON
            //window.location.href = 'form.php'
        }
    });
}