<?php

require_once 'configs.php';
require_once 'Conn.php';
require_once 'sendMail.php';
require_once 'PagSeguroLibrary/PagSeguroLibrary.php';


$nome = @htmlspecialchars( $_POST["nome"] );
$tipo = @htmlspecialchars( $_POST["tipo"] );
$local = @htmlspecialchars( $_POST["local"] );
$numero = @htmlspecialchars( $_POST["numero"] );
$cargo = @htmlspecialchars( $_POST["cargo"] );
$cidade = @htmlspecialchars( $_POST["cidade"] );
$estado = @htmlspecialchars( $_POST["estado"] );
$camisa = @htmlspecialchars( $_POST["camisa"] );
$email = @htmlspecialchars( $_POST["email"] );
$telefone = @htmlspecialchars( $_POST["telefone"] );

function generatePassword()
{
	$alphabet = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789?)(*%$#!@+-=_~";
	$pass = array();
	$length = strlen( $alphabet );
	for( $i = 0; $i < 8; $i++ )
	{
		$n = rand( 0, $length );
		$pass[] = $alphabet[ $n ];
	}
	
	return implode( $pass );
}

$senha = generatePassword();

$preco = ( strtoupper( $tipo ) == "DM" ) ? 20.00 : 125.00;

$p = new PagSeguroPaymentRequest();
$p->addItem( '0001', 'Inscrição VII COBEPI', 1, $preco );
$p->setSender( $nome, $email );
$p->setCurrency( "BRL" );
$p->setRedirectUrl( PS_REDIR_URL ."?email=$email" );
$p->addParameter( 'notificationURL', PS_NOTIF_URL );

try
{
	$cred = PagSeguroConfig::getAccountCredentials();
	$chURL = $p->register( $cred );
	$url = $chURL;
}
catch( PagSeguroServiceException $e )
{
	$url = "ERRO";
}

$db = new Conn();
$res = $db->inscrever( array( $nome, $tipo, $local, $numero, $cargo, $cidade, $estado, $camisa, $email, $telefone, $senha ) ); // Retorna 0 para erro, 1 para sucesso ou NOME para email jรก cadastrado

if( $res == 1 )
{		
	$assunto = "[INSCRIÇÃO] VII COBEPI";
	//$url = MAIN_URL . "/pagamento.html?nome=". str_replace( " ", "%20", $nome ) ."&email=". $email;
	$text = '
		
		Parabéns, '. $nome .'! Sua inscrição foi realizada com sucesso.
		
		Logo estaremos juntos, compartilhando momentos inesquecíveis.
		O Bethel #03 - Filhas de Antares terá o prazer de recebê-lo(a) para esse evento maravilhoso e cheio de oportunidades dentro da Ordem.
		
		Sua senha única gerada é:
		'. $senha .'
		
		
		Para efetuar o pagamento da taxa de inscrição, basta clicar no link a seguir:
		'. $url .' 
		
		Caso o link esteja inacessível, copie-o e cole-o em seu navegador.
		
		
		Acompanhe as novidades em nossas redes sociais:
		Instagram @bethel03_fdjpi
		Instagram @viicobepi
		Facebook /viicobepi
		
		
		Que o Grande Arquiteto do Universo aben?oe seus passos.
		
		Bethel #03 - Filhas de Antares - Teresina - PI
		Ordem das Filhas de Jó Internacional
	';
	
	$html = '
		<center><img src="http://viicobepi.com.br/img/small_logo.png" alt="VII COBEPI" /></center><br />
		<br />
		Parabéns, ' . $nome . '! Sua inscrição foi concluída com êxito.<br />
		<br />
		Logo estaremos juntos, compartilhando momentos inesquecíveis.<br />
		O Bethel #03 - Filhas de Antares espera por você para estreitar os "Laços Fraternais das Filhas de Jó" no VII COBEPI.<br />
		<br />
		Sua senha única gerada é:<br />
		'. $senha .'<br />
		<br />
		<br />
		Para efetuar o pagamento da taxa de inscrição, basta clicar no link a seguir:
		<center><a href="'. $url .'">Pagar Inscrição</a></center>
			Caso o link esteja inacessível, copie-o e cole-o em seu navegador:<br />
		<center>'. $url .'</center><br />
		<br />
		<br />
		<center>Acompanhe as novidades nas nossas redes sociais:<br />
		Instagram Bethel #03: <a href="https://www.instagram.com/bethel03_fdjpi/">@bethel03_fdjpi</a><br />
		Instagram VII COBEPI: <a href="https://www.instagram.com/viicobepi/">@viicobepi</a><br />
		Facebook: <a href="https://www.facebook.com/VII-Cobepi-1543468332623454">/viicobepi</a><br />
		<br />
		<br />
		Que o Grande Arquiteto do Universo abençoe seus passos.<br />
		<br />
		<small>Bethel #03 - Filhas de Antares - Teresina - PI<br />
		Ordem das Filhas de Jó Internacional</small></center>
	';

	sendMail( $html, $text, $assunto, $email, $nome );
}

echo $res;

?>