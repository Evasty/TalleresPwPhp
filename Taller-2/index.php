<?php
include_once './dbstuff.php';
require "./logic.php";

session_start();
date_default_timezone_set('UTC');

if (!isset($_SESSION['asc']) || !isset($_SESSION['orderByName']) || !isset($_SESSION['visitas'])) {
    $_SESSION['asc'] = false;
    $_SESSION['orderByName'] = true;
    $_SESSION['visitas'] = 0;
}
$res = true;
if ($_POST) {
    //echo 
    //Table sort order
    if (isset($_POST['switch'])) {
        echo "switching $_POST[switch]";
        switch ($_POST['switch']) {
            case 'ced':
                $_SESSION['asc'] = !$_SESSION['asc'];
                $_SESSION['orderByName'] = false;
                break;
            case 'nom':
                $_SESSION['asc'] = !$_SESSION['asc'];
                $_SESSION['orderByName'] = true;
                break;

            default:

                break;
        }
    }  //sort order switch

    //add delete operations
    if(isset($_POST['add'])){
        $res = createPersona();
        $top_message = $res ? "$_POST[nombre], cc.: $_POST[cedula] created/updated" : "creation/update failure, revisar email, nombre, cedula";
    }
    if(isset($_POST['delete'])){
        $res = deletePersona();
        $top_message = $res ? "cc.: $_POST[cedula] deleted" : "deletion failure, perhaps $_POST[cedula] doens't exist";
    }
    if(isset($_POST['set_db'])){
        setUp();
        $top_message = "db resetted";
    }
}

$tableData = getPersonaRowsSorted($_SESSION['orderByName'], $_SESSION['asc']);
$auxFields = array('cedula' => 'text', 'nombre' => 'text', 'apellido' => 'text', 'email' => 'text', 'edad' => 'number');

$formCreateFields = "";
foreach ($auxFields as $key => $value) {
    $tempVal = !$res&&isset($_POST['add'])&&isset($_POST[$key]) ? $_POST[$key] : '';
    $formCreateFields .= "<input name = $key type = $value value='$tempVal' placeholder=$key>";
}
include('./template.php');
