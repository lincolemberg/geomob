<?
$db2 = pg_connect("host=faus.arapiraca.al.gov.br port=5432 dbname=db_faus user=fiscal password=db#f1sc@l@R@19");
if(!$db2){

echo "erro na conexão.";
}
?>
<html>
<head>
<meta charset=utf-8 />
<title>Geomapeamento de Objetos - Entulhos</title>
<meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-locatecontrol/v0.43.0/css/font-awesome.min.css' rel='stylesheet' />
	<link rel="stylesheet" href="js/https@cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	
<link href="css/fontawesome/fontfree/css/all.css" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
<link rel="stylesheet" href="../css/adminlte.min.css">
	
	<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	
<!-- Turf & Polyline -->
<style>

body {
    font-family: 'Lato', sans-serif;
	background-color: #343a40;
}

h1 {
    margin-bottom: 40px;
}

label {
    color: #333;
}

.btn-send {
    font-weight: 300;
    text-transform: uppercase;
    letter-spacing: 0.2em;
    width: 80%;
    margin-left: 3px
}

.help-block.with-errors {
    color: #ff5050;
    margin-top: 5px
}

.card {
    margin-left: 10px;
    margin-right: 10px
}
.col-md-12 input{
	margin: 10px 0;
	width:100px;	
	
}
label{
	font-weight:bold;
}
</style>
</head>
<body>

</body>
	 <div class="preloader flex-column justify-content-center align-items-center">
    <div  style="font-size: 2em;position: absolute;display: flex;margin: auto;top:25%;color: #1D1D1D">Geomob</div>
    <div id="bm" style="font-size: 2em"></div>
  </div>
<div class="container">
 <div class=" text-center mt-5 ">

        <h2 style="color:#fff">Mapeamento de Outdoors de Arapiraca</h2>
        <h5 style="color:#fff">Secretaria de Desenvolvimento Urbano e Meio Ambiente - SEDUMA</h5>
        <h5 style="color:#fff">Setor de Fiscalização</h5>
    </div>

    <div class="row">
        <div class="col-lg-7 mx-auto">
            <div class="card mt-2 mx-auto p-4 bg-light">
                <div class="card-body bg-light">
                    <div class="container">
                        <form id="contact-form" action="db_outdoor.php" enctype="multipart/form-data" method="post">
                            <div class="controls">
                                <div class="row">
									 <div class="col-md-6">
										 
                                        <div class="form-group" id="muda_campo"> <label for="form_name">Responsável *</label> 
											<select onChange="muda_cnpj(event)"  class="form-control" id="responsavel" name="responsavel">
												
											  <?
												$q2 = pg_query("SELECT DISTINCT responsavel, cnpj FROM objetos WHERE responsavel != ''");
												while($r = pg_fetch_assoc($q2)){
												?>
											  <option value="<?=$r['cnpj']?>"><?=$r['responsavel']?></option>
											  <?
												}
												?>
											  <option value="outro">Outro</option>
											</select>
											</div>
                                    </div>
									
                                    <div class="col-md-6">
                                        <div class="form-group"> <label for="form_name">Anunciante *</label> <input  id="anunciante" type="text" name="anunciante" class="form-control" placeholder="Anunciante" > </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"> <label for="form_name">Telefone </label> <input pattern="\d*"  id="tel" type="number" name="tel" class="form-control" placeholder="Digite os números" > </div>
                                    </div>
									 <div class="col-md-6">
                                        <div class="form-group"> <label for="form_name">Número do Bloco </label> <input pattern="\d*"  id="bloco" type="number" name="bloco" class="form-control" placeholder="Digite os números" > </div>
                                    </div>
                                    <div class="col-md-6">
										<label for="form_name">Termo gerado</label>
                                        <select class="form-control">
											  <option value="">Selecionar</option>
											  <option value="notificacao">Notificação</option>
											  <option value="auto">Auto de Infração</option>
											</select>
                                    </div>
								
                                <div class="form-group col-md-6">
                              <label for="inputEmail4">Foi dado algum prazo?</label>
                              <input style="height:40px;" type="date" class="form-control" id="prazo"   name="prazo" >
                               </div>
                                <div class="col-md-6">
                                        <div class="form-group"> <label for="form_name">CNPJ </label> <input pattern="\d*"  id="cpf_cnpj" type="number" name="cpf_cnpj" class="form-control" placeholder="Digite os números" > </div>
                                </div>
                                </div>
                                <div class="row" >
                                    <div class="col-md-6" style="display: block; margin: auto;text-align: center;">
                                        <div class="form-group"> <label for="form_email">Imagem</label> 
                                        <div id="checado">
                                        <input onChange="muda_imagem();" type="file" name="arqui" accept="image/x-png,image/gif,image/jpeg" id="arquivo"  style="display:none"  required="required" />
                                        <button onClick="envia_imagem();" type="button" for="arquivo"  class="btn btn-info btn-send" id="upload"><i style="font-size:3em" class="fas fa-upload"></i></button> 
                                        </div>
                                        </div>
                                    </div>
                                
                                 
                                
                                <div class="row">
									<div class="form-group row">
										<label for="form_message">Observações</label>
										<textarea id="obs" name="obs"  class="form-control"  rows="3"></textarea>
									  </div>
							 
                                    <div class="col-md-12"><label for="form_message"> Coordenadas *</label><br>
                                    <label for="form_need"> Latitude:</label>
                                    <input type="text" name="lat" id="lat" required="required" class="form-control" style="width:200px;" />
                                    <label for="form_need"> Longitude:</label>
                                    <input type="text" name="log" id="log" required="required"  class="form-control" style="width:200px;" />
                                   
                                    <label for="form_need"> Cidade:</label>
                                    <div><input type="text" name="cidade" id="Incidade" class="form-control" style="width:200px"  /></div>
                                    

                                    <label for="form_need">Rua</label>
                                    <div><input style="display:block;width:200px;" type="text" name="rua" id="Inrua" class="form-control"   /></div>
                                    
                                     <label for="form_need">Número</label>
                                     <div><input  id="Innumero" type="text" name="numero" class="form-control"></div>

                                    <label for="form_need">Bairro</label>
                                    <div><input type="text" name="bairro" id="Inbairro" class="form-control" style="width:200px"  /></div>
                                     
                                    <br>
                                    <label for="form_need">CEP</label>
                                    <div><input type="text" name="cep" id="Incep" class="form-control" style="width:150px"  /></div>
                                    <br>
                                    
                                    <button onClick="getLocationUpdate()" type="button" style="margin:auto;text-align:center;" id="localizacao" class="btn btn-dark btn-send btn-block "> <i  style="font-size:3em;display:block;margin:auto;"class="far fa-compass"></i></button></div>
                                    <div class="col-md-12"> <input id="salvar" name="salvar" type="submit" class="btn btn-success btn-send pt-2 btn-block " value="Salvar"> </div>
                                </div>
                            </div>
                        </form>
							
                    </div>
						
			
						
                </div>
					
            </div> <!-- /.8 -->
				
        </div> <!-- /.row-->
		<div class="col-md-15">

          <!-- /.card -->
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Últimos 15</h3>

              <div class="card-tools" style="margin-top: 10px">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0 overflow-auto" style="display: block;">
              <table class="table">
                <thead>
                  <tr>
                    <th>Data</th>
                    <th>Resp./Anunc.</th>
                    <th>Observações</th>
					<th>Endereço</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
				<?
				if(@$_GET['pag'])
				$qtd = 1 * $_GET['pag'];
				else
				$qtd = 1;
					
				// Número de artigos por página
				$artigos_por_pagina = 15;

				// Página atual onde vamos começar a mostrar os valores
				$pagina_atual = ! empty( $_GET['pag'] ) ? (int) $_GET['pag'] : 0;
				$pagina_atual = $pagina_atual * $artigos_por_pagina;
					
					$query = pg_query("SELECT * FROM objetos ORDER BY id DESC LIMIT $artigos_por_pagina OFFSET $pagina_atual ");
					while($res = pg_fetch_assoc($query)){
						/*lat, log, responsavel, objeto, bloco, prazo, cnpj, foto, obs, cidade, rua, numero, bairro, cep, status, vertice, dat*/
				?>
                  <tr>
                    <td><buttton class="btn bnt-primary"><?=date("d/m/Y H:i:s", $res['data'])?></buttton></td>
                    <td><?=$res['responsavel']?></td>
					<td><?=$res['obs']?></td>
                    <td><?=$res['rua']?>, nº <?=$res['numero']?>, <?=$res['bairro']?>, <?=$res['cidade']?>, CEP: <?=$res['cep']?>. </td>
                    <td class="text-right py-0 align-middle">
                      <div class="btn-group btn-group-md">
						  <? if($res['status']=='regular'){ ?>
                        <a href="#regulariza" id="regular_<?=$res['id']?>"class="btn btn-success regularizado"><i class="fas fa-check-square"></i></a>
						   <? }else{ ?>
                        <a href="#regulariza" id="regular_<?=$res['id']?>" class="btn btn-primary regularizado"><i class="fas fa-check-square"></i></a>
						 <? } ?>

						  <? if($res['status']=='removido'){ ?>
                        <a href="#remove" id="remove_<?=$res['id']?>"   class="btn btn-secondary  removido"><i class="fas fa-trash-restore-alt" title="removido"></i></a>
                        <? }else{ ?>
                        <a href="#remove" id="remove_<?=$res['id']?>"   class="btn btn-danger  removido"><i class="fas fa-trash-restore-alt" title="Marcar como retirado"></i></a>
						 <? } ?>
						<a href="outdoors.php?lat=<?=$res['lat']?>&lon=<?=$res['log']?>" class="btn btn-info "><i class="fas fa-eye" title="visualizar"></i></a>
                      </div>
                    </td>
                  </tr>
				<?
					}
				?>
				 </tbody>
              </table>
            </div>
			  <?
$q = pg_query("SELECT * FROM objetos");
 $total_artigos = pg_num_rows($q);

			  function paginacao( 
    $total_artigos = 0, 
    $artigos_por_pagina = 15, 
    $offset = 5
) {    
    // Obtém o número total de página
    $numero_de_paginas = floor( $total_artigos / $artigos_por_pagina );
    
    // Obtém a página atual
    $pagina_atual = 0;
    
    // Atualiza a página atual se tiver o parâmetro pagina=n
    if ( ! empty( $_GET['pag'] ) ) {
        $pagina_atual = (int) $_GET['pag'];
    }
    
    // Vamos preencher essa variável com a paginação
    $paginas = null;
	if(isset($_GET['pag'])){
		$pg3 = $_GET['pag'];
		if($pg3 == $numero_de_paginas)
		$pg3 = $pg3;
				

		if($_GET['pag']==0)
		$pg4 = 1;
		else
		$pg4 = $_GET['pag'];
	}else{
	$pg4 = 1;
	$pg3 = 0;
	}
    // Primeira página
    $paginas .= "<li class='page-item'><a class='page-link' href='?pag=".(@$pg4-1)."'>«</a></li>";
    
    // Faz o loop da paginação
    // $pagina_atual - 1 da a possibilidade do usuário voltar
	$a = 1;
    for ( $i = ( $pagina_atual - 1 ); $i < ( $pagina_atual - 1 ) + $offset; $i++ ) {
        
        // Eliminamos a primeira página (que seria a home do site)
        if ( $i < $numero_de_paginas && $i >= 0 ) {
            // A página atual
            $pagina = $i;
            
            // O estilo da página atual
            $estilo = null;
            
            // Verifica qual dos números é a página atual
            // E cria um estilo extremamente simples para diferenciar
            if (isset($_GET['pag']) and $i == $_GET['pag'] ) {
				
                $estilo = 'class="page-item active"';
            }else{
                $estilo = 'class="page-item"';			
			}

            // Inclui os links na variável $paginas
			
			$paginas .=  "<li class=\"page-item\"><a class=\"page-link\" href='?pag=$pagina'>$pagina</a></li>";
        }
		
		
        
    } // for
	if(($artigos_por_pagina*$pg3+1)<$total_artigos)
    $paginas .= "<li class='page-item'><a class='page-link' href='?pag=".(@$pg3+1)."'>»</a></li>";
    
    // Retorna o que foi criado
    return $paginas;
    
}
			  ?>
            <!-- /.card-body -->
			  <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  <? echo paginacao( $total_artigos, $artigos_por_pagina, 10 ); ?>
                </ul>
              </div>
          </div>
          <!-- /.card -->
							
        </div>	
    </div>
</div>
<script src="../plugins/jquery/jquery.min.js"></script>
	<script src="../js/demo.js"></script>
	<script src="../js/adminlte.js"></script>
	<script src="../js/lottie.min.js"></script>
	<script src="js/index.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script>
		function seleciona(event){
			alert(event.target.value);
		}
        $(document).ready(function() {
            $('#responsavel').select2();
        });
    </script>
<script>

	function replaceClass(id, oldClass, newClass) {
    var elem = $(`#${id}`);
    if (elem.hasClass(oldClass)) {
        elem.removeClass(oldClass);
    }
    elem.addClass(newClass);
}
	
	
$(".removido").on("click", function(){
	if(confirm("Tem certeza que deseja informar que este outdoor foi removido?")){
	var id = this.id.slice(7);
		$.ajax({
			 url : "remover.php",
			 type : 'post',
			 data : {
				  idd : id
			 },
			 beforeSend : function(){
				  $(".removido").prop("disabled", true);
			 }
		})
		.done(function(msg){
			if(msg == 1){
				
			      alert("Você sinalizou que este outdoor foi removido!");
					replaceClass("remove_"+id, "btn-danger", "btn-secondary")
			}else{
			      alert("Este Outdoor não existe.");
			}

		})
		.fail(function(jqXHR, textStatus, msg){
			 alert(msg);
		});
	}
});
$(".regularizado").on("click", function(){
if(confirm("Quer sinalizar que este outdoor está regular")){
	var id = this.id.slice(8);
		$.ajax({
			 url : "regular.php",
			 type : 'post',
			 data : {
				  idd : id
			 },
			 beforeSend : function(){
				  $(".regularizado").prop("disabled", true);
			 }
		})
		.done(function(msg){
			if(msg == 1){
				
			      alert("Você sinalizou que este outdoor foi regularizado!");
					replaceClass("regular_"+id, "btn-primary", "btn-success")
			}else{
			      alert("Este Outdoor não existe.");
			}

		})
		.fail(function(jqXHR, textStatus, msg){
			 alert(msg);
		});
	}
});

         var watchID;
         var geoLoc;
		 
         function getLocationUpdate(){
            
            if(navigator.geolocation){
               // timeout at 60000 milliseconds (60 seconds)
               var options = {timeout:60000};
               geoLoc = navigator.geolocation;

               watchID = geoLoc.watchPosition(showLocation, errorHandler, options);
            } else {
               alert("Sorry, browser does not support geolocation!");
            }
         }


         function showLocation(position) {
			if(document.getElementById('lat').value!=''){
			var latitude = document.getElementById('lat').value;
			
			}else
            var latitude = position.coords.latitude;
			 
			if(document.getElementById('log').value!='')
            var longitude = document.getElementById('log').value; 
			else
			var longitude = position.coords.longitude;
            
			document.getElementById('lat').value = latitude;
            document.getElementById('log').value = longitude;
			
					 navigator.geolocation.getCurrentPosition(function(posicao) {
				var url = "https://nominatim.openstreetmap.org/reverse?lat="+latitude+"&lon="+longitude+"&format=json&json_callback=preencherDados";
			
				var script = document.createElement('script');
				script.src = url;
				document.body.appendChild(script);
});
         }
         
         function errorHandler(err) {
            if(err.code == 1) {
               alert("Error: Access is denied!");
            } else if( err.code == 2) {
               alert("Error: Position is unavailable!");
            }
         }
		 




function preencherDados(dados) {
	if(typeof dados.address.road === "undefined"){
	document.getElementById('Inrua').type = "text";  
	}else{
 
  document.getElementById('Inrua').value = dados.address.road;  
	}
  
  document.getElementById('Incidade').value = dados.address.city;  

  document.getElementById('Incep').value = dados.address.postcode;  

  if(typeof dados.address.suburb === "undefined"){
   document.getElementById('Inbairro').type = "text";   
  }else{


  document.getElementById('Inbairro').value = dados.address.suburb;  
  }
}
         
function envia_imagem(){
	document.getElementById('arquivo').click();
}
function muda_imagem(){
		document.getElementById('upload').innerHTML = '<i style="font-size:3em" class="fas fa-check-square"></i>';
		document.getElementById('upload').style.backgroundColor = "green";
}


function soNumeros(numeros) { //variavel do parametro recebe o caractere digitado//  
    var mask;
	mark =  numeros.replace(/([A-z'"_.\-,><!@#%¨&´*+?^$|(){}\[\]])/mg,"");  
	document.getElementById('processo').value = mark;
} 

document.getElementById('responsavel').oninvalid = function() {  
   // remove mensagens de erro padrão
   this.setCustomValidity("");
   // faz a validação novamente
   if (!this.validity.valid) {
       // se estiver inválido, coloca a mensagem
       this.setCustomValidity("O nome do responsável é obrigatório");
    }
};

document.getElementById('arquivo').oninvalid = function() {  
   // remove mensagens de erro padrão
   this.setCustomValidity("");
   // faz a validação novamente
   if (!this.validity.valid) {
       // se estiver inválido, coloca a mensagem
      alert("Uma foto do outdoor se faz necessário.");
      document.getElementById("upload").style.backgroundColor = "#dc3545";
    }
};

document.getElementById('lat').oninvalid = function() {  
   // remove mensagens de erro padrão
   this.setCustomValidity("");
   // faz a validação novamente
   if (!this.validity.valid) {
       // se estiver inválido, coloca a mensagem
      alert("Pressione o botão de buscar localização!");
      document.getElementById("localizacao").style.border = "2px solid red";
    }
};
function muda_cnpj(event){
	$("#cpf_cnpj").val(event.target.value);
	if(event.target.value == 'outro'){
		$("#muda_campo").html('<label for="form_name">Responsável *</label><input pattern="\d*" id="responsavel" type="text" name="responsavel" class="form-control" placeholder="Digite os números">');
	}
}
</script>
		<style>
		.select2-selection .select2-selection--single{
			height: 35px !important;
		}
	</style>
</html>