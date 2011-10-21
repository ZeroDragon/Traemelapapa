<?include "../clases/login/try.php";
$ordenes = simplexml_load_file("../data/ordenes.xml");
$total = 0;
foreach($ordenes as $orden){
	echo "Nombre: ";
	echo $orden->nombre;
	echo "<br>Direccion: ";
	echo $orden->direccion;
	echo "<br>Hora de entrega: ";
	echo $orden->horario;
	echo "<br> Comentarios: ";
	echo $orden->comentarios;
	echo "<br>Numero de ordenes: ";
	echo $orden->cuantas;
	echo "<br>$";
	echo $orden->subtotal;
	echo "<hr>";
	$total += $orden->subtotal;
}
echo "Total de venta del d&iacute;a: $".$total;
?>