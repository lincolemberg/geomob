<html>
<head>
<meta charset=utf-8 />
<title>Mapa dos Resíduos</title>
<meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
<script src='js/mapbox-gl.js'></script>
<link href='css/mapbox-gl.css' rel='stylesheet' />

<script src='https://unpkg.com/@turf/turf@6/turf.min.js'></script>

<style>


  body { margin:0; padding:0; background-color: #343a40;}
  #map { position:absolute; top:0; bottom:0; width:100%; }
  .leaflet-top {
    margin-top: 100px;
}
#tit{
position:absolute;
z-index:1;
top:15px;
left:10px;
color: #007bff;	
}

#voltar{
position:absolute;
z-index:1;
top:10px;
left:90px;
color:#fff;	
}

	.coordinates {
        background: rgba(0, 0, 0, 0.5);
        color: #fff;
        position: absolute;
        bottom: 40px;
        left: 10px;
        padding: 5px 10px;
        margin: 0;
        font-size: 11px;
        line-height: 18px;
        border-radius: 3px;
        display: none;
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

<div id='map'><label id="tit">Modo Edição</label> <a  id="voltar" style="color: #272727" href="javascript:history.back()" class="btn btn-warning">Voltar</a>

</div>
<pre id="coordinates" class="coordinates"></pre>
<script>
	mapboxgl.accessToken = 'pk.eyJ1IjoibGluY29ubGVtYmVyZyIsImEiOiJja2wwdjluaTE1emM5MnBwZGoxenl5cXF2In0.1ITG-7frmivt-Ejxp0rhug';
    const coordinates = document.getElementById('coordinates');

	
	<?
if(isset($_GET['lat']) and isset($_GET['lon'])){
?>
	    const map = new mapboxgl.Map({
        container: 'map',
        // Choose from Mapbox's core styles, or make your own style with Mapbox Studio
        style: 'mapbox://styles/mapbox/streets-v12',
        center: [<?=$_GET['lon']?>, <?=$_GET['lat']?>],
        zoom: 13
    });
	

<?
}else{
?>
	const map = new mapboxgl.Map({
        container: 'map',
        // Choose from Mapbox's core styles, or make your own style with Mapbox Studio
        style: 'mapbox://styles/mapbox/streets-v12',
        center: [-36.660290, -9.751450],
        zoom: 13
    });

	
<?
	 }
?>
	


    const canvas = map.getCanvasContainer();


    const geojson = <? include("mapa.php")?>;

    var bbox = turf.bbox(geojson);

    function onMove(e) {
        const coords = e.lngLat;
		
        // Set a UI indicator for dragging.
        canvas.style.cursor = 'grabbing';

        // Update the Point feature in `geojson` coordinates
        // and call setData to the source layer `point` on it.
    for (const feature of geojson.features) {
    var to = feature.geometry.coordinates;
    
    var from = [coords.lng, coords.lat];

    var options = {units: 'meters'};

    var distance = turf.distance(from, to, options);
    if(distance < 3) {
        feature.geometry.coordinates = [coords.lng, coords.lat];
        continue;
		
}
}
		
        map.getSource('point').setData(geojson);
        

    }

    function onUp(e) {
        const coords = e.lngLat;
      

        // Print the coordinates of where the point had
        // finished being dragged to on the map.
        coordinates.style.display = 'block';



        coordinates.innerHTML = `Longitude: ${coords.lng}<br />Latitude: ${coords.lat}`;
        canvas.style.cursor = '';
        
        // Unbind mouse/touch events
        map.off('mousemove', onMove);
        map.off('touchmove', onMove);

        for (const feature of geojson.features) {
    var to = feature.geometry.coordinates;
    
    var from = [coords.lng, coords.lat];

    var options = {units: 'meters'};

    var distance = turf.distance(from, to, options);
    if(distance < 2) {
        $.ajax({
            method: "POST",
            url: "editar_outdoor.php",
            data: { lat: coords.lat, log: coords.lng, idd: feature.properties.id },
            beforeSend : function(){
          $("#tit").html("Aguarde...");
     }
            }).done(function(msg){
                if(msg==1){
                    alert('Objeto alterado com sucesso!');
                    $("#tit").html("Modo Edição");
                }
});
        break;
		
}
}

    }
    
    map.on('load', () => {
        // Add a single point to the map.
        map.addSource('point', {
            'type': 'geojson',
            'data': geojson
        });
        
        map.addLayer({
            'id': 'point',
            'type': 'circle',
            'source': 'point',
            'paint': {
                'circle-radius': 15,
                'circle-color': '#007bff'
            }
        });
        

        // When the cursor enters a feature in
        // the point layer, prepare for dragging.
        map.on('mouseenter', 'point', () => {
            canvas.style.cursor = 'move';
        });

        map.on('mouseleave', 'point', () => {
            canvas.style.cursor = '';
        });

        map.on('mousedown', 'point', (e) => {
            // Prevent the default map drag behavior.
            e.preventDefault();

            canvas.style.cursor = 'grab';

            map.on('mousemove', onMove);
            map.once('mouseup', onUp);
        });

        map.on('touchstart', 'point', (e) => {
            if (e.points.length !== 1) return;

            // Prevent the default map drag behavior.
            e.preventDefault();

            map.on('touchmove', onMove);
            map.once('touchend', onUp);
        });
    });

	
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