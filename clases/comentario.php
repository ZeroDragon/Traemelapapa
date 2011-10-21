<?
$comentario = Array("id" => "", "avatar" => "","url" => "", "nombre" => "", "txt" => "");
$campos = array_keys($comentario);
$xml = simplexml_load_file("../data/comentarios.xml");
$ultimo = 0;
foreach($xml as $comentarios){
	$ultimo = $comentarios->id;
}
function agrega($nuevo){
	global $xml, $campos;
	$siguiente = sizeof($xml->comentario);
	foreach($campos as $key){
		$xml->comentario[$siguiente]->$key = $nuevo[$key];
	}
	return $xml;
}

function salvar($xml){
	$dom = new DOMDocument('1.0');
	$dom->preserveWhiteSpace = false;
	$dom->formatOutput = true;
	$dom->loadXML($xml->asXML());
	$dom->save("../data/comentarios.xml");
}
// PARA AGREGAR UN USER:
//salvar(agrega(<Todos los valores - Formato: Array>));
//salvar(agrega($nuevosvalores));
$avatar = $_POST['avatar'];
$url = $_POST['url'];
$nombre = $_POST['nombre'];
$txt = $_POST['txt'];
$comentario = Array(
	'id' => $ultimo+1,
	'avatar' => $avatar,
	'url' => $url,
	'nombre' => $nombre,
	'txt' => $txt,
);
salvar(agrega($comentario));
?>
<script>window.location="../";</script>