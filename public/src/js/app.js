
(function($, document, window){
	
	$(document).ready(function(){
		$( ".subscribe-form" ).on( "submit", function( event ) {
			event.preventDefault();
			let data = $( this ).serialize();
			$.ajax({
				type: "POST",
				url: "/handle/subscriber",
				data:data,
				success:function(message){
					return swal(message.header, message.ms, message.type);
				}
			});
		  });
		  $( ".contact-form" ).on( "submit", function( event ) {
			event.preventDefault();
			let data = $( this ).serialize();
			$.ajax({
				type: "POST",
				url: "/handle/contact",
				data:data,
				success:function(message){
					alert('We will definitely contact you!','success');
				}
			});
		  });
		$( ".find-location" ).on( "submit", function( event ) {
			event.preventDefault();
			let data = $( this ).serialize();
			$.ajax({
				type: "POST",
				url: "/get/weather/about/city",
				data:data,
				success:function(message){
					$.map(message.weather.daily, function (weather){
						console.log(weather);
						let timestamp = message.weather.current.dt * 1000;
						let timestamp_today = new Date(timestamp);
						let today = timestamp_today.toLocaleString();
						today = today.split([',']);
						let temp = (((weather.temp.max - 32) * 5) / 9);
						let temp_night = (((weather.temp.min - 32) * 5) / 9);
						let milliseconds = weather.dt * 1000;
						let dateObject = new Date(milliseconds);
						let humanDateFormat = dateObject.getDay();
						let days = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];
						$('.location').html(message.cityName);
						$('#day' +humanDateFormat).html(days[humanDateFormat]);
						$('#degree' +humanDateFormat).html(Math.round(temp)+'<sup>o</sup>C');
						$('#degree_at_night' +humanDateFormat).html(Math.round(temp_night)+'<sup>o</sup>C');
						$('#date1').html(today[0]);
					});
				}
			});
		});
		// Cloning main navigation for mobile menu
		$(".mobile-navigation").append($(".main-navigation .menu").clone());

		// Mobile menu toggle 
		$(".menu-toggle").click(function(){
			$(".mobile-navigation").slideToggle();
		});

		var map = $(".map");
		var latitude = map.data("latitude");
		var longitude = map.data("longitude");
		if( map.length ){
			
			map.gmap3({
				map:{
					options:{
						center: [latitude,longitude],
						zoom: 15,
						scrollwheel: false
					}
				},
				marker:{
					latLng: [latitude,longitude],
				}
			});
			
		}
	});

	$(window).load(function(){

	});

})(jQuery, document, window);






document.addEventListener('DOMContentLoaded', () => {

	let myBtns=document.querySelectorAll('.menu-item');
	myBtns.forEach(function(btn) {

		btn.addEventListener('click', () => {
			myBtns.forEach(b => b.classList.remove('current-menu-item'));
			btn.classList.add('current-menu-item');
		});

	});

});
