<?php
header( "refresh:3;url=./index.php" );
$msg = "Se ha existosa hacido la añadición.";
//form sql add
$fields = 'cedula, nombre , apellido, email, edad';

$vals = "'$_GET[cedula]', '$_GET[nombre]' , '$_GET[apellido]', '$_GET[email]', '$_GET[edad]'";
$vals2 = "$_GET[cedula], $_GET[nombre] , $_GET[apellido], $_GET[email], $_GET[edad]";

include_once("./dbstuff.php");

$testq = "SELECT * FROM personas WHERE cedula = '$_GET[cedula]'";

if( doQuery2($testq) > 0 ) {
    //echo "<br>:: >>s BANG upd<br>". var_dump( array_combine( explode(',',$fields),  explode(',',$vals2) ) );
    doQuery(updateTableSQl('personas', array_combine( explode(',',$fields),  explode(',',$vals2) ) ) ) ;
    $msg = "registry updated.";
}else{
    //echo "<br>:: >>s BANGin <br>". insertTableSQl( 'personas', array($fields => $vals));
    
    doQuery( insertTableSQl( 'personas', array($fields => $vals)) );
}
echo "<h2> $msg </h2>";



?>