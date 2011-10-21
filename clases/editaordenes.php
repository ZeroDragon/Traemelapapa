<?
$xml2 = simplexml_load_file("../data/ordenes.xml");
$ultima = 0;
foreach($xml2 as $users){
	$ultima = $users->id;
}
function orden_add($nuevo){
	global $xml2;
	$kampos = array_keys($nuevo);
	$siguiente = sizeof($xml2->orden);
	foreach($kampos as $key){
		if(!is_array($nuevo[$key])){
			$xml2->orden[$siguiente]->$key = $nuevo[$key];
		}
	}
	$kampos = array_keys($nuevo['Guarniciones']);
	foreach($kampos as $key){
		$xml2->orden[$siguiente]->Guarniciones->guarnicion[] = $key;
	}
	$kampos = array_keys($nuevo['Opciones']);
	foreach($kampos as $key){
		$xml2->orden[$siguiente]->Opciones->opcion[] = $key;
	}
	$kampos = array_keys($nuevo['Extras']);
	foreach($kampos as $key){
		if($nuevo['Extras'][$key]!=0){
			$xml2->orden[$siguiente]->Extras->Extra[] = $key . ": " . $nuevo['Extras'][$key];
		}
	}
	return $xml2;
}
function agregar($xml){
	$dom = new DOMDocument('1.0');
	$dom->preserveWhiteSpace = false;
	$dom->formatOutput = true;
	$dom->loadXML($xml->asXML());
	$dom->save("../data/ordenes.xml");
}
?>