<html>
<head>
<meta charset=utf-8 />
<title>Geomapeamento de Objetos - Entulhos</title>
<meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-locatecontrol/v0.43.0/css/font-awesome.min.css' rel='stylesheet' />
	<link rel="stylesheet" href="js/https@cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="css/fontawesome/fontfree/css/all.css" rel="stylesheet">

<link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' rel='stylesheet' />
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
<div class="container">
 <div class=" text-center mt-5 ">
 <a href="javascript:history.back()" class="btn btn-warning">Voltar</a>

        <h1 style="color:#fff">Adicionar Resíduos</h1>
    </div>
    <div class="row ">
        <div class="col-lg-7 mx-auto">
            <div class="card mt-2 mx-auto p-4 bg-light">
                <div class="card-body bg-light">
                    <div class="container">
                        <form id="contact-form" action="db_entulhos.php" enctype="multipart/form-data" method="post">
                            <div class="controls">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group"> <label for="form_name">Responsável *</label> <input  id="responsavel" type="text" name="responsavel" class="form-control" placeholder="Pessoa física/jurídica *" required="required" data-error="O nome do responsável é necessário"> </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"> <label for="form_name">Número do Bloco </label> <input pattern="\d*"  id="cpf_cnpj" type="number" name="cpf_cnpj" class="form-control" placeholder="Digite os números" > </div>
                                    </div>
                                     <div class="form-group col-md-6">
                              <label for="inputEmail4">Foi dado algum prazo?</label>
                              <input style="height:40px;" type="date" class="form-control" id="prazo"   name="prazo" >
                               </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group"> <label for="form_email">Imagem</label> 
                                        <div id="checado">
                                        <input onChange="muda_imagem();" type="file" name="arqui" accept="image/x-png,image/gif,image/jpeg" id="arquivo"  style="display:none" />
                                        <button onClick="envia_imagem();" type="button" for="arquivo"  class="btn btn-info btn-send" id="upload"><i style="font-size:3em" class="fas fa-upload"></i></button> 
                                        </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"> <label for="form_need">Classificação *</label> <select id="classificacao" name="classificacao" class="form-control" required="required" data-error="Por favor, classifique o entulho">
                                                <option title="São os resíduos reutilizáveis ou recicláveis como agregados de construção, demolição, reformas e reparos de pavimentação e de outras obras de infraestrutura, inclusive solos provenientes de terraplanagem;" value="Classe A" selected >Classe A</option>
                                                <option title="São os resíduos recicláveis para outras destinações, tais como plásticos, papel,
papelão, metais, vidros, madeiras, embalagens vazias de tintas imobiliárias e gesso;" value="Classe B">Classe B</option>
                                                <option title="São os resíduos para os quais não foram desenvolvidas tecnologias ou aplicações
economicamente viáveis que permitam a sua reciclagem ou recuperação;" value="Classe C">Classe C</option>
                                                <option title="São resíduos perigosos oriundos do processo de construção, tais como tintas,
solventes, óleos e outros ou aqueles contaminados ou prejudiciais à saúde;" value="Classe D">Classe D</option>
                                            </select> </div>
                                    </div>
                                    
                                                                        <div class="col-md-6">
                                        <div class="form-group"> <label for="form_need">Resíduos de *</label> <select id="gerador" name="gerador" class="form-control" required="required" data-error="Por favor, classifique o entulho">
                                                <option value="" selected disabled>Selecione</option>
                                                <option value="Pequeno Gerador">Pequeno Gerador</option>
                                                <option value="Grande Gerador">Grande Gerador</option>
                                            </select> </div>
                                    </div>
                                    
                                        <div class="col-md-6">
                                        <div class="form-group"> <label for="form_need">Dados da vistoria *</label> <select id="vistoria" name="vistoria" class="form-control" required="required" data-error="Por favor, classifique o entulho">
                                                <option value="" selected disabled>Selecione</option>
                                                <option value="Obra em andamento">construção</option>
                                                <option value="Obra concluida">Reforma</option>
                                                <option value="Obra concluida">Demolição</option>
                                                <option value="Áreas públicas">Logradouro</option>
                                                <option value="Imóvel baldio">Terreno/imóvel baldio</option>
                                                <option value="Áreas de Preservação Permanente">Áreas de Preservação Permanente</option>

                                            </select> </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group"> <label for="form_need">Imóvel</label> <select id="imovel" name="imovel" class="form-control" required="required" data-error="Especifique a natureza do imóvel">
                                                <option value="privado" selected >Privado</option>
                                                <option value="publico">Público</option>
                                                <option value="nao identificado">Não identificado</option>
                                            </select> </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group"> <label for="form_need">Outro Gerador *</label> <select id="prox_gerador" name="prox_gerador" class="form-control" required="required" data-error="Especifique a natureza do imóvel">
                                                <option value="nao" selected >Sem gerador próximo</option>
                                                <option value="sim" >A menos de 8m</option>
                                            </select> </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group"> <label for="form_message">Observações</label> <textarea id="obs" name="obs" class="form-control" placeholder="Se quiser, descreva a situação com detalhes." rows="4"  ></textarea> </div>
                                    </div>
                                    
                                    <div class="col-md-12"><label for="form_message"> Coordenadas *</label>
                                    <input type="hidden" name="lat" id="lat" />
                                    <input type="hidden" name="log" id="log" />
                                    <div style="margin:10px;" id="coordenadas"></div>
                                    <label for="form_need"> Cidade:</label>
                                    <div style="margin:10px;" id="cidade"></div>
                                    <input type="hidden" name="cidade" id="Incidade" />

                                    <label for="form_need">Rua</label>
                                    <div style="margin:10px;" id="rua"></div>
                                    <input style="display:block;width:200px;" type="hidden" name="rua" id="Inrua" />
                                     <label for="form_need">Número</label>
                                     <input  id="Innumero" type="text" name="numero" class="form-control" placeholder="Número" >

                                    <label for="form_need">Bairro</label>
                                    <div style="margin:10px;" id="bairro"></div>
                                     <input type="hidden" name="bairro" id="Inbairro" />

                                    <label for="form_need">CEP</label>
                                    <div style="margin:10px;" id="cep"></div>
                                    <input type="hidden" name="cep" id="Incep" />
                                    
                                    <button onClick="getLocationUpdate()" type="button" style="margin:auto;text-align:center;" id="localizacao" class="btn btn-dark btn-send btn-block "> <i  style="font-size:3em;display:block;margin:auto;"class="far fa-compass"></i></button></div>
                                    <div class="col-md-12"> <input id="salvar" name="salvar" type="submit" class="btn btn-success btn-send pt-2 btn-block " value="Salvar"> </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- /.8 -->
        </div> <!-- /.row-->
    </div>
</div>

<script>


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
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;
            document.getElementById('coordenadas').innerHTML = "Latitude : " + latitude + " Longitude: " + longitude;
            document.getElementById('lat').value = latitude;
            document.getElementById('log').value = longitude;
			
					 navigator.geolocation.getCurrentPosition(function(posicao) {
				var url = "https://nominatim.openstreetmap.org/reverse?lat="+posicao.coords.latitude+"&lon="+posicao.coords.longitude+"&format=json&json_callback=preencherDados";
			
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
  document.getElementById('rua').innerHTML = dados.address.road;  
  document.getElementById('Inrua').value = dados.address.road;  
	}
  document.getElementById('cidade').innerHTML = dados.address.city;  
  document.getElementById('Incidade').value = dados.address.city;  

  document.getElementById('cep').innerHTML = dados.address.postcode;  
  document.getElementById('Incep').value = dados.address.postcode;  

  document.getElementById('bairro').innerHTML = dados.address.suburb;  
  document.getElementById('Inbairro').value = dados.address.suburb;  
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
</script>
</html>