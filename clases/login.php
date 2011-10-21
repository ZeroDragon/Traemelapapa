<?
session_start();
function login(){
	$sale = false;
	if(isset($_POST['login']) && isset($_POST['password'])){
		$xml = simplexml_load_file("../data/users.xml");
		foreach($xml as $users){
			if($users->email == $_POST['login']){
				if($users->pass == $_POST['password']){
					$_SESSION['userid'] = intval($users->id);
					$sale = true;
				}
			}
		}
	}
	return $sale;
}
if(login()){?>
<script type="text/javascript">
window.location = "../formularios"
</script>
<?
}else{
	session_destroy();
?>
<script type="text/javascript">
	window.location = "../"
</script>
<?}
?>