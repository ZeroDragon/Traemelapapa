<?php
$username = 'traemelapapa@gmail.com';
$password = 'calditodepollo';
$fromname = 'Traeme La Papa';
$titulo = 'Nueva Orden - Traeme La Papa';

//reportes
$reportes = array(
	array('adywhisper@gmail.com','Adywhisper'),
	array('zr.drgn@gmail.com','Zero Dragon')
);

function notice($body_orden){
	global $username, $password, $fromname, $titulo, $reportes;
	require_once("phpmailer/class.phpmailer.php");
	$mailer = new PHPMailer();
	$mailer->IsSMTP();
	$mailer->Host = 'ssl://smtp.gmail.com:465';
	$mailer->SMTPAuth = TRUE;
	$mailer->Username = $username;  // Change this to your gmail adress
	$mailer->Password = $password;  // Change this to your gmail password
	$mailer->From = $username;  // This HAVE TO be your gmail adress
	$mailer->FromName = $fromname; // This is the from name in the email, you can put anything you like here
	$mailer->Body = $body_orden;
	$mailer->Subject = $titulo;
	foreach ($reportes as $reporte){
		$mailer->AddAddress($reporte);	// This is where you put the email adress of the person you want to mail
	}
	$mailer->Send();
}
function nueva_orden($body_orden, $recipiente){
	global $username, $password, $fromname, $titulo
	require_once("phpmailer/class.phpmailer.php");
	$mailer = new PHPMailer();
	$mailer->IsSMTP();
	$mailer->Host = 'ssl://smtp.gmail.com:465';
	$mailer->SMTPAuth = TRUE;
	$mailer->Username = $username;  // Change this to your gmail adress
	$mailer->Password = $password;  // Change this to your gmail password
	$mailer->From = $username;  // This HAVE TO be your gmail adress
	$mailer->FromName = $fromname; // This is the from name in the email, you can put anything you like here
	$mailer->Body = $body_orden;
	$mailer->Subject = $titulo;
	$mailer->AddAddress($recipiente['email'],$recipiente['nombre']);
	if($mailer->Send()){
		notice($body_orden);
	}
}
function nuevo_user($body_nueva, $body_orden, $recipiente){
	global $username, $password, $fromname
	require_once("phpmailer/class.phpmailer.php");
	$mailer = new PHPMailer();
	$mailer->IsSMTP();
	$mailer->Host = 'ssl://smtp.gmail.com:465';
	$mailer->SMTPAuth = TRUE;
	$mailer->Username = $username;  // Change this to your gmail adress
	$mailer->Password = $password;  // Change this to your gmail password
	$mailer->From = $username;  // This HAVE TO be your gmail adress
	$mailer->FromName = $fromname; // This is the from name in the email, you can put anything you like here
	$mailer->Body = $body_nueva;
	$mailer->Subject = 'Tu nueva cuenta en Traeme La Papa';
	$mailer->AddAddress($recipiente['email'],$recipiente['nombre']);
	if($mailer->Send()){
	   nueva_orden($body_orden, $recipiente);
	}
}
?>