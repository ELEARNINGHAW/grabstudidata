<?php
session_start();
if( $_SESSION[ 'user_email' ] == "" )   { header( 'location:login/index.php' ); }
?>

<?php

include( 'inc/functions.php' );

$db = new SQLite3('../db/hallmonitor.db' );

if ( isset ( $_POST ) ) { actionHandler( $db ); }

$htmlData = getHtmlData( $db );

echo( $htmlData[ 'editorhead' ] );

echo getNewstickerEditor( $db );

echo  getScreenSlideEditor( $db );

?>