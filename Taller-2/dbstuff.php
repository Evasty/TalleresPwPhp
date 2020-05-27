<?php
include_once './dbcfg.php';

//returns boolean
function doQuery($sql)
{
    $conn = mysqli_connect(db_host, db_un, db_pwd, db_name);
    $retBool =  mysqli_query($conn, $sql);
    if (!$retBool) {
        echo mysqli_error($conn);
    }

    mysqli_close($conn);
    return $retBool; //yes it's a redbull pun
}

//returns some number stuff
function doQuery2($sql)
{
    $conn = mysqli_connect(db_host, db_un, db_pwd, db_name);
    $res =  mysqli_query($conn, $sql);
    $retNotBool = mysqli_num_rows($res);
    if (!$retNotBool) {
        echo mysqli_error($conn);
    }

    mysqli_close($conn);
    return $retNotBool;
}

function doQueryFirstRow($sql){
    $conn = mysqli_connect(db_host, db_un, db_pwd, db_name);
    $res =  mysqli_query($conn, $sql);
    
    $ret = is_bool($res) ? false : mysqli_num_rows($res);
    if (!$ret) {
        echo mysqli_error($conn);
    }else{
        $ret = mysqli_fetch_assoc($res);
    }

    mysqli_close($conn);
    //echo "ret::__".var_dump($ret)."::";
    return $ret;
}

//returns  array -> User, Role, C.C. OR false
function doQueryLogin($user, $pwd)
{
    $sql = "SELECT user, rol, cedula FROM usuarios WHERE user='$user' AND passwd='".crypter($pwd)."'";
    //echo "doQloginsql::".$sql;
    $conn = mysqli_connect(db_host, db_un, db_pwd, db_name);
    $res =  mysqli_query($conn, $sql);
    if (mysqli_num_rows($res) == 1) {
        $row = mysqli_fetch_assoc($res);
        echo "{$row['user']},{$row['rol']},{$row['cedula']}";
        $ret =  array($row['user'],$row['rol'],$row['cedula']);

    } else {
        echo mysqli_error($conn);
        $ret = false;
    }

    mysqli_close($conn);
    return $ret;
}

//return a sql statement to create a table
function createTableSQl($tabName, $fields)
{ //fields as field => type.
    $base = 'CREATE TABLE ' . $tabName . ' ( PID INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(PID)';
    //echo "<br>REEEEEEEEEEEEEE-_".$base;
    foreach ($fields as $key => $value) {
        $base .= ', ' . $key . ' ' . $value;
    }
    $base .= ')';
    return $base;
}


function insertTableSQl($tabName, $field)
{ //fields as fields => values. single string assumed or commas included
    $base = 'INSERT INTO ' . $tabName;

    foreach ($field as  $f => $val) {
        $base .= ' (' . $f . ') VALUES (' . $val . ')';
    }
    return $base;
}

function getPersonaRowsSorted($name, $asc)
{
    $base = 'SELECT * FROM personas ORDER BY ';
    $base .= $name == true ? 'nombre ' : 'cedula ';
    $base .= $asc == true ? 'ASC' : 'DESC';
    $conn = mysqli_connect(db_host, db_un, db_pwd, db_name);
    //echo "<br> $base <br>";
    $dbData = mysqli_query($conn, $base);
    $tableRows = "";
    while ($row = mysqli_fetch_assoc($dbData)) {
        $tableRows .= '<tr>';
        foreach ($row as $key => $value) {
            if ($key != 'PID')
                $tableRows .= '<td>' . $value . '</td>';
        }
        $tableRows .= '</tr>';
    }
    mysqli_close($conn);
    return $tableRows;
}

function fetchUsers()
{
    $base = 'SELECT user, rol FROM usuarios';
    $conn = mysqli_connect(db_host, db_un, db_pwd, db_name);
    //echo "<br> $base <br>";
    $dbData = mysqli_query($conn, $base);
    $tableRows = "";
    while ($row = mysqli_fetch_assoc($dbData)) {
        $tableRows .= "<tr>";
        foreach ($row as $key => $value) {
            if ($key != 'PID')
                $tableRows .= "<td><a href='./reqHandler.php?user=$row[user]'>" . $value . '</a></td>';
        }
        $tableRows .= '</tr>';
    }
    mysqli_close($conn);
    return $tableRows;
}


function updateTableSQl($tableN, $tabelData)
{

    $base = "UPDATE $tableN SET ";
    foreach ($tabelData  as $key => $value) {
        $base .= $key == 'edad' ? "$key = $value ," : "$key = '$value'  ,";
    }
    $base = rtrim($base, ',');
    $base .= "WHERE cedula = '$tabelData[cedula]'";
    return $base;
}


function crypter($pwd)
{
    //SALT
    $salt = "fancy shiny salty whiny weepy dashy slashy panty and stocking with garterbelt"; //yo! salty mofo
    return crypt($pwd, $salt);
}

function setUp()
{

    //DROP
    doQuery('DROP TABLE IF EXISTS usuarios');
    doQuery('DROP TABLE IF EXISTS personas');

    //PERSONAS 
    $persona = array('cedula' => 'CHAR(20) UNIQUE', 'nombre' => 'CHAR(20)', 'apellido' => 'CHAR(20)', 'email' => 'CHAR(20)', 'edad' => 'INT');
    doQuery(createTableSQl('personas', $persona));

    $fields = 'cedula, nombre , apellido, email, edad';
    $val1 = "'ced1', 'nom1' , 'apel1', 'emai1', 12";
    $val2 = "'ced2', 'nom2' , 'apel2', 'emai2', 22";
    $val3 = "'ced3', 'nom3' , 'apel3', 'emai3', 32";
    doQuery(insertTableSQl('personas', array($fields => $val1)));
    doQuery(insertTableSQl('personas', array($fields => $val2)));
    doQuery(insertTableSQl('personas', array($fields => $val3)));

    //USUARIOS
    $usuarios = array('user' => 'CHAR(20) UNIQUE', 'rol' => "ENUM('admin','usuario')", 'passwd' => 'CHAR(150)', 'cedula' => 'CHAR(20), FOREIGN KEY (cedula) REFERENCES personas(cedula)');
    doQuery(createTableSQl('usuarios', $usuarios));
    $fields = 'user, rol, passwd, cedula';
    $val1 = "'testUser1', 'usuario' , '" . crypter('testpw') . "', 'ced1'";
    //doQuery(insertTableSQl('usuarios', array($fields => $val1)));
} 

/* Se debe crear una tabla usuarios con las columnas: id (automático),
nombreusuario (único), rol (admin|usuario), contraseña y cédula (la cual debe
existir en la tabla de personas del taller anterior). La contraseña debe guardarse
cifrada*/ 


//setUp();
