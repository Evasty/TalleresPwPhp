<?php
require './utils.php';

function createPersona()
{
    //$msg = "creation failed";
    $success = false;

    if (!verifyMailCedName($_POST['email'], $_POST['cedula'],  $_POST['nombre'], $_POST['apellido'])) {
        return false;//"mail, nombre o cédula incorrectos";
    }
    //form sql add
    $fields = 'cedula, nombre , apellido, email, edad';

    $vals = "'$_POST[cedula]', '$_POST[nombre]' , '$_POST[apellido]', '$_POST[email]', '$_POST[edad]'";
    $vals2 = "$_POST[cedula], $_POST[nombre] , $_POST[apellido], $_POST[email], $_POST[edad]";

    include_once("./dbstuff.php");

    $testq = "SELECT * FROM personas WHERE cedula = '$_POST[cedula]'";

    if (doQuery2($testq) > 0) {
        //echo "<br>:: >>s BANG upd<br>". var_dump( array_combine( explode(',',$fields),  explode(',',$vals2) ) );
        $success = doQuery(updateTableSQl('personas', array_combine(explode(',', $fields),  explode(',', $vals2))));
        //$msg = "$_POST[nombre] updated";
    } else {
        //echo "<br>:: >>s BANGin <br>". insertTableSQl( 'personas', array($fields => $vals));
        $success =  doQuery(insertTableSQl('personas', array($fields => $vals)));
        //$msg = "$_POST[nombre] created w cc.: $_POST[cedula]";
    }
    return $success;
}

function deletePersona()
{
    if (isset($_POST['cedula']) && doQuery2("SELECT * FROM  personas WHERE cedula = '$_POST[cedula]'")>0 ) {
        return doQuery("DELETE FROM  personas WHERE cedula = '$_POST[cedula]'");
        // "Delete $_POST[cedula] attempted";
    }
    return false;
}
