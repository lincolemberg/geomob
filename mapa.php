<?
//$db = mysqli_connect('sql484.main-hosting.eu', 'u271456575_admin', 'Lin221286', 'u271456575_en9');
$db2 = pg_connect("host=faus.arapiraca.al.gov.br port=5432 dbname=db_faus user=fiscal password=db#f1sc@l@R@19");
if(!$db2){

echo "erro na conexão.";
}



$query = pg_query("SELECT * FROM  objetos ORDER BY id ASC");

$geojson = array('type' => 'FeatureCollection', 'features' => array());
$marker = array ('type' => 'FeatureCollection');

$hoje = date("Y-m-d");
		while($resul = pg_fetch_assoc($query)){
			$latitude = $resul['lat'];
			$longitude  = $resul['log'];
			$titulo  = $resul['responsavel'];
			$anunciante  = $resul['anunciante'];

			$data  = $resul['data'];
			
			$prazo = $resul['prazo'];
			$status = $resul['status'];
			$imagem = $resul['foto'];
			$id = $resul['id'];
			$obs = $resul['obs'];
			
			
			if($status == "irregular")
			$cor = "#f9c638";
			elseif($status == "regular")
			$cor = "#4ab935";
			if($status == "removido")
			$cor = "#000";

			
			
			
		
    $marker = array(
        
        
            'type' => 'Feature',
            "geometry" => array(
                'type' => 'Point',
                'coordinates' => array(
                     
					 (float)$longitude,
					 (float)$latitude
                )), 
			"properties" => array(
				'id' => $id,
				'description' => 'Anunciante: '.$anunciante.' <i title="'.$data.'">'. $prazo.'</i><a href="https://faus.arapiraca.al.gov.br/geomob/outdoors/'.$imagem.'" target="_blank" ><img style="display:block;width:200px;margin:auto;text-aling:center;" 
				src="https://faus.arapiraca.al.gov.br/geomob/outdoors/'.$imagem.'" /></a><p>'.$obs.'</p> <a style="cursor:pointer;" href="https://faus.arapiraca.al.gov.br/geomob/apaga_outdoor.php?id='.$id.'">Excluir</a>',
                'marker-color' => $cor,
				'title' =>  'Responsável: ' .$titulo,
				'rentals' => false,
				'tackleshop' => true,
				"fuel" => true,
				'marker-size' => 'large',
				'marker-symbol' => 'circle'
				
				)
        
    );
    array_push($geojson['features'], $marker);
}


//header('Content-type: application/json');
echo json_encode($geojson); 
?>
