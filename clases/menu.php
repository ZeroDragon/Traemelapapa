<?php
date_default_timezone_set('Mexico/General');
function traeme(){
	$pre = "http://spreadsheets.google.com/feeds/cells/0AvQmjKYpeXJndDRxM2FjdkR1UUdRczljTFVtdlpBT3c/od6/public/basic";
	$donde = simplexml_load_file($pre);
	return $donde;
}
$todo = traeme();
$arreglo = Array(Array());
foreach($todo->entry as $entrada){
	$lol = (string)$entrada->title[0];
	$arreglo[$lol[0]][] = (string)$entrada->content[0]; 
}
unset($arreglo[0]);
$menu = Array(Array());
foreach($arreglo as $cosas){
	for($i=1; $i<sizeof($cosas); $i++){
		$menu[$cosas[0]][]=$cosas[$i];
	}
}
unset($arreglo);
unset($menu[0]);

function opciones($minimo,$maximo){
	for($i=$minimo; $i<=$maximo; $i++){
		echo "<option value=\"$i\">$i</option>";
	}
}
?>