<?php
require_once './src/Mandrill.php'; 

function sendMail( $html, $text, $assunto, $to, $toName )
{
	try {
		$mandrill = new Mandrill('YqxqITK0pAnZVHvpPDn_Iw');
		
		$message = array(
			'html' => $html,
			'text' => $text,
			'subject' => $assunto,
			'from_email' => 'nao-responder@viicobepi.com.br',
			'from_name' => 'VII COBEPI - Não Responder',
			'to' => array(
				array(
					'email' => $to,
					'name' => $toName,
					'type' => 'to'
				)
			),
			'headers' => array('Reply-To' => 'nao-responder@viicobepi.com.br'),
			'attachments' => array()
		);
		$async = false;
		$ip_pool = 'Main Pool';
		$send_at = date('Y-m-d H:i:s');
		$result = $mandrill->messages->send($message, $async, $ip_pool, $send_at);
		/*
		Array
		(
			[0] => Array
				(
					[email] => recipient.email@example.com
					[status] => sent
					[reject_reason] => hard-bounce
					[_id] => abc123abc123abc123abc123abc123
				)
		
		)
		*/
	} catch(Mandrill_Error $e) {
		// Mandrill errors are thrown as exceptions
		//echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
		// A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
		//echo '<br/>';
		//echo date(DATE_RFC2822);
		throw $e;
	}
}

?>