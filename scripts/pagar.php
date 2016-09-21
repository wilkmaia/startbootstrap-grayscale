<?php

require_once 'configs.php';
require_once 'PagSeguroLibrary/PagSeguroLibrary.php';

$nome = $_GET["nome"];
$email = $_GET["email"];

$p = new PagSeguroPaymentRequest();
$p->addItem( '0001', 'Inscrição VII COBEPI', 1, 125.00 );
$p->setSender( $nome, $email );
$p->setCurrency( "BRL" );
$p->setRedirectUrl( PS_REDIR_URL ."?email=$email" );
$p->addParameter( 'notificationURL', PS_NOTIF_URL );

try
{
	$cred = PagSeguroConfig::getAccountCredentials();
	$chURL = $p->register( $cred );
	echo $chURL;
}
catch( PagSeguroServiceException $e )
{
	die( $e->getMessage() );
}

?>