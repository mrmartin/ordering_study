<?php
date_default_timezone_set('Europe/London');
session_start();
if(isset($_POST["mejl"]) && isset($_POST["agree"])){
	$_SESSION["mejl"]=$_POST["mejl"];
}
if(isset($_SESSION["mejl"])){
	$_POST["mejl"]=$_SESSION["mejl"];
	if(isset($_SESSION["cur_im"])){
		$_SESSION["cur_im"] = $_SESSION["cur_im"] + 1;
	}
}
//echo session_id();
$myFile = "testFile.txt";
$fh = fopen($myFile, 'a') or die("can't open file");
fwrite($fh, date('Y-m-d H:i:s') . " ");
fwrite($fh, $_SERVER['REMOTE_ADDR'] . " ");
fwrite($fh, session_id() . " ");
foreach( $_POST as $stuff ) {
    if( is_array( $stuff ) ) {
        foreach( $stuff as $thing ) {
            echo $thing;
        }
    } else {
        fwrite($fh, $stuff . " ");
    }
}
fwrite($fh, "\n");
fclose($fh);

header( 'Location: /' ) ;
?>