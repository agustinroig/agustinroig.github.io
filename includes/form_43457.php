<?php	
	if (empty($_POST['name_43457']) && strlen($_POST['name_43457']) == 0 || empty($_POST['email_43457']) && strlen($_POST['email_43457']) == 0 || empty($_POST['message_43457']) && strlen($_POST['message_43457']) == 0)
	{
		return false;
	}
	
	$name_43457 = $_POST['name_43457'];
	$email_43457 = $_POST['email_43457'];
	$message_43457 = $_POST['message_43457'];
	
	$to = 'receiver@yoursite.com'; // Email submissions are sent to this email

	// Capture
	$secretKey = '';
    $captcha = $_POST['g-recaptcha-response'];

    if (!$captcha)
    {
    	echo 'capture-error';
    	exit;
    }

	// Capture
	$ip = $_SERVER['REMOTE_ADDR'];
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
    $responseKeys = json_decode($response,true);

    if (intval($responseKeys["success"]) !== 1)
    {
    	echo 'capture-connection-error';
    	exit;
    }
    else
    {   
    	// Create email	
		$email_subject = "Message from a Blocs website.";
		$email_body = "You have received a new message. \n\n".
		"Name_43457: $name_43457 \nEmail_43457: $email_43457 \nMessage_43457: $message_43457 \n";
		$headers = "MIME-Version: 1.0\r\nContent-type: text/plain; charset=UTF-8\r\n";	
		$headers .= "From: contact@yoursite.com\n";
		$headers .= "Reply-To: $email_43457";	
	
		mail($to,$email_subject,$email_body,$headers); // Post message
    }			
?>
