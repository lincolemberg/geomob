<?
//$db = mysqli_connect('sql484.main-hosting.eu', 'u271456575_admin', 'Lin221286', 'u271456575_en9');
$db = mysqli_connect('sql793.main-hosting.eu', 'u830389020_geomob', '@Linco221286', 'u830389020_geomob');


$query = mysqli_query($db, "SELECT * FROM  objetos ORDER BY id ASC")or die(mysqli_error());

$geojson = array('type' => 'FeatureCollection', 'features' => array());
$marker = array ('type' => 'FeatureCollection');

$hoje = date("Y-m-d");
		while($resul = mysqli_fetch_assoc($query)){
			$latitude = $resul['lat'];
			$longitude  = $resul['log'];
			$processo  = $resul['descricao'];
			$gerador = $resul['gerador'];
			$titulo  = $resul['titulo'];
			$data  = $resul['data'];
			$status = $resul['classificacao'];
			$prazo = $resul['prazo'];
			$reincide = $resul['reincidencia'];
			$imagem = $resul['arquivo'];
			$id = $resul['id'];
			
			
			if((strtotime($prazo) >= strtotime($hoje)) and $reincide == "sim")
			$cor = "#f9c638";
			elseif(strtotime($prazo) >= strtotime($hoje))
			$cor = "#4ab935";
			if(strtotime($prazo) < strtotime($hoje))
			$cor = "#e43232";
			if(strtotime($prazo) < strtotime($hoje) and $gerador == "grande gerador")
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
                'marker-color' => $cor,
				'title' =>  $titulo . ' - <i>'. $gerador.'</i><img style="display:block;width:100px;margin:auto;text-aling:center;" 
				src="https://'.$_SERVER['SERVER_NAME'].'/geomob/entulhos_fotos/'.$imagem.'" /><a style="cursor:pointer;" href="https://'.$_SERVER['SERVER_NAME'].'/geomob/apaga_entulho.php?arq='.$imagem.'&id='.$id.'">EXCLUIR</a>',
				'rentals' => false,
				'tackleshop' => true,
				"fuel" => true,
				'marker-size' => 'large',
				'marker-symbol' => 'circle'
				
				)
        
    );
    array_push($geojson['features'], $marker);
}


header('Content-type: application/json');
echo json_encode($geojson); 
?>
