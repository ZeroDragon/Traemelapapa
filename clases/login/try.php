<?session_start();
$gogo = "<script>window.location=\"../clases/login/\";</script>";
if(!isset($_SESSION['admin'])){echo $gogo;}elseif($_SESSION['admin']!='ok'){echo $gogo;}
?>