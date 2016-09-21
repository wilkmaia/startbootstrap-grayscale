/*!
 * Start Bootstrap - Grayscale Bootstrap Theme (http://startbootstrap.com)
 * Code licensed under the Apache License v2.0.
 * For details, see http://www.apache.org/licenses/LICENSE-2.0.
 */

// jQuery to collapse the navbar on scroll
function collapseNavbar() {
    if ($(".navbar").offset().top > 50) {
        $(".navbar-fixed-top").addClass("top-nav-collapse");
    } else {
        $(".navbar-fixed-top").removeClass("top-nav-collapse");
    }
}

$(window).scroll(collapseNavbar);
$(document).ready(collapseNavbar);

// jQuery for page scrolling feature - requires jQuery Easing plugin
$(function() {
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });
});

// Closes the Responsive Menu on Menu Item Click
$('.navbar-collapse ul li a').click(function() {
  if ($(this).attr('class') != 'dropdown-toggle active' && $(this).attr('class') != 'dropdown-toggle') {
    $('.navbar-toggle:visible').click();
  }
});

// Google Maps Scripts
var map = null;
var map_x = -5.060500;
var map_y = -42.704806;
// When the window has finished loading create our google map below
google.maps.event.addDomListener(window, 'load', init);
google.maps.event.addDomListener(window, 'resize', function() {
    map.setCenter(new google.maps.LatLng(map_x, map_y));
});

function init() {
    // Basic options for a simple Google Map
    // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
    var mapOptions = {
        // How zoomed in you want the map to start at (always required)
        zoom: 16,

        // The latitude and longitude to center the map (always required)
        center: new google.maps.LatLng(map_x, map_y), // ARLS Caridade II

        // Disables the default Google Maps UI components
        disableDefaultUI: true,
        scrollwheel: false,
        draggable: false,

        // How you would like to style the map. 
        // This is where you would paste any style found on Snazzy Maps.
        styles: [{"elementType":"geometry","stylers":[{"hue":"#ff4400"},{"saturation":-68},{"lightness":-4},{"gamma":0.72}]},{"featureType":"road","elementType":"labels.icon"},{"featureType":"landscape.man_made","elementType":"geometry","stylers":[{"hue":"#0077ff"},{"gamma":3.1}]},{"featureType":"water","stylers":[{"hue":"#00ccff"},{"gamma":0.44},{"saturation":-33}]},{"featureType":"poi.park","stylers":[{"hue":"#44ff00"},{"saturation":-23}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"hue":"#007fff"},{"gamma":0.77},{"saturation":65},{"lightness":99}]},{"featureType":"water","elementType":"labels.text.stroke","stylers":[{"gamma":0.11},{"weight":5.6},{"saturation":99},{"hue":"#0091ff"},{"lightness":-86}]},{"featureType":"transit.line","elementType":"geometry","stylers":[{"lightness":-48},{"hue":"#ff5e00"},{"gamma":1.2},{"saturation":-23}]},{"featureType":"transit","elementType":"labels.text.stroke","stylers":[{"saturation":-64},{"hue":"#ff9100"},{"lightness":16},{"gamma":0.47},{"weight":2.7}]}]
    };

    // Get the HTML DOM element that will contain your map 
    // We are using a div with id="map" seen below in the <body>
    var mapElement = document.getElementById('map');

    // Create the Google Map using out element and options defined above
    map = new google.maps.Map(mapElement, mapOptions);

    // Custom Map Marker Icon - Customize the map-marker.png file to customize your icon
    var image = 'img/map-marker.png';
    var myLatLng = new google.maps.LatLng(map_x, map_y);
    var beachMarker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        //icon: image
    });
}


$("#inputOption").change(function(){
	var opt = $( this ).val();
	
	var e = document.getElementById( "labelBethel" );
	var f = document.getElementById( "inputBethel" );
	var g = document.getElementById( "cargoform" );
	var h = document.getElementById( "camisaform" );
	var i = document.getElementById( "inputCamisa" );
	var j = document.getElementById( "acompanhanteform" );
	
	switch( opt )
	{
		case 'FDJ':
		case 'CONS':
			e.innerHTML = "Bethel";
			f.placeholder = "Bethel";
			g.setAttribute( "style", "display: block;" );
			h.setAttribute( "style", "display: block;" );
			j.setAttribute( "style", "display: none;" );
			i.required = true;
			j.required = false;
			break;
		
		case 'DM':
			e.innerHTML = "Capítulo / Núcleo";
			f.placeholder = "Capítulo / Núcleo";
			g.setAttribute( "style", "display: none;" );
			h.setAttribute( "style", "display: none;" );
			j.setAttribute( "style", "display: none;" );
			i.required = false;
			j.required = false;
			break;
			
		case 'ABEL':
			e.innerHTML = "Colmeia";
			f.placeholder = "Colmeia";
			g.setAttribute( "style", "display: none;" );
			h.setAttribute( "style", "display: block;" );
			j.setAttribute( "style", "display: block;" );
			i.required = true;
			j.required = true;
			break;
			
		default:
			e.innerHTML = "Bethel";
			f.placeholder = "Bethel";
			g.setAttribute( "style", "display: none;" );
			h.setAttribute( "style", "display: block;" );
			j.setAttribute( "style", "display: none;" );
			i.required = true;
			j.required = false;
			break;
	}
});

var mask = null;
	
$("#inputPhone").focusout(function(){
	var masks = ['(99) 9999-9999', '(99) 99999-9999'];
	var raw = $(this).val().replace( /[^0-9]/g, '' );
	
	mask = raw.length <= 10 ? masks[0] : masks[1];
	
	$("#inputPhone").mask( mask );
	$("#inputPhone").val( raw );
});

$("#inputPhone").focusin(function(){
	$(this).unmask();
});

$("#foneContato").focusout(function(){
	var masks = ['(99) 9999-9999', '(99) 99999-9999'];
	var raw = $(this).val().replace( /[^0-9]/g, '' );
	
	mask = raw.length <= 10 ? masks[0] : masks[1];
	
	$(this).mask( mask );
	$(this).val( raw );
});

$("#foneContato").focusin(function(){
	$(this).unmask();
});

$("#form-inscricao").submit(function( e ){
	e.preventDefault();
	
	var nome = $( "#inputName" ).val();
	var tipo = $( "#inputOption" ).val();
	var local = $( "#inputBethel" ).val();
	var numero = $( "#inputNumero" ).val();
	var cargo = $( "#inputCargo" ).val();
	var cidade = $( "#inputCidade" ).val();
	var estado = $( "#inputEstado" ).val();
	var camisa = $( "#inputCamisa" ).val();
	var email = $( "#inputEmail" ).val();
	var telefone = $( "#inputPhone" ).val();
	var acompanhante = $( "#inputAcompanhante" ).val();
	
	// Double check nas variáveis obrigatórias
	if( nome == null || tipo == null || local == null || numero == null ||
		cidade == null || estado == null || email == null || telefone == null )
	{
		document.getElementById( "label-success" ).innerHTML = "Há informações obrigatórias em branco!";
		$( "#form-success" ).fadeIn( 400 );
		setTimeout( function(){ $( "#form-success" ).fadeOut( 400 ) }, 3000 );
		
		return;
	}
	
	$.ajax({
		method: "POST",
		url: "scripts/inscrever.php",
		data: {
			nome: nome,
			tipo: tipo,
			local: local,
			numero: numero,
			cargo: cargo,
			cidade: cidade,
			estado: estado,
			camisa: camisa,
			email: email,
			telefone: telefone,
			acompanhante: acompanhante
		}
	}).success(function( m ){
		var msg;
		if( m == 0 )
			msg = "Houve um erro ao processar sua inscrição.";
		else if( m == 1 )
			msg = "Inscrição realizada com sucesso! Verifique seu e-mail.";
		else
			msg = "E-mail já inscrito no VII COBEPI, em nome de " + m;
		
		console.log( m );
		
		document.getElementById( "label-success" ).innerHTML = msg;
		$( "#form-success" ).fadeIn( 400 );
		setTimeout( function(){ $( "#form-success" ).fadeOut( 400 ); $( "#form-inscricao" )[0].reset(); }, 3000 );
	}).error(function( m ){
		console.error( m );
	});
});


var downloadedEdital = false;

$("#form-concurso").submit( function( e ){
	e.preventDefault();
	
	var email = $( "#emailConcurso" ).val();
	var senha = $( "#senhaConcurso" ).val();
	
	$.ajax({
		method: "POST",
		url: "scripts/inscrever_concurso.php",
		data: {
			email: email,
			senha: senha
		}
	}).success( function( m ){
		m = parseInt( m );
		
		var msg;
		if( m == 1 )
			msg = "Parabéns, Filha! Você foi inscrita para o concurso Miss Filha de Jó!";
		else if( m == 2 )
			msg = "Sua inscrição no concurso já foi realizada.";
		else if( m == 3 )
			msg = "Apenas Filhas podem se inscrever no concurso.";
		else
			msg = "Houve um erro na inscrição. Verifique seus dados e tente novamente.";
	
		document.getElementById( "label-success-concurso" ).innerHTML = msg;
		$( "#form-success-concurso" ).fadeIn( 400 );
		setTimeout( function(){ $( "#form-success-concurso" ).fadeOut( 400 ); $( "#form-concurso" )[0].reset(); }, 3000 );
		
		$( "#submitConcurso" ).prop( 'disabled', true );
	}).error( function( m ){
		console.error( m );
	});
});

$( "#concordoConcurso" ).change(function( m ){
	$( "#submitConcurso" ).prop( 'disabled', !m.target.checked || !downloadedEdital );
});

$( ".edital_concurso" ).click(function( m ){
	downloadedEdital = true;
	$( "#submitConcurso" ).prop( 'disabled', !$( "#concordoConcurso" ).prop( 'checked' ) || !downloadedEdital );
});

$( "#form-contato" ).submit( function( e ){
	e.preventDefault();
	
	var nome = $( "#nomeContato" ).val();
	var assunto = $( "#assuntoContato" ).val();
	var fone = $( "#foneContato" ).val();
	var email = $( "#emailContato" ).val();
	var msg = $( "#mensagemContato" ).val();
	
	$.ajax({
		method: "POST",
		url: "scripts/contato.php",
		data: {
			nome: nome,
			assunto: assunto,
			telefone: fone,
			email: email,
			msg: msg
		}
	}).success( function( m ) {
		alert( "Sua mensagem foi enviada com sucesso. Aguarde nosso contato." );
		$( "#form-contato" )[0].reset();
	}).error( function( m ) {
		alert( "Houve um erro no envio da mensagem." );
	});
});

$(document).ready(function(){
	// Contador de inscrições
	$.ajax({
		method: "POST",
		url: "scripts/contador.php",
		data: {
			t: "FDJ"
		}
	}).success(function( r ){
		var e = document.getElementById( "counter-span" );
		e.innerHTML = r;
	});
	
	// Checa se vem do pagamento de isncrição
	var s = window.location.href.split("?");
	if( s.length == 1 )
		return;
	
	q = s[1].split("&");
	
	var email;
	var id;
	q.forEach(function( m ){
		m = m.split("=");
		
		if( m[0] == null )
			return;
		
		if( m[0] == "email" )
			email = m[1];
		else if( m[0] == "transaction_id" )
			id = m[1];
	});
	
	if( email != null && id != null )
	{
		$.ajax({
			method: "POST",
			url: "scripts/setPagSeguroCode.php",
			data: {
				email: email,
				id: id
			}
		}).success(function(){
			alert( "Pagamento da inscrição efetuado com sucesso!" );
			window.location.href = s[0];
		});
	}
});


var slideIndex = 0;
loadSlideshow();
function loadSlideshow()
{
	path = 'img/slideshow';
	$.getJSON( "scripts/listSlideshow.php", function( data ){
		var el = document.getElementById( "slideshow" );
		
		$.each( data, function( k, val ) {
			i = '<img class="mySlides" src="img/slideshow/'+ val +'" style="max-width: 100%; max-height: 500px; margin-left: auto; margin-right: auto; display: none;" />';
			el.innerHTML += i;
		});
	}).done(function(){
		carousel();
	});
}

function carousel()
{
	var el = document.getElementById( "slideshow" );
	var x = document.getElementsByClassName( "mySlides" );
	
	slideIndex++;
	if( slideIndex > x.length )
	{
		slideIndex = 1;
		x[x.length - 1].style.display = "none";
	}
	
	if( slideIndex != 1 )
		x[slideIndex - 2].style.display = "none";
	
	x[slideIndex - 1].style.display = "block";
	setTimeout( carousel, 3000 );
	
	//console.log( slideIndex );
}