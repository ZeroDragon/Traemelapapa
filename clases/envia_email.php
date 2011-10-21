<?php
function notice($body_orden){
	require_once("phpmailer/class.phpmailer.php");
	$mailer = new PHPMailer();
	$mailer->IsSMTP();
	$mailer->Host = 'ssl://smtp.gmail.com:465';
	$mailer->SMTPAuth = TRUE;
	$mailer->Username = 'traemelapapa@gmail.com';  // Change this to your gmail adress
	$mailer->Password = 'calditodepollo';  // Change this to your gmail password
	$mailer->From = 'traemelapapa@gmail.com';  // This HAVE TO be your gmail adress
	$mailer->FromName = 'Traeme La Papa'; // This is the from name in the email, you can put anything you like here
	$mailer->Body = $body_orden;
	$mailer->Subject = 'Nueva Orden - Traeme La Papa';
	$mailer->AddAddress('adywhisper@gmail.com','Adywhisper');
	$mailer->AddAddress('zr.drgn@gmail.com','Zero Dragon');  // This is where you put the email adress of the person you want to mail
	$mailer->Send();
}
function nueva_orden($body_orden, $recipiente){
	require_once("phpmailer/class.phpmailer.php");
	$mailer = new PHPMailer();
	$mailer->IsSMTP();
	$mailer->Host = 'ssl://smtp.gmail.com:465';
	$mailer->SMTPAuth = TRUE;
	$mailer->Username = 'traemelapapa@gmail.com';  // Change this to your gmail adress
	$mailer->Password = 'calditodepollo';  // Change this to your gmail password
	$mailer->From = 'traemelapapa@gmail.com';  // This HAVE TO be your gmail adress
	$mailer->FromName = 'Traeme La Papa'; // This is the from name in the email, you can put anything you like here
	$mailer->Body = $body_orden;
	$mailer->Subject = 'Nueva Orden - Traeme La Papa';
	$mailer->AddAddress($recipiente['email'],$recipiente['nombre']);
	if($mailer->Send()){
		notice($body_orden);
	}
}
function nuevo_user($body_nueva, $body_orden, $recipiente){
	require_once("phpmailer/class.phpmailer.php");
	$mailer = new PHPMailer();
	$mailer->IsSMTP();
	$mailer->Host = 'ssl://smtp.gmail.com:465';
	$mailer->SMTPAuth = TRUE;
	$mailer->Username = 'traemelapapa@gmail.com';  // Change this to your gmail adress
	$mailer->Password = 'calditodepollo';  // Change this to your gmail password
	$mailer->From = 'traemelapapa@gmail.com';  // This HAVE TO be your gmail adress
	$mailer->FromName = 'Traeme La Papa'; // This is the from name in the email, you can put anything you like here
	$mailer->Body = $body_nueva;
	$mailer->Subject = 'Tu nueva cuenta en Traeme La Papa';
	$mailer->AddAddress($recipiente['email'],$recipiente['nombre']);
	if($mailer->Send()){
	   nueva_orden($body_orden, $recipiente);
	}
}
?>