<?
$db2 = pg_connect("host=faus.arapiraca.al.gov.br port=5432 dbname=db_faus user=fiscal password=db#f1sc@l@R@19");
if(!$db2){

echo "erro na conexão.";
}

$id = $_POST['idd'];
$lat = $_POST['lat'];
$log = $_POST['log'];

$query = pg_query("UPDATE objetos SET lat='$lat', log='$log' WHERE id='$id'")or die(mysqli_error());

echo '1';
?>