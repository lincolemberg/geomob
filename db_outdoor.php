<?
//$db = mysqli_connect('sql484.main-hosting.eu', 'u271456575_admin', 'Lin221286', 'u271456575_en9');
$db2 = pg_connect("host=faus.arapiraca.al.gov.br port=5432 dbname=db_faus user=fiscal password=db#f1sc@l@R@19");
if(!$db2){

echo "erro na conexão.";
}

$query = pg_query("SELECT * FROM  objetos ORDER BY id ASC");
$qtd = pg_num_rows($query);
$qtd = $qtd + 1;
$objeto = "outdoor";
$titulo = $_POST['responsavel'];
$anunciante = $_POST['anunciante'];
$bloco = $_POST['bloco']? $_POST['bloco']: 0;
$prazo = $_POST['prazo'];
$cnpj = $_POST['cpf_cnpj']?$_POST['cpf_cnpj']: 0;
$obs = $_POST['obs'];
$cidade = $_POST['cidade'];
$rua = $_POST['rua'];
$numero = $_POST['numero'];
$bairro = $_POST['bairro'];
$cep = $_POST['cep']?$_POST['cep']:0;
$data = strtotime('now');
$lat = $_POST['lat'];
$log = $_POST['log'];
//Status: irregular, removido, regular
$status = 'irregular';

function distancia($lat1, $lon1, $lat2, $lon2) {
$lat1 = floatval($lat1);
$lat2 = floatval($lat2);
$lon1 = floatval($lon1);
$lon2 = floatval($lon2);
	
$lat1 = deg2rad($lat1);
$lat2 = deg2rad($lat2);
$lon1 = deg2rad($lon1);
$lon2 = deg2rad($lon2);

$dist = (6371 * acos( cos( $lat1 ) * cos( $lat2 ) * cos( $lon2 - $lon1 ) + sin( $lat1 ) * sin($lat2) ) );
$dist = number_format($dist, 3, '.', '');
return $dist;
}
if(pg_num_rows($query)!=0){
while($resul = pg_fetch_assoc($query)){
	$resul['lat'];
	$resul['log'];
$vertice =  distancia((float)$lat,(float)$log,$resul['lat'],$resul['log']);


	
		if($vertice <= 150)
		//mysql
		$zona = "zona_restrita";
		else
		$zona = "ok";

	
	// 0.92 Km
}
}else{
    $zona = "ok"; 
}


/******
 * Upload de imagens
 ******/

	
// verifica se foi enviado um arquivo
if ( isset( $_FILES[ 'arqui' ])) {
    $arquivo_tmp = $_FILES[ 'arqui' ][ 'tmp_name' ];
    $nome = $_FILES[ 'arqui' ][ 'name' ];
 
    // Pega a extensão
    $extensao = pathinfo ( $nome, PATHINFO_EXTENSION );
 
    // Converte a extensão para minúsculo
    $extensao = strtolower ( $extensao );
 
    // Somente imagens, .jpg;.jpeg;.gif;.png
    // Aqui eu enfileiro as extensões permitidas e separo por ';'
    // Isso serve apenas para eu poder pesquisar dentro desta String
    if ( strstr ( '.jpg;.jpeg;.gif;.png', $extensao ) ) {
        // Cria um nome único para esta imagem
        // Evita que duplique as imagens no servidor.
        // Evita nomes com acentos, espaços e caracteres não alfanuméricos
        $novoNome = strtotime('now').'.' . $extensao;
 		$imagem = $novoNome;
        // Concatena a pasta com o nome
        $diretorio = "outdoors/";
        if (!file_exists($diretorio)){
            mkdir($diretorio, 0777);
            }
        $destino = $diretorio . $novoNome;
 
		function compressImage($source_path, $destination_path, $quality) {
    $info = getimagesize($source_path);

    if ($info['mime'] == 'image/jpeg') {
        $image = imagecreatefromjpeg($source_path);
    } elseif ($info['mime'] == 'image/png') {
        $image = imagecreatefrompng($source_path);
    }

    imagejpeg($image, $destination_path, $quality);

    return $destination_path;
}
	$img = compressImage($arquivo_tmp, $destino, 4);
        // tenta mover o arquivo para o destino
        if ( $img  ) {
		

		$query2 = pg_query("INSERT INTO objetos (lat, log, responsavel, objeto, bloco, prazo, cnpj, foto, obs, cidade, rua, numero, bairro, cep, status, vertice, data, anunciante) VALUES ('$lat', '$log', '$titulo', '$objeto', $bloco, '$prazo',
		$cnpj, '$imagem', '$obs', '$cidade', '$rua', '$numero', '$bairro', $cep, '$status', '$zona', '$data', '$anunciante')");
		
		//imagem enviada			
			header("location: outdoors.php");
        }
        else
            echo 'Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.<br />';
    }
    else
        echo 'Você poderá enviar apenas arquivos "*.jpg;*.jpeg;*.gif;*.png"<br />';
}
else
    echo 'Você não enviou nenhum arquivo!';
