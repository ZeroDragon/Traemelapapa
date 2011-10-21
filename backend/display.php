<?include "../clases/login/try.php";
$ordenes = simplexml_load_file("../data/ordenes.xml");
$lasordenes = Array(Array());
foreach($ordenes as $orden){
	$lasordenes[]['lat'] = $orden->lat;
	$lasordenes[count($lasordenes)-1]['lng'] = $orden->lng;
	$lasordenes[count($lasordenes)-1]['name'] = $orden->nombre ." - ".$orden->direccion;
}
unset($lasordenes[0]);
?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<style type="text/css">
  html { height: 100% }
  body { height: 100%; margin: 0px; padding: 0px }
  #map_canvas { height: 100% }
</style>
<script type="text/javascript"
    src="http://maps.google.com/maps/api/js?v=3.3&sensor=true">
</script>
<script type="text/javascript">
var map;
function drawCircle(point, radius) { 
	var d2r = Math.PI / 180;   // degrees to radians 
	var r2d = 180 / Math.PI;   // radians to degrees 
	var earthsradius = 6371; // 3963 is the radius of the earth in miles
	var points = 60; 
	// find the raidus in lat/lon 
	var rlat = (radius / earthsradius) * r2d; 
	var rlng = rlat / Math.cos(point.lat() * d2r); 
	var extp = new Array(); 
	for (var i=0; i < points+1; i++) // one extra here makes sure we connect
	{ 
		var theta = Math.PI * (i / (points/2)); 
		ey = point.lng() + (rlng * Math.cos(theta)); // center a + radius x * cos(theta) 
		ex = point.lat() + (rlat * Math.sin(theta)); // center b + radius y * sin(theta) 
		extp.push(new google.maps.LatLng(ex, ey)); 
	} 
	return extp;
}
function dona(latte, moka, out, inn, color, click){
	var donut = new google.maps.Polygon({
	paths: [drawCircle(new google.maps.LatLng(latte,moka), out),
			drawCircle(new google.maps.LatLng(latte,moka), inn)],
	strokeColor: color,
	strokeOpacity: 0.0,
	strokeWeight: 1,
	fillColor: color,
	fillOpacity: 0.3,
	clickable: click,
	zIndex:0,
	});
	google.maps.event.addListener(donut, 'rightclick', function(event) {
		maker(event.latLng.lat().toString(),event.latLng.lng().toString(),false);
	});
	donut.setMap(map);
}
function alcance(latte,moka){
	var circulo = new google.maps.Circle({ //centro azulito
		center: new google.maps.LatLng(latte, moka), 
		map: map, 
		radius: 2000,
		strokeColor: "#00E",
		strokeOpacity: 0.0,
		strokeWeight: 1,
		fillColor: "#00E",
		fillOpacity: 0.2,
		clickable: true,
		zIndex:0,
	});
	google.maps.event.addListener(circulo, 'rightclick', function(event) {
		maker(event.latLng.lat().toString(),event.latLng.lng().toString(),false);
	});
	dona(latte, moka, 5, 4, "#F00", false); //dona roja
	dona(latte, moka, 4, 3, "#FFE600", true); //dona amarilla
	dona(latte, moka, 3, 2, "#0A0", true); //dona verde
}
function initialize(latte,moka) {
	var latlng = new google.maps.LatLng(latte, moka);
	var myOptions = {
		zoom: 13,
		center: latlng,
		clickable:false,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	alcance(21.161764095633437, -86.83396203173828);
	<?foreach($lasordenes as $ordenes){?>
		maker(<?=$ordenes['lat']?>,<?=$ordenes['lng']?>,'<?=$ordenes['name']?>');
	<?}?>
}
function maker(lat, lon, name){
	latlng = new google.maps.LatLng(lat, lon);
	var marker = new google.maps.Marker({
	position: latlng,
	map: map,
	animation: google.maps.Animation.DROP,
	draggable: false,
	});
	marker.setTitle(name.toString());
}
</script>
</head>
<body onLoad="initialize(21.159292271255293,-86.8460155182129)">
	<div id="map_canvas" style="width:100%; height:100%; float:left;"></div>
</body>
</html>