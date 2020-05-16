<?php
include_once './dbcfg.php';


function doQuery($sql){
    $conn = mysqli_connect(db_host , db_un,db_pwd,db_name);
    $retBool =  mysqli_query($conn,$sql);
    if ( !$retBool ){ echo mysqli_error($conn);}

    mysqli_close($conn);
    return $retBool; //yes it's a redbull pun, no longer a bool but meh
}

function doQuery2($sql){
    $conn = mysqli_connect(db_host , db_un,db_pwd,db_name);
    $res =  mysqli_query($conn,$sql);
    $retNotBool = mysqli_num_rows( $res );
    if ( !$retNotBool ){ echo mysqli_error($conn);}

    mysqli_close($conn);
    return $retNotBool; 
}

//return a sql statement to create a table
function createTableSQl( $tabName , $fields ){ //fields as field => type.
    $base = 'CREATE TABLE '.$tabName.' ( PID INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(PID)';
    //echo "<br>REEEEEEEEEEEEEE-_".$base;
    foreach ($fields as $key => $value) {
        $base .= ', '.$key.' '.$value;
    }
    $base.=')';
    return $base;
}


function insertTableSQl( $tabName , $field ){ //fields as fields => values. single string assumed or commas included
    $base = 'INSERT INTO '.$tabName;
    
    foreach ($field as  $f => $val) {
        $base .= ' ('.$f.') VALUES ('.$val.')' ;
    }
    return $base;
}

function getPersonaRowsSorted($name, $asc){
    $base = 'SELECT * FROM personas ORDER BY ';
    $base.= $name == true ? 'nombre ' : 'cedula '; 
    $base.= $asc == true ? 'ASC' : 'DESC'; 
    $conn = mysqli_connect(db_host , db_un,db_pwd,db_name);
    //echo "<br> $base <br>";
    $dbData = mysqli_query($conn,$base);
    $tableRows = "";
    while( $row = mysqli_fetch_assoc($dbData) ){
        $tableRows.= '<tr>';
        foreach ($row as $key => $value) {
            if($key!='PID')
            $tableRows.= '<td>'.$value.'</td>';
        }
        $tableRows.= '</tr>';
    }
    mysqli_close($conn);
    return $tableRows;

}

function updateTableSQl( $tableN, $tabelData){

    $base = "UPDATE $tableN SET ";
    foreach ($tabelData  as $key => $value) {
       $base.= $key=='edad' ? "$key = $value ," : "$key = '$value'  ,";
    }
    $base = rtrim($base,',');
    $base.= "WHERE cedula = '$tabelData[cedula]'";
    return $base;
}

function setUp(){
    doQuery('DROP TABLE personas');
    $persona = array('cedula' => 'CHAR(20) UNIQUE', 'nombre' => 'CHAR(20)', 'apellido' => 'CHAR(20)', 'email' => 'CHAR(20)', 'edad' => 'INT');
    doQuery( createTableSQl( 'personas', $persona) );
    
    $fields = 'cedula, nombre , apellido, email, edad';
    $val1 = "'ced1', 'nom1' , 'apel1', 'emai1', 12";
    $val2 = "'ced2', 'nom2' , 'apel2', 'emai2', 22";
    $val3 = "'ced3', 'nom3' , 'apel3', 'emai3', 32";
    doQuery( insertTableSQl( 'personas', array($fields => $val1)) );
    doQuery( insertTableSQl( 'personas', array($fields => $val2)) );
    doQuery( insertTableSQl( 'personas', array($fields => $val3)) );

} 

//setUp();

?>