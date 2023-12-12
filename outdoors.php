<html>
<head>
<meta charset=utf-8 />
<title>Mapa dos Resíduos</title>
<meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
<script src='https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.js'></script>
<link href='https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.css' rel='stylesheet' />
<style>


  body { margin:0; padding:0; background-color: #343a40;}
  #map { position:absolute; top:0; bottom:0; width:100%; }
  .leaflet-top {
    margin-top: 100px;
}
#voltar{
position:absolute;
z-index:1;
top:10px;
left:10px;
color:#fff;	
}

</style>
<link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' rel='stylesheet' />
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-locatecontrol/v0.43.0/L.Control.Locate.min.js'></script>
<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-locatecontrol/v0.43.0/L.Control.Locate.mapbox.css' rel='stylesheet' />
<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-locatecontrol/v0.43.0/css/font-awesome.min.css' rel='stylesheet' />

</head>
<body>
<!--[if lt IE 9]>
<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-locatecontrol/v0.43.0/L.Control.Locate.ie.css' rel='stylesheet' />
<![endif]-->

<div id='map'> <a  id="voltar" style="color: #272727" href="javascript:history.back()" class="btn btn-warning">Voltar</a>
>
</div>

<script>

L.mapbox.accessToken = 'pk.eyJ1IjoibGluY29ubGVtYmVyZyIsImEiOiJja2wwdjluaTE1emM5MnBwZGoxenl5cXF2In0.1ITG-7frmivt-Ejxp0rhug';
<?
if(isset($_GET['lat']) and isset($_GET['lon'])){
?>
var map = L.mapbox.map('map')
    .setView([ <?=$_GET['lat']?>, <?=$_GET['lon']?>], 21)
    .addLayer(L.mapbox.styleLayer('mapbox://styles/mapbox/navigation-night-v1'));<?
}else{
?>
var map = L.mapbox.map('map')
    .setView([ -9.751450, -36.660290], 13)
    .addLayer(L.mapbox.styleLayer('mapbox://styles/mapbox/navigation-night-v1'));
<?
	 }
?>
// As with any other AJAX request, this technique is subject to the Same Origin Policy:
// http://en.wikipedia.org/wiki/Same_origin_policy
// So the CSV file must be on the same domain as the Javascript, or the server
// delivering it should support CORS.

		
		 var featureLayer = L.mapbox.featureLayer()
    .loadURL('mapa.php')
    .addTo(map);
L.control.locate().addTo(map);
</script>

</body>
<style>
.mapboxgl-ctrl-bottom-left, .mapboxgl-ctrl-bottom-right, .leaflet-right{
	display:none !important;
}
	/*
.leaflet-left{
	
display:none !important;	
}
	*/
</style>
</html>