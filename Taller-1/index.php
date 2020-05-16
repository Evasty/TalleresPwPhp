<?php
include_once './dbstuff.php';

session_start();
if (! isset( $_SESSION['asc']) || !isset( $_SESSION['name'] ) ) {
    $_SESSION['asc'] =false;
    $_SESSION['name']=true;
    
}

if($_POST){
    switch ($_POST['switch']) {
        case 'ced':
            $_SESSION['asc'] =!$_SESSION['asc'];
            $_SESSION['name']=false;
            break;
        case 'nom':
            $_SESSION['asc'] =!$_SESSION['asc'];
            $_SESSION['name']=true;
            break;
        
        default:
            
            break;
    } 
    
}

$tableData = getPersonaRowsSorted($_SESSION['name'],$_SESSION['asc']);
$auxFields = array('cedula' => 'text', 'nombre' => 'text' , 'apellido'=> 'text', 'email'=> 'text', 'edad'=> 'number');

$formCreateFields = "";
foreach ($auxFields as $key => $value) {
    $formCreateFields.= "<input name = $key type = $value placeholder=$key>";
}
include('./template.php');



?>