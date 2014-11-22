<?php 
define( 'DIR', pathinfo( str_replace( DIRECTORY_SEPARATOR, '/', __file__ ), PATHINFO_DIRNAME ) . '/../' );
if (!$_GET) die();
if (!$_GET['query'] && !$_GET['check']) die();

$file = date('d-m-y') . '.txt';
$fp = fopen(DIR . 'logs/' . $file, 'a');
fwrite($fp, $_SERVER['REMOTE_ADDR'] . ' - (' . date('d/m/y h:i:s') . ') ' . $_GET['query'] . "\n");
fclose($fp);

?>