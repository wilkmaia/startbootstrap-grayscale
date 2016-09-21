<?php

define( "MYSQL_ADDR", "localhost" );
define( "MYSQL_PORT", "3306" );
define( "MAIN_URL", "http://www.viicobepi.com.br" );
define( "DATABASE", "dsahbhbc_viicobepi" );
define( "DB_USERNAME", "dsahbhbc_wilkma" );
define( "DB_PASSWORD", "O[N9nHSi+O=o" );
define( "PS_TOKEN", "EF8E57D2B2C7436A86E8FF0020D9E46A" );
define( "PS_EMAIL", "ceicateixeira2016@gmail.com" );
define( "PS_BASE_URL", "https://pagseguro.uol.com.br" );
define( "PS_URL_WS", "https://ws.pagseguro.uol.com.br/v2/checkout/" );
define( "PS_URL", "https://pagseguro.uol.com.br/v2/checkout/payment.html" );
define( "PS_REDIR_URL", "http://www.viicobepi.com.br/index.html" );
define( "PS_NOTIF_URL", "http://www.viicobepi.com.br/scripts/ret.php" );


$ps_status = array(
	"None",
	"Aguardando Pagamento",
	"Em Análise",
	"Paga",
	"Disponível",
	"Em Disputa",
	"Devolvida",
	"Cancelada",
	"Debitado",
	"Retenção Temporária"
);
function ps_status2str( $s )
{
	switch( $s )
	{
		case 1:
		case 2:
		case 3:
		case 5:
		case 6:
		case 7:
		case 8:
		case 9:
			return $ps_status[ $s ];
		
		case 4:
			return "Paga";
			
		default:
			return "ERRO";
	}
}

?>