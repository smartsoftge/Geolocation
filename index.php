<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Geolocation - finds your current location and displays directions to get to Alexanderplatz, Berlin - robertnyman.com</title>
	<link rel="stylesheet" href="css.css" type="text/css" media="screen">
	<style>
		#map-container {
			overflow: hidden;
		}
		#map {
			float: left;
			width: 100%;
			height: 500px;
			margin: 50px auto;
		}
		#map-directions {
			float: right;
			width: 38%;
			padding-left: 2%;
		}
	</style>
	<!--[if lte IE 8]>
		<script src="../js/html5.js"></script>
	<![endif]-->
</head>

<body>
	
	<div id="container">
		 
		
		<div role="main">
			<section id="main-content">
				
				<div id="map-container">
					<div id="map"></div>
					<div id="map-directions"></div>
				</div>

				<script src="http://maps.google.se/maps/api/js?sensor=false"></script>
				<script>
					(function () {
						var directionsService = new google.maps.DirectionsService(),
							directionsDisplay = new google.maps.DirectionsRenderer(),
							createMap = function (start) {
								var travel = {
										origin : (start.coords)? new google.maps.LatLng(start.lat, start.lng) : start.address,
										destination : "vaja-phavela, Tbilisi",
										travelMode : google.maps.DirectionsTravelMode.DRIVING
										// Exchanging DRIVING to WALKING above can prove quite amusing :-)
									},
									mapOptions = {
										zoom: 10,
										// Default view: downtown Stockholm
										center : new google.maps.LatLng(41.75044, 44.78500),
										mapTypeId: google.maps.MapTypeId.ROADMAP
									};

								map = new google.maps.Map(document.getElementById("map"), mapOptions);
								directionsDisplay.setMap(map);
								directionsDisplay.setPanel(document.getElementById("map-directions"));
								directionsService.route(travel, function(result, status) {
									if (status === google.maps.DirectionsStatus.OK) {
										directionsDisplay.setDirections(result);
									}
								});
							};

							// Check for geolocation support	
							if (navigator.geolocation) {
								navigator.geolocation.getCurrentPosition(function (position) {
										// Success!
										createMap({
											coords : true,
											lat : position.coords.latitude,
											lng : position.coords.longitude
										});
									}, 
									function () {
										// Gelocation fallback: Defaults to Stockholm, Sweden
										createMap({
											coords : false,
											address : "Sveavägen, Stockholm"
										});
									}
								);
							}
							else {
								// No geolocation fallback: Defaults to Lisbon, Portugal
								createMap({
									coords : false,
									address : "Lisbon, Portugal"
								});
							}
					})();
				</script>

				 

			</section>
		</div>
		
	 
	
	
</body>
</html>
