<?php
//verifies mail,ced,nom  format as required
function verifyMailCedName($mail, $ced, $name, $apel){
        //mail re: /^[a-z0-9](?:\.?[\w\d]+)*[a-z0-9]@[a-z0-9](?:\.?[\w\d]+)*[a-z0-9]$/i
        //mail re 2: ^[a-z0-9](?:\.?[\w\d]+)*[a-z0-9]@[a-z0-9](?:\.?[\w\d]+)*(?:\.[\w\d]+)[a-z0-9]$

        $vMail = preg_match('/^[a-z0-9](?:\.?[\w\d]+)*[a-z0-9]@[a-z0-9](?:\.?[\w\d]+)*(?:\.[\w\d]+)[a-z0-9]$/i', $mail);
        $vCed = preg_match('/^\d+$/', $ced);
        $vName = preg_match('/^[a-z]+(?: [a-z]+)*$/i', $name);
        $vApel = preg_match('/^[a-z]+(?: [a-z]+)*$/i', $apel);
        $res = $vMail && $vCed && $vName;
        
        //echo "<div>$vMail ::$mail <br> $vCed :: $ced <br> $vName ::$name <br> $res </div>";
        
        return $vMail && $vCed && $vName && $vApel;
}

function verifyMail($mail){
    //mail re: ^[a-z](?:\.?\w+)*[a-z]@[a-z](?:\.?\w+)*[a-z]$
    $vMail = preg_match('/^[a-z0-9](?:\.?\w+)*[a-z0-9]@[a-z0-9](?:\.?\w+)*[a-z0-9]$/i', $mail);
    return $vMail;
}

function verifyNumbers($ced){
    //mail re: ^[a-z](?:\.?\w+)*[a-z]@[a-z](?:\.?\w+)*[a-z]$
    $vCed = preg_match('/^\d+$/i', $ced);
    return $vCed;
}

function verifyName($name, $apel){
    //mail re: ^[a-z](?:\.?\w+)*[a-z]@[a-z](?:\.?\w+)*[a-z]$
    $vName = preg_match('/^[a-z]+(?: [a-z]+)*$/i', $name);
    $vApel = preg_match('/^[a-z]+(?: [a-z]+)*$/i', $apel);    
    return $vName && $vApel;
}


?>

