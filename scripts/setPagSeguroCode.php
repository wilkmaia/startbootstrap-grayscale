<?php

require_once 'configs.php';
require_once 'Conn.php';

$email = @htmlspecialchars( $_POST["email"] );
$id = @htmlspecialchars( $_POST["id"] );

$db = new Conn();

echo $db->setPagSeguroCode( $email, $id );

?>