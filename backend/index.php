<?
include "../clases/login/try.php";
?>
<a href="display.php">Mapa con todas las ordenes</a> | 
<a href="print.php">Detalles de todas las ordenes</a> | 
<a href="limpia.php">Preparar para el siguiente dia</a> |
<a href="../clases/logout.php">Logout</a><br />
El Menu
<?include "../clases/menu.php";
foreach ($menu as $key => $categorias){
	echo "<ul><li>".$key . "</li><ul>";
	foreach ($categorias as $item){
		echo "<li>".$item . "</li>";
	}
	echo "</ul></ul>";
}

?>
<a href="https://spreadsheets.google.com/ccc?key=0AvQmjKYpeXJndDRxM2FjdkR1UUdRczljTFVtdlpBT3c&hl=en#gid=0">Editar Menu</a>