<?
$pass = 'abc123doremi';
$gogo = "<script>window.location=\"index.php\";</script>";
$gogo2 = "<script>window.location=\"../../backend/\";</script>";
if(!isset($_POST['pass'])){echo $gogo;}elseif($_POST['pass']!=$pass){echo $gogo;}else{session_start();$_SESSION['admin']='ok';echo $gogo2;}
?>