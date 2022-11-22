<?
//$db = mysqli_connect('sql484.main-hosting.eu', 'u271456575_admin', 'Lin221286', 'u271456575_en9');
$db = mysqli_connect('sql793.main-hosting.eu', 'u830389020_geomob', '@Linco221286', 'u830389020_geomob');

$query = mysqli_query($db, "SELECT * FROM  objetos ORDER BY id ASC")or die(mysqli_error());
$qtd = mysqli_num_rows($query);
$qtd = $qtd + 1;
$classificacao = $_POST['classificacao'];
$entulho = "Entulho ". $qtd. " ".$classificacao;
$titulo = $_POST['responsavel'];
$prazo = $_POST['prazo'];
$gerador = $_POST['gerador'];
$vistoria = $_POST['vistoria'];
$imovel = $_POST['imovel'];
$prox_gerador = $_POST['prox_gerador'];
$obs = $_POST['obs'];
$cidade = $_POST['cidade'];
$rua = $_POST['rua'];
$numero = $_POST['numero'];
$bairro = $_POST['bairro'];
$cep = $_POST['cep'];
$data = date("d/m/Y");
$lat = $_POST['lat'];
$log = $_POST['log'];
$cpf_cnpj = $_POST['cpf_cnpj'];

function distancia($lat1, $lon1, $lat2, $lon2) {

$lat1 = deg2rad($lat1);
$lat2 = deg2rad($lat2);
$lon1 = deg2rad($lon1);
$lon2 = deg2rad($lon2);

$dist = (6371 * acos( cos( $lat1 ) * cos( $lat2 ) * cos( $lon2 - $lon1 ) + sin( $lat1 ) * sin($lat2) ) );
$dist = number_format($dist, 3, '.', '');
return $dist;
}

while($resul = mysqli_fetch_assoc($query)){
	$resul['lat'];
	$resul['log'];
$reincidencia =  distancia((float)$lat,(float)$log,$resul['lat'],$resul['log']);


	if($prox_gerador=="nao"){
		if($reincidencia <= 0.008)
		//mysql
		$reincidencia = "sim";
		else
		$reincidencia = "nao";

	}
	// 0.92 Km
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
        $novoNome = $entulho.'.' . $extensao;
 		$imagem = $novoNome;
        // Concatena a pasta com o nome
		chmod ("entulhos_fotos/", 0777);
        $destino = 'entulhos_fotos/' . $novoNome;
 
        // tenta mover o arquivo para o destino
        if ( @move_uploaded_file ( $arquivo_tmp, $destino ) ) {
		

            
		$query2 = mysqli_query($db, "INSERT INTO objetos (lat, log, responsavel, titulo, cpf_cnpj, descricao, data, classificacao, 
		prazo, arquivo, gerador, vistoria, imovel, prox_gerador, cidade, rua, numero, bairro, cep, reincidencia) VALUES ('$lat', '$log', '$titulo', '$entulho', '$cpf_cnpj',
		'$obs', '$data', '$classificacao', '$prazo', '$imagem', '$gerador', '$vistoria', '$imovel', '$prox_gerador', '$cidade', '$rua', '$numero', '$bairro', '$cep', '')")or die(mysqli_error());
		
		//imagem enviada			
			header("location: entulhos.php");
        }
        else
            echo 'Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.<br />';
    }
    else
        echo 'Você poderá enviar apenas arquivos "*.jpg;*.jpeg;*.gif;*.png"<br />';
}
else
    echo 'Você não enviou nenhum arquivo!';
