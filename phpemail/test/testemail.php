<?php
/**
* Simple example script using PHPMailer with exceptions enabled
* @package phpmailer
* @version $Id$
*/

require '../class.phpmailer.php';

try{
	$mail = new PHPMailer(true); //New instance, with exceptions enabled

	$body             = file_get_contents('contents.html');
	$body             = preg_replace('/\\\\/','', $body); //Strip backslashes

	$mail->IsSMTP();                           // tell the class to use SMTP
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	$mail->Port       = 25;                    // set the SMTP server port
	$mail->Host       = "smtp.126.com"; // SMTP server
	$mail->Username   = "Nomius";     // SMTP server username
	$mail->Password   = "libo&longli";            // SMTP server password

	//$mail->IsSendmail();  // tell the class to use Sendmail

	$mail->AddReplyTo("397327321@qq.com","First Last");

	$mail->From       = "nomius@126.com";
	$mail->FromName   = "libo";

	$to = "519509954@qq.com";

	$mail->AddAddress($to);

	$mail->Subject  = "First PHPMailer Message";

	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
	$mail->WordWrap   = 80; // set word wrap

	$mail->MsgHTML($body);

	$mail->IsHTML(true); // send as HTML

	for ($i=0;$i<4;$i++){
		$mail->Send();
		sleep(9);
		//echo $i."</br>";
	}	
	echo 'Message has been sent.';
}catch(phpmailerException $e) {
	echo $e->errorMessage();
}
	

	//echo 'Your email is out.';

?>