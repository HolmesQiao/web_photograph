<?php
	$to = "1575636507@qq.com";
	$from = "1575636507@qq.com";
	$password = "levjynuoispuhgfa";
	$subject = "Kkyou 验证";
	$body = "你吼啊，这里是Kkyou,感谢您光临小站，小站会越做越好!(:3|_|)\n 验证网址:http://118.24.109.65/user_setup.php ";

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require '../vendor/autoload.php';
	$mail = new PHPMailer(true);

	//$mail->SMTPDebug = 1;
	$mail->isSMTP();
	$mail->Host = 'smtp.qq.com';
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = 'ssl';
	$mail->Port = 465;
	$mail->CharSet = 'UTF-8';
	$mail->FromName = 'Kkyou';
	$mail->Username = '1575636507@qq.com';
	$mail->Password = 'levjynuoispuhgfa';
	$mail->From = '1575636507@qq.com';

	$mail->addAddress($to);
	$mail->Subject = $subject;
	$mail->Body = $body;
	$mail->isHTML(true);


	$mail->send();
?>
