<?php

require_once 'configs.php';
require_once 'Conn.php';

$email = @htmlspecialchars( $_POST["email"] );
$senha = @htmlspecialchars( $_POST["senha"] );

$db = new Conn();
echo $db->inscrever_concurso( $email, $senha ); // Retorna 1 para sucesso, 0 para falha, 2 para inscrição já realizada OU 3 para isncrição impossível (DM/APJ/CONSELHO/ABELHINHA)

?>