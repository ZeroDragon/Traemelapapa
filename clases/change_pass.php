<?
session_start();
$cosa = "<script>window.location='logout.php'</script>";
echo !isset($_SESSION['userid']) ? $cosa: ($_SESSION['userid']!='' ? '' : $cosa);
$xml = simplexml_load_file("../data/users.xml");
$cnt = 0;
foreach ($xml as $user){
	if ($user->id==$_SESSION['userid']) $current=$cnt;
	$cnt ++;
}
function salvar($xml){
	$dom = new DOMDocument('1.0');
	$dom->preserveWhiteSpace = false;
	$dom->formatOutput = true;
	$dom->loadXML($xml->asXML());
	$dom->save("../data/users.xml");
}
$pass = $xml->user[$current]->pass;
$error = '';
if(isset($_POST['nuevo'])){
	if($_POST['nuevo'] == $_POST['confirma']){
		if($_POST['old']==$pass){
			$xml->user[$current]->pass = $_POST['nuevo'];
			salvar($xml);
			$error = 'Password cambiado';
		}else{
			$error = 'El password anterior no concuerda con el de la base de datos';
		}
	}else{
		$error = 'El password nuevo y la confirmaci&oacute;n no coinciden';
	}
}
?>
<script>
function logout(){
	window.location = "../clases/logout.php";
}
</script>
<link type="text/css" rel="stylesheet" href="../estilos/default.css">
<table width="100%"><tr><td align="center">
<span style="background-color:rgba(255,255,255,0.9); color:#f00;"><?=$error?></span>
<form method="POST" action="">
<input type="password" name="old" placeholder="Password Anterior"></br>
<input type="password" name="nuevo" placeholder="Password Nuevo"></br>
<input type="password" name="confirma" placeholder="Confirmaci&oacute;n"></br>
<input type="submit" value="cambiar" class="enviar"></br>
<input type="button" value="Salir" onClick="logout()" class="logout">
</form>
</td></tr>
</table>