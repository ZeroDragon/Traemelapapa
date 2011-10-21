<?
session_start();
if(isset($_SESSION['avatar'])){
	$avatar = $_SESSION['avatar'];
	$avatar = str_replace('_normal', '_bigger', $avatar);
	$nombre = $_SESSION['name'];
	$url = $_SESSION['url'];
}
session_destroy();
?><link type="text/css" rel="stylesheet" href="estilos/default.css">
<script>
function normal(){
	window.location = "formularios/"
}
</script>
<body>
<table class="elbg" align="center" border=0>

<tr><td colspan=2>
<span class="heading3">Elige tu modo de ordenar comida!</span>
</td></tr>
<tr><td valign="top"><span class="heading3">
Modo normal</span><hr><span class="input">Si aun no tienes un login, aqui puedes ordenar.<br>Mientras ordenas, puedes hacer tu cuenta<br>para ordenar de forma express la siguiente vez.
</span></td>
<td valign="top">
<span class="heading3">Modo Express</span><hr><span class="input">Si ya tienes un login, solo entra aqui y ordena!</span></td>
</tr>
<tr><td align="center" valign="bottom"><table><tr><td>
<input type="button" name="enviar" id="enviar" value="Modo Normal" onclick="normal();" class="enviar">
</td></tr></table>
</td><td align="center" valign="bottom">
<form style="margin:0px;" method="POST" action="clases/login.php">
<table><tr><td>
<input type="text" name="login" id="login" placeholder="Tu E-mail"></td></tr><tr><td>
<input type="password" name="password" id="password"placeholder="Tu password"></td></tr><tr><td>
<input type="submit" class="enviar" name="enviar" id="enviar" value="Modo Express"></form>
</tr></td></table>
</td></tr>
</table>
<table class="elbg" align="center" border=0 style="margin-top:5px; width:625px;"><tr><td>
<?include "clases/dbconnect.php";
$post = mysql_query("SELECT ID, post_name, post_title, post_excerpt, post_author FROM wp_posts WHERE (post_status = 'publish') AND (post_type = 'post') ORDER BY ID DESC") or die(mysql_error());
$post = mysql_fetch_array($post);

function author($id){
	$quien = mysql_query("SELECT user_nicename FROM wp_users WHERE (ID = '{$id}')") or die(mysql_error());
	$quien = mysql_fetch_array($quien);
	return $quien['user_nicename'];
}
?>
<span class="heading3"><a href="blog/">Ultimo Post en el Blog de Traemelapapa.com</a></span><br />
<span class="input" style="font-size:20px;"><a target="_blank" href="http://www.traemelapapa.com/blog/<?=$post['ID']?>/<?=$post['post_name']?>"><?=ucwords($post['post_title'])?></a></span><br />
<span class="input"><?=$post['post_excerpt']?></span><br />
<span class="titulo">por: </span>
<span class="input"><?=ucwords(author($post['post_author']))?></span>
</td></tr></table>
<table class="elbg" align="center" border=0 style="margin-top:5px; width:625px;"><tr><td>
<span class="heading3">Comentarios de la gente</span><br />
<?$xml = simplexml_load_file("data/comentarios.xml");
foreach($xml as $cmt){?>
<table style="border-bottom: 2px dashed #456;" width="100%"><tr><td valign="top"><img src="<?=$cmt->avatar?>"></td>
<td valign="top" width="90%">
<span class="titulo">por:</span> <span class="input"><a href="<?=$cmt->url?>" target="_blank"><?=$cmt->nombre?></a></span><br />
<span class="input"><?=$cmt->txt?></span>
</td></tr></table>
<?}?>
<?if(isset($_SESSION['avatar'])){?>
<table width="100%"><tr><td valign="top"><img src="<?=$avatar?>"></td></tr><tr><td valign="top" align="center">
<form action="clases/comentario.php" method="POST">
<input type="hidden" name="nombre" value="<?=$nombre?>">
<input type="hidden" name="url" value="<?=$url?>">
<input type="hidden" name="avatar" value="<?=$avatar?>">
<textarea class="address-doble" placeholder="Escribe tus comentarios para Traemelapapa.com" name="txt"></textarea><br />
<input type="button" name="cancelar" value="Cancelar" class="logout" /><input type="submit" name="enviar" value="Enviar" class="normal" />
</form>
</td></tr></table>
<?}else{?>
<span class="input"><a class="rpxnow" onclick="return false;"
href="https://traemelapapa.rpxnow.com/openid/v2/signin?token_url=http%3A%2F%2Fwww.traemelapapa.com%2Fclases%2Ftoken.php">Deja un comentario</a></span>
<?}?></td></tr></table>
<script type="text/javascript">
  var rpxJsHost = (("https:" == document.location.protocol) ? "https://" : "http://static.");
  document.write(unescape("%3Cscript src='" + rpxJsHost +
"rpxnow.com/js/lib/rpx.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
  RPXNOW.overlay = true;
  RPXNOW.language_preference = 'en';
</script>




















