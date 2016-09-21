<?php

require_once 'configs.php';
require_once 'Conn.php';

$db = new Conn();

// Type (FDJ, DM, ABEL, CONS)
$t = @htmlspecialchars( $_POST[ 't' ] );

echo $db->getCount( $t );

?>