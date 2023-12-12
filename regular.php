<?
//$db = mysqli_connect('sql484.main-hosting.eu', 'u271456575_admin', 'Lin221286', 'u271456575_en9');
$db2 = pg_connect("host=faus.arapiraca.al.gov.br port=5432 dbname=db_faus user=fiscal password=db#f1sc@l@R@19");
if(!$db2){

echo "erro na conexão.";
}

$id = $_POST['idd'];
$query = pg_query("SELECT * FROM  objetos WHERE id = '$id'");
if(pg_num_rows($query)>0){
	pg_query("UPDATE objetos SET status = 'regular' WHERE id = '$id'");
	echo 1;
}else{
	echo 0;
}
