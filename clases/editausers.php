<?
$user = Array("id" => "", "nombre" => "","email" => "", "lat" => "", "lng" => "", "direccion" => "", "telefono" => "", "twitter" => "", "pass" => "");
$campos = array_keys($user);
$xml = simplexml_load_file("../data/users.xml");
$ultimo = 0;
foreach($xml as $users){
	$ultimo = $users->id;
}
function pass() { 
    $chars = "abcdefghijkmnopqrstuvwxyz023456789"; 
    srand((double)microtime()*1000000); 
    $i = 0; 
    $pass = '' ; 
    while ($i <= 7) { 
        $num = rand() % 33; 
        $tmp = substr($chars, $num, 1); 
        $pass = $pass . $tmp; 
        $i++; 
    } 
    return $pass; 
}
function modificar($nuevosvalores){
	global $xml, $campos;
	$key = traenodo($nuevosvalores['id']);
	foreach($campos as $campo){
		if($campo != "pass"){
			$xml->user[$key]->$campo = $nuevosvalores[$campo];
		}
	}
	return $xml;
}

function agrega($nuevo){
	global $xml, $campos;
	$siguiente = sizeof($xml->user);
	foreach($campos as $key){
		$xml->user[$siguiente]->$key = $nuevo[$key];
	}
	return $xml;
}
function traenodo($buscar){
	$cont = 0;
	global $xml;
	foreach($xml as $users){
		if($users->id == $buscar){
			return $cont;
		}
		$cont ++;
	}
}
function borra($idaborrar){
	global $xml;
	$key = traenodo($idaborrar);
	unset($xml->user[$key]);
	return $xml;
}
function salvar($xml){
	$dom = new DOMDocument('1.0');
	$dom->preserveWhiteSpace = false;
	$dom->formatOutput = true;
	$dom->loadXML($xml->asXML());
	$dom->save("../data/users.xml");
}
// PARA AGREGAR UN USER:
//salvar(agrega(<Todos los valores - Formato: Array>));
//salvar(agrega($nuevosvalores));

// PARA MODIFICAR UN USER:
//salvar(modificar(<Todos los valores - Formato: Array>));

// PARA BORRAR UN USER:
//salvar(borra(<ID del usuario a borrar - Formato: Integer>));
?>