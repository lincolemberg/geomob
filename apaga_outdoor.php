<?
$db2 = pg_connect("host=faus.arapiraca.al.gov.br port=5432 dbname=db_faus user=fiscal password=db#f1sc@l@R@19");
if(!$db2){

echo "erro na conexão.";
}

$id = $_GET['id'];
unlink('outdoors/'.$arquivo);
$query = pg_query("DELETE FROM objetos WHERE id='$id'")or die(mysqli_error());

header("location: ./");

?>