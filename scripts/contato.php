<?php

require_once 'configs.php';
require_once 'sendMail.php';

$nome = htmlspecialchars( $_POST[ "nome" ] );
$assunto = htmlspecialchars( $_POST[ "assunto" ] );
$telefone = htmlspecialchars( $_POST[ "telefone" ] );
$email = htmlspecialchars( $_POST[ "email" ] );
$msg = htmlspecialchars( $_POST[ "msg" ] );


$subject = "[CONTATO] ". $assunto;
$html = '
	<strong>Nome:</strong> '. $nome .' <br />
	<strong>Telefone:</strong> '. $telefone .' <br />
	<strong>E-mail:</strong> '. $email .' <br /><br />
	<strong>Mensagem:</strong> '. str_replace( "\n", "<br />", $msg ) .' <br />
';

$txt = '
Nome: '. $nome .'
Telefone: '. $telefone .'
E-mail: '. $email .'

Mensagem: '. $msg .'
';

$to = "contato@viicobepi.com.br";
$toName = "Contato - VII COBEPI";

sendMail( $html, $txt, $subject, $to, $toName );
//echo $html;

?>