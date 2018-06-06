<?php
	$to = $_POST["email"];
	$from = "1575636507@qq.com";
	$password = "levjynuoispuhgfa";
	$subject = "Kkyou 验证";
	$body = "<div style='position: relative; border: 5px solid black; border-radius: 20px; display: flex; flex-direction: column; text-align: center; margin: 0 auto; padding: 20px;'>
	<img src='http://118.24.109.65/data/kkyou.png' style='width:130px; position:relative; margin: 0 auto;'></img><br />
	<div>你吼啊，这里是Kkyou,感谢您光临小站!(:3|_|)<br/><p /><img src='http://118.24.109.65/data/Kikyou_mail.jpg' style='width:500px'/><br/><hr/>
	验证网址:http://118.24.109.65/user_setup.php?verify=".$code."</div></div>";

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'vendor/autoload.php';
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
	$mail->Password = $password;
	$mail->From = '1575636507@qq.com';

	$mail->addAddress($to);
	$mail->Subject = $subject;
	$mail->Body = $body;
	$mail->isHTML(true);

	$mail->send();
?>
