<?php

$dir = '../img/slideshow/';
$files = glob( $dir . '*.jpg' );

$res = array();

foreach( $files as $f )
{
	$res[] = basename( $f );
}

echo json_encode( $res );

?>