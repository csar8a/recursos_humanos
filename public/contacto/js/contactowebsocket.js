var FancyWebSocket = function(url)
{
	var callbacks = {};
	var ws_url = url;
	var conn;
	
	this.bind = function(event_name, callback)
	{
		callbacks[event_name] = callbacks[event_name] || [];
		callbacks[event_name].push(callback);
		return this;
	};
	
	this.send = function(event_name, event_data)
	{
		this.conn.send( event_data );
		return this;
	};
	
	this.connect = function() 
	{
		if ( typeof(MozWebSocket) == 'function' )
		this.conn = new MozWebSocket(url);
		else
		this.conn = new WebSocket(url);
		
		this.conn.onmessage = function(evt)
		{
			dispatch('message', evt.data);
		};
		
		this.conn.onclose = function(){dispatch('close',null)}
		this.conn.onopen = function(){dispatch('open',null)}
	};
	
	this.disconnect = function()
	{
		this.conn.close();
	};
	
	var dispatch = function(event_name, message)
	{
		if(message == null || message == "")//aqui es donde se realiza toda la accion
			{
			}
			else
			{
				console.log(message);
				var JSONdata    = JSON.parse(message); //parseo la informacion
				console.log(JSONdata);
				switch(JSONdata[0].actualizacion)//que tipo de actualizacion vamos a hacer(un nuevo mensaje, solicitud de amistad nueva, etc )
				{
					case '1':
					actualiza_mensaje(message);
					break;
					case '2':
					actualiza_solicitud(message);
					break;
					
				}
				//aqui se ejecuta toda la accion
				
				
				
				
				
				
			}
	}
};

var Server;
function send( text ) 
{
    Server.send( 'message', text );
}
$(document).ready(function() 
{
	Server = new FancyWebSocket('ws://localhost:12346');
    Server.bind('open', function()
	{
    });
    Server.bind('close', function( data ) 
	{
    });
    Server.bind('message', function( payload ) 
	{
    });
    Server.connect();
});



function actualiza_mensaje(message)
{
	var JSONdata    = JSON.parse(message); //parseo la informacion
	/*
	
	var contenidoDiv  = $("#"+tipo).html();
	var mensajehtml   = fecha+' : '+mensaje;
	$("#"+tipo).html(contenidoDiv+mensajehtml+'<br>');*/
	var tipo = JSONdata[0].tipo;
	var fecha = JSONdata[0].fecha;
	var telefono = JSONdata[0].telefono;
	var id = JSONdata[0].id;
	console.log(id);
	html =   $("<tr data-id='"+id+"'>"+
				"<td >NUEVO</td>"+
				"<td attr='nomb'>-</td>"+
				"<td attr='tel'>"+telefono+"</td>"+
				"<td attr='medio'>IVR</td>"+
				"<td attr='asun'>-</td>"+
				"<td attr='fech'>"+fecha+"</td>"+
				"<td attr='esta'><div class='badge badge-success'>PENDIENTE</div></td>"+
				"<td><div class='block_container'>"+
						"<div class='block'><i class='far fa-edit tooltip-test' title='Editar' style='color: orange'></i>"+
					"</div></div></td></tr>");
	
	html.hide();
	$( html ).prependTo( $( "#tb_contactos" ) );
	html.fadeIn("slow");
	/*
	$('#fechIDLlamada').html(fecha);
	$('#telfIDLlamada').html(telefono);
	$('#modalLlamada').modal('show');*/
	//window.open('http://ejemplo.com/archivo.pdf', '_blank');
	//console.log(base_url);

	fec_send
	var fec_send = JSONdata[0].fec_send;
	var time_send = JSONdata[0].time_send;
	var codigo = JSONdata[0].codigo;

	if (typeof base_url !== 'undefined') {
		console.log('validacion');
		console.log(fecha);
		window.open(base_url + "contacto_call?id="+id+"&tel="+telefono+"&fec="+fec_send+"&time="+time_send+"&codigo="+codigo, "_blank");
	}
}
function actualiza_solicitud()
{
	alert("tipo de envio 2");
}
