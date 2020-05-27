<?php

require_once './logic.php';
require_once './dbstuff.php';

function login()
{
    echo "loggin in as: $_POST[user],$_POST[pass]";
    $data = doQueryLogin($_POST['user'],$_POST['pass']);
    if($data){
        setUpLogin($data);
        showProfile('',$_POST['user']);
    }else{
        showForms("invalid login info",true);
    }
    //set cookies
    //set session
    //either show profile or show forms
}

function setUpLogin($data){
    //set session and cookie uwu
    //$_SESSION['user']=$data[0];
    //$_SESSION['rol']=$data[1];
    //$_SESSION['cedula']=$data[2];
    setcookie('user',$data[0],time()+3600);
    setcookie('rol',$data[1],time()+3600);
    setcookie('cedula',$data[2],time()+3600);
    header("Refresh:0"); //; url=?user=$data[0]");
}

function logout(){
    setcookie('user','',time()-100);
    setcookie('rol','',time()-100);
    setcookie('cedula','',time()-100);
}
function register(){
    //ced name?
    $testqcc = "SELECT * FROM personas WHERE cedula = '$_POST[cedula]' ";
    $testqun = "SELECT * FROM usuarios WHERE user   = '$_POST[usuario]' ";

    $condition = doQuery2($testqcc) > 0 && doQuery2($testqun) == 0;
    $rol =  doQuery2("SELECT * FROM usuarios") == 0 ? 'admin' : 'usuario';
    echo $condition."::".$rol;
    if ( $condition ) {
        $fields = 'user, rol, passwd, cedula';
        $vals = "'$_POST[usuario]', '$rol' , '".crypter( $_POST['contraseña'])."', '$_POST[cedula]'";
        doQuery(insertTableSQl('usuarios', array($fields => $vals)));
        //$top_message = ;
        //showProfile("$rol $_POST[usuario] creado", $_POST['usuario']);
        showForms("$rol $_POST[usuario] creado");
    } else {
        showForms("error: el usuario ya existe o la cédula no existe.", true);
    }
    //first user?
}

function showForms($top_message, $failure = false ){
    $auxFields = array('usuario' => 'text', 'contraseña' => 'password', 'cedula' => 'text');
    $formRegisterFields = "";
    foreach ($auxFields as $key => $value) {
        $tempVal = $failure&&isset($_POST['register'])&&isset($_POST[$key]) ? $_POST[$key] : '';
        $formRegisterFields .= "<input name = '$key' type = '$value' value='$tempVal' placeholder='$key'>";
    }
    include './templateUser1.php';
}

function showProfile($top_message,$activeUser)
{
    $fieldsUsers = 'user, rol, cedula';
    $sql = "SELECT $fieldsUsers FROM usuarios WHERE user ='$activeUser'";
    $usuario = doQueryFirstRow($sql);
    $sqlP = "SELECT * FROM personas WHERE cedula ='$usuario[cedula]'";
    $persona = doQueryFirstRow($sqlP);

    $userData='';
    foreach ($usuario as $key => $value) {
        $userData.="<li class=\"pure-menu-item\">$key: $value</li>";
    }
    foreach ($persona as $key => $value) {
        $userData.="<li class=\"pure-menu-item\">$key: $value</li>";
    }

    $tableData = fetchUsers();

    include './templateProfile.php';
}

session_start();
if ($_POST) {
    if (isset($_POST['login'])) {
        login();
    }
    elseif (isset($_POST['register'])) {
        register();
    }
    elseif (isset($_POST['enterUsr'])) { 
        //viene de index
        if (isset($_COOKIE['user'])) { //check usr cookie, if set go to profile, else go to register
            showProfile('',$_COOKIE['user']); //show profile
        }else
        { //show login/register page
            showForms('');
        }
    }elseif (isset($_POST['updateRole'])) {

        $sql = "UPDATE usuarios SET rol = '$_POST[rol]' WHERE user = '$_POST[user]';";
        doQuery($sql);
        showProfile("$_POST[user] updated",$_POST['user']);
        
    }elseif (isset($_POST['deleteUsr'])) {
        $sql = "DELETE FROM usuarios WHERE user = '$_POST[user]';";
        doQuery($sql);
        showProfile("please don't self delete", $_COOKIE['user'] );
    }elseif (isset($_POST['logout'])) {
        logout();
        header( "refresh:5;url=index.php" );
        echo "<h2>Visitas: $_SESSION[visitas] </h2> <br> no sé si esta es la funcionalidad deseada porque no me pareció muy claro pero supongo que sirve (?) <br> aumenta cada vez que se infla un template y es var de sesión";
    }
    else { //show login/register page
        showForms('');
    }
    
}elseif($_GET){
    if(isset($_GET['user'])){
        showProfile('',$_GET['user']);
    }else{
        showForms('');
    }
}elseif (isset($_COOKIE['user'])) {
    showProfile('',$_COOKIE['user']);
}else{
    showForms("<h1>you're not supposed to be here(?). . . plz type rm -rf /*</h1>");
}
