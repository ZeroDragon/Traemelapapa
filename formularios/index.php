<?session_start();?>
<link type="text/css" rel="stylesheet" href="../estilos/default.css">
<?
include("../clases/menu.php");
if($menu['Active'][0]=='TRUE'){ //supermaster login
$user = Array("id" => "", "nombre" => "","email" => "", "lat" => "", "lng" => "", "direccion" => "", "telefono" => "", "twitter" => "", "pass" => "");
if(isset($_SESSION['userid'])){
	$xml = simplexml_load_file("../data/users.xml");
	foreach($xml as $users){
		if($users->id == $_SESSION['userid']){
			foreach($users as $dato){
				$user[$dato->getName()] = $dato;
			}
		}
	}
}
if(isset($_POST['lat'])){
	$user['lat'] = $_POST['lat'];
	$user['lng'] = $_POST['lng'];
	$user['direccion'] = $_POST['direccion'];
}
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script>
function logout(){
	window.location = "../clases/logout.php";
}
function changepass(){
	window.location = "../clases/change_pass.php";
}
</script>
<body>
<form action="../clases/procesa_orden.php" method="POST">
<table class="elbg" align="center"><tr><td><h1><a href="../clases/logout.php">Traeme La Papa.com</a></h1></td><td align="right"><?if(isset($_SESSION['userid'])){?><input class="logout" type="button" value="cerrar session" onclick="logout()"><input type="button" value="cambiar pass" onclick="changepass()" class="normal"><?}?></td></tr><tr><td><h2>1) Tus Datos Personales</h2></td><td><h2>2)El men&uacute; para el <?=$menu['Fecha'][0]?></h2></td></tr><tr><td valign="top">
<table cellspacing=0 cellpading=0 border=0><tr><td>
<div class="mapita"><a href="mapa.html">
<?if($user['lat']!=""){ //si tenemos el valor o nos vale ?>
<img style="position:relative; top:-20px;" src="http://maps.google.com/maps/api/staticmap?markers=<?=$user['lat']?>,<?=$user['lng']?>&size=298x200&sensor=false">
<?}else{?>
<img class="preview" src="http://maps.google.com/maps/api/staticmap?center=21.159292271255293,-86.8460155182129&zoom=12&size=298x200&sensor=false">
<span class="link-mapas">Click para usar<br>google maps<br>(opcional, recomendado)</span>
<?}?></a></div>
</td></tr>
<tr><td valign="top">
<textarea class="address" placeholder="Direcci&oacute;n de Entrega" name="direccion" id="direccion"><?=$user['direccion']?></textarea>
</td></tr>
<tr><td>
<input type="text" name="nombre" id="nombre" placeholder="Nombre" value="<?=$user['nombre']?>">
</td></tr>
<tr><td><input type="text" name="email" id="email" placeholder="Email" value="<?=$user['email']?>">
</td></tr>
<tr><td>
<input type="text" name="telefono" id="telefono" placeholder="Telefono o Celular" value="<?=$user['telefono']?>">
</td></tr>
<tr><td>
<input type="text" name="otro" id="otro" placeholder="Twitter (opcional)" value="<?=$user['twitter']?>">
</td></tr>
<tr><td>
<select name="horario" id="horario" class="select" name="Entrega" id="Entrega"><option disabled>Elige un horario</opcion><option>Entre 1:00pm y 1:30pm</option><option>Entre 1:30pm y 2:00pm</option><option>Entre 2:00pm y 2:30pm</option></select>
<input type="hidden" name="lat" id="lat" value="<?=$user['lat']?>">
<input type="hidden" name="lng" id="lng" value="<?=$user['lng']?>">
</td></tr>
<tr><td>
<?if(!isset($_SESSION['userid'])){?>
<table cellpadding=2 cellspacing=0 class="minitabla"><tr><td>
<input type="checkbox" class="checkbox" name="crea_cuenta" id="crea_cuenta" checked></td><td><span class="input">Quiero hacer una cuenta para ordenar de forma express en la pr&oacute;xima ocasi&oacute;n</span></td></tr>
</table><?}else{?>
<table cellpadding=2 cellspacing=0 class="minitabla"><tr><td>
<input type="checkbox" class="checkbox" name="guarda_cuenta" id="guarda_cuenta"></td><td><span class="input">Quiero guardar estos datos como default para mis pr&oacute;ximas &oacute;rdenes</span></td></tr>
</table>
<?}?>
<tr><td>
<span class="heading3">Gran total</span></td></tr><tr><td align="center">
<span class="precio">$</span><span class="precio" id="precio" name="precio"></span><br>
<span style="font-size:10px; color:#a00;">*El precio puede aplicar cargos extras por envio</span>
</td></tr>
</td></tr></table>
</td>
<td valign=top>
<table cellpadding=0 cellspacing=0><tr><td valign="top">
<table cellpadding=0 cellspacing=0>
<tr><td colspan=2><span class="heading3">Entrada</span></td></tr>
<?foreach($menu['Entrada'] as $item){?><tr>
<td><input type="radio" class="radio" name="entrada" id="entrada" value="<?=$item?>"></td>
<td><span class="input"><?=$item?></span></td>
</tr><?}?><tr><td>&nbsp;</td><td></td></tr>
<tr><td colspan=2><span class="heading3">Plato Fuerte</span></td></tr>
<?foreach($menu['Plato Fuerte'] as $item){?><tr>
<td><input type="radio" class="radio" name="Plato Fuerte" id="Plato Fuerte" value="<?=$item?>"></td>
<td><span class="input"><?=$item?></span></td>
</tr><?}?><tr><td>&nbsp;</td><td></td></tr>
<tr><td colspan=2><span class="heading3">Guarnicion</span><br>(M&aacute;ximo dos)</td></tr>
<?foreach($menu['Guarnicion'] as $item){?><tr>
<td><input type="checkbox" class="checkbox" name="Guarniciones[<?=$item?>]" id="Guarnicion[]" value="<?=$item?>"></td>
<td><span class="input"><?=$item?></span></td>
</tr><?}?><tr><td>&nbsp;</td><td></td></tr>
<tr><td colspan=2><span class="heading3">Agua</span></td></tr>
<?foreach($menu['Agua'] as $item){?><tr>
<td><input type="radio" class="radio" name="Agua" id="Agua" value="<?=$item?>"></td>
<td><span class="input"><?=$item?></span></td>
</tr><?}?><tr><td>&nbsp;</td><td></td></tr>
<tr><td colspan=2><span class="heading3">Las opciones gratis</span></td></tr>
<?foreach($menu['Opciones'] as $item){?><tr>
<td><input type="checkbox" class="checkbox" name="Opciones[<?=$item?>]" id="Opciones[]" value="Si"></td>
<td><span class="input"><?=$item?></span></td>
</tr><?}?><tr><td>&nbsp;</td><td></td></tr>
</table>
</td>
<td valign="top">
<table cellpadding=0 cellspacing=0><tr><td>
<tr><td colspan=2><span class="heading3">Las cosas extra</span></td></tr>
<?foreach($menu['Extras'] as $item){?><tr>
<td><select onChange="precio('(EXTRA)<?=$item?>',5);" class="number" name="Extras[<?=$item?>]" id="(EXTRA)<?=$item?>"><?=opciones(0,9)?></select></td>
<td><span class="input">($5) <?=$item?></span></td>
</tr><?}?>
<?foreach($menu['Agua'] as $item){if($item != "Sin Agua"){?><tr>
<td><select onChange="precio('(EXTRA)<?=$item?>',10);" class="number" name="Extras[<?=$item?>]" id="(EXTRA)<?=$item?>"><?=opciones(0,9)?></select></td>
<td><span class="input">($10) <?=$item?></span></td>
</tr><?}}?>
<tr><td>&nbsp;</td><td></td></tr>
<tr><td colspan=2><span class="heading3">Peticiones especiales</span></td></tr>
<tr><td><select onChange="precio('total',1);" class="number" name="cuantas" id="cuantas"><?=opciones(1,9)?></select></td><td><span class="input">Cuantas &oacute;rdenes quieres en total?</span></td></tr>
<tr><td>&nbsp;</td><td></td></tr>
<tr><td colspan=2><span class="heading3">Indicaciones especiales</span></td></tr>
<tr><td colspan=2><textarea class="address" style="height:100px;" name="comentarios" id="comentarios" placeholder="Ej: sin queso en mis enchiladas, la segunda orden con agua de horchata, hablenme cuando esten afuera, corten mi pizza en pentagrama!"></textarea></td></tr>
<tr><td>&nbsp;</td><td></td></tr>
<tr><td colspan=2><span class="heading3">Todo listo?</span></td></tr>
<tr><td colspan=2><input type="submit" class="enviar" name="enviar" id="enviar" value="Ordenar!"></td></tr>
</table>
</td>
</tr></table>
</td>
</tr>
</table>
<?if(isset($user['lat'])){?>
<input type="hidden" name="totals" id="totals" value="45">
<?}?>
</form>
<script>

Array.prototype.exists = function(o) {
for(var i = 0; i < this.length; i++)
   if(this[i] === o)
     return i;
return false;
}
function setprecio(control,valores,precios){
	contador = 0;
	for(var i=0; i < control.length; i++){
		if( control[i] != "" ){
			contador = contador + valores[control[i]] * precios[control[i]];
		}
	}
	return base + contador;
}
var base = 45;
var baso = base;
var total = base;
document.getElementById('precio').innerHTML = base;
var suma = new Array( new Array());
var cuales = new Array();
var cuanto = new Array();
function precio(cual,valor){
	factor = document.getElementById('cuantas').value;
	base = baso * factor;
	if(cual != 'total'){
		if(suma.exists(cual) === false){
			suma.push(cual); //se crea arreglo de control de los items a agregar/quitar
			cuales[cual] = document.getElementById(cual).value; //arreglo con el ultimo valor del item
			cuanto[cual] = valor;
		}else{
			cuales[cual] = document.getElementById(cual).value; //ultimo valor
		}
	}
	total = setprecio(suma,cuales,cuanto);
	document.getElementById('precio').innerHTML = total;
	document.getElementById('totals').value = total;
}
</script>
</body>
<?}else{?>
	<script>window.location='disabled.php';</script>
<?}?>

















