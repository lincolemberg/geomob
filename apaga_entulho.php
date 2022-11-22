<?
$db = mysqli_connect('sql484.main-hosting.eu', 'u271456575_admin', 'Lin221286', 'u271456575_en9');

$arquivo = $_GET['arq'];
$id = $_GET['id'];
unlink('entulhos_fotos/'.$arquivo);
$query = mysqli_query($db, "DELETE FROM entulhos WHERE id='$id'")or die(mysqli_error());

header("location: entulhos.php");

?>