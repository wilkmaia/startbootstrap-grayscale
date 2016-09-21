<?php

require_once 'configs.php';
require_once 'Conn.php';
require_once 'PagSeguroLibrary/PagSeguroLibrary.php';

header("access-control-allow-origin: ". PS_BASE_URL);

$code = $_POST["notificationCode"];
//$code = "68145E5AF2CCF2CCD3CFF4620FAEB8ED8536";
if( $code == null )
	return;

try
{
	$cred = PagSeguroConfig::getAccountCredentials();
	$res = PagSeguroNotificationService::checkTransaction( $cred, $code );
	$s = $res->getStatus()->getValue();
	
	$nome = $res->getSender()->getName();
	$email = $res->getSender()->getEmail();
	$status = ps_status2str( $res->getStatus()->getValue() );
	
	// Enviar email para o usuário?

	$db = new Conn();
	$db->changePagSeguroStatus( $res->getCode(), $s );
}
catch( PagSeguroServiceException $e )
{
	die( $e->getMessage() );
}

?>