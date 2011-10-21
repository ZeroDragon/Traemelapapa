<link type="text/css" rel="stylesheet" href="estilos/default.css">
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