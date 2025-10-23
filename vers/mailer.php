<?php 
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	use PHPMailer\PHPMailer\SMTP;
	require 'PHPMailer-master/src/PHPMailer.php';
	require 'PHPMailer-master/src/Exception.php';
	require 'PHPMailer-master/src/SMTP.php';
	
	echo 'Телефон: ' . $_POST['phone'] . "\nИмя: " . $_POST['name'];
	
	/*$mail = new PHPMailer();
	$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
	$mail->Debugoutput = 'html';
	$mail->isSMTP();
	$mail->Host   = 'smtp.yandex.ru';
	$mail->SMTPAuth   = true;
	$mail->Username   = 'UshakovaPS21@yandex.com';
	$mail->Password   = 'grvcisyonfgpmhgp';
	$mail->SMTPSecure = 'tls';
	$mail->Port   = 587;
	$mail->CharSet   = 'UTF-8';
	 
	$mail->setFrom('UshakovaPS21@yandex.com', 'Тестировщик');
	$mail->addAddress('UshakovaPS21@yandex.com');
	 
	$mail->isHTML(false);
	$mail->Subject = 'Тест';
	$mail->msgHTML('Хелло ворлд');
	// Отправляем
	if ($mail->send()) {
	  echo 'Письмо отправлено!';
	} else {
	  echo 'Ошибка: ' . $mail->ErrorInfo;
	}*/
	
