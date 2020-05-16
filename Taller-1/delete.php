<?php
header( "refresh:3;url=index.php" );
echo "<h2>Delete $_GET[cedula] attempted</h2>";
require_once './dbstuff.php';
doQuery("DELETE FROM personas WHERE cedula = '$_GET[cedula]'")
?>