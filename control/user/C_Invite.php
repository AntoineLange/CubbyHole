<?php
if(!empty($_POST)) {
	if(isset($_POST['email'])) {
		extract($_POST);
		$valid = (empty($email) || !filter_var($email,FILTER_VALIDATE_EMAIL)) ? false : true;
		$erreuremail = (empty($email) || !filter_var($email,FILTER_VALIDATE_EMAIL)) ? 'Indiquez un email valide' : null;
		
		if($valid) {
		
			$to = $email;
			
			$from = 'noreply@techbook.com';

			$sujet_mail = 'Rejoignez CubbyHole !';
			
			$message_html ='';
			$message_html .= '<html>';
			$message_html .= '<body>';
			$message_html .= '<p>'.$_SESSION['user'].' vous invite à rejoindre techbook !</p>';
			$message_html .= '<p>';
			$message_html .= '<a href="http://127.0.0.1/cubbyholeFinal/index.php">Rejoindre maintenant !</a>';
			$message_html .= '</p></body>';
			$message_html .= '</html>';
			
			$headers = 'MIME-version: 1.0'."\r\n";
			$headers .='Content-type: text/html; charset=utf-8'."\r\n";
			$headers .= "From: ".$_SESSION['user']."<".$from.">\r\n";
			$headers .= 'Reply-To: '.$from."\n";

			if (mail($to, $sujet_mail, $message_html, $headers)) {
				header('Location: index.php?page=invitation&msg=envoye');
			} else {
				header('Location: index.php?page=invitation&msg=erreur');
			}
		} else {
			header('Location: index.php?page=invitation&msg=erreur');
		}
	}
	else {
		header('Location: index.php?page=invitation&msg=champvide');
	}
} else {
	include_once("./view/user/V_Invite.php");
}
?>