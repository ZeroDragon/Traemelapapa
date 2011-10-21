<? session_start();
if(!isset($_POST['lat'])){$_POST['lat']="";$_POST['lng']="";}
if (isset($_POST['crea_cuenta'])){
	include_once "editausers.php";
	$pass = pass();
	$valores = Array(
		"id" => $ultimo+1,
		"pass" => $pass,
		"lat" => $_POST['lat'],
		"lng" => $_POST['lng'],
		"direccion" => $_POST['direccion'],
		"email" => $_POST['email'],
		"nombre" => $_POST['nombre'],
		"telefono" => $_POST['telefono'],
		"twitter" => $_POST['otro'],
	);
	salvar(agrega($valores));
	$cuenta_creada = $ultimo+1;
}
if (isset($_POST['guarda_cuenta'])){
	include_once "editausers.php";
	$valores = Array(
		"id" => $_SESSION['userid'],
		"lat" => $_POST['lat'],
		"lng" => $_POST['lng'],
		"direccion" => $_POST['direccion'],
		"email" => $_POST['email'],
		"nombre" => $_POST['nombre'],
		"telefono" => $_POST['telefono'],
		"twitter" => $_POST['otro'],
	);
	salvar(modificar($valores));
}
if(isset($cuenta_creada)){ //si se hizo una cuenta nueva
	$cuentaid = $cuenta_creada;
	$nueva_cuenta = true;
}else{
	$cuentaid = "Sin Cuenta";
	$nueva_cuenta = false;
}

if(isset($_SESSION['userid'])){$cuentaid = $_SESSION['userid'];}
if(!isset($_POST['comentarios'])){$_POST['comentarios'] = "n/a";}
include_once "editaordenes.php";
$orden = Array(
	"id" => $ultima+1,
	"nombre" => $_POST['nombre'],
	"cuentaid" => $cuentaid,
	"horario"=> $_POST['horario'],
	"direccion"=> $_POST['direccion'],
	"lat" => $_POST['lat'],
	"lng" => $_POST['lng'],
	"entrada" => $_POST['entrada'],
	"Plato_Fuerte" => $_POST['Plato_Fuerte'],
	"Guarniciones" => $_POST['Guarniciones'],
	"Agua" => $_POST['Agua'],
	"Opciones" => $_POST['Opciones'],
	"Extras" => $_POST['Extras'],
	"cuantas" => $_POST['cuantas'],
	"comentarios" => $_POST['comentarios'],
	"subtotal" => $_POST['totals'],
);

agregar(orden_add($orden));
include "envia_email.php";
$recipiente = Array(
	"nombre" => $_POST['nombre'],
	"email" => $_POST['email'],
);
$text = "";
foreach($_POST['Guarniciones'] as $guarnicion){
	$text .= $guarnicion . ", ";
}
$text2 = "";
$kampos = array_keys($_POST['Opciones']);
foreach($kampos as $opcion){
	$text2 .= $opcion . ", ";
}
$text3 = "";
$kampos = array_keys($_POST['Extras']);
foreach($kampos as $key){
	if($_POST['Extras'][$key]!=0){
		$text3 .= $key . ": " . $_POST['Extras'][$key] . ", ";
	}
}
$body_orden = 
"Nueva orden recibida de: " . $_POST['nombre'] . "
Hora de entrega: ".$_POST['horario']."
Direccion de Entrega: ". $_POST['direccion'] ."
Detalles:
Entrada: ".$_POST['entrada']."
Plato fuerte: ".$_POST['Plato_Fuerte']."
Guarniciones: ".$text."
Agua: ".$_POST['Agua']."
Opciones: ".$text2."
Cosas Extra: ".$text3."
Numero de ordenes: ".$_POST['cuantas']."
Subtotal: ".$_POST['totals'];
if($nueva_cuenta){
	$body_nueva = "
Bienvenido a Traeme La Papa,
esta es tu nueva cuenta para ordenar de forma express.
Tu login es ".$_POST['email']."
tu password es ".$pass;
	nuevo_user($body_nueva, $body_orden, $recipiente);
}else{
	nueva_orden($body_orden, $recipiente);
}
?>
<script>window.location = "logout.php";</script>