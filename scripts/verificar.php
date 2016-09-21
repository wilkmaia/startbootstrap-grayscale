<?php

require_once 'configs.php';
require_once 'Conn.php';

$email = @htmlspecialchars( $_POST["email"] );

$db = new Conn();

echo $db->verificar( $email );

?>