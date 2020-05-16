<?php
header( "refresh:3;url=./index.php" );

$str_pagina ="";
if ($_FILES["data"]["error"] > 0){
    $str_pagina.="Error: " . $_FILES["data"]["error"] . "<br>";
}
else  {
    $str_pagina.= "Nombre: " . $_FILES["data"] ["name"] . "<br>";
    $str_pagina.= "Tipo: " . $_FILES["data"]["type"] . "<br>";
    $str_pagina.= "Tamaño: " . ($_FILES["data"]["size"] / 1024) . " kB<br>";
    $str_pagina.= "Guardado en: " . $_FILES["data"]["tmp_name"];
}
echo $str_pagina;
    if (!file_exists('datum/')) {
       mkdir('datum/',0777,true);
    }
    move_uploaded_file($_FILES["data"]["tmp_name"],"datum/".$_FILES["data"]["name"]);
    echo "Guardado en: " . "datum/" . $_FILES["data"]["name"];

?>