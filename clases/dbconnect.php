<?
$local = array('localhost','127.0.0.1');
if(!in_array($_SERVER['HTTP_HOST'],$local)){
	mysql_connect("mysql50-75.wc2.dfw1.stabletransit.com","434152_comidawp","Ign0minia!");	
}else{
	mysql_connect("localhost","434152_comidawp","Ign0minia!");
}
mysql_select_db("434152_lapapawp");
?>
