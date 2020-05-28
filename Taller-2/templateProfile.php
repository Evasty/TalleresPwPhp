<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="https://unpkg.com/purecss@2.0.3/build/pure-min.css" integrity="sha384-cg6SkqEOCV1NbJoCu11+bm0NvBRc8IYLRGXkmNrqUBfTjmMYwNKPWBTIKyw9mHNJ" crossorigin="anonymous">
</head>

<body>
<?php     setcookie('visitas', $_COOKIE['visitas']+1 ,time()+36000);?>
    <div class="splash">
        <?php echo isset($top_message) ? $top_message : ""; ?>
    </div>

    <div class="pure-g">
        <div class="pure-u-1">
        <h2>Datos del usuario</h2> 
        <ul class="pure-menu-list">
            <?php echo $userData ?>
        </ul>
        </div>
        <div class="pure-u-1">
        <form action="./reqHandler.php" method="POST" class="pure-form">
                <input type="submit" name="logout" value="Reset DB" class="pure-button pure-button-primary">
        </form>
        <form action="./reqHandler.php" method="POST" class="pure-form">
                <input type="submit" name="logout" value="Salir" class="pure-button pure-button-primary">
        </form>
        <?php
        $form = "
        <form action='./reqHandler.php' method='post' class='pure-form'>
            <h2>Editar</h2>
            <select name='rol' id='rol'>
                <option value='admin'>Admin</option>
                <option value='usuario'>Usuario</option>
            </select>
            <input type='text' name = 'user' value = $activeUser Hidden>
            <input type='submit' name='updateRole' value='Actualizar Rol' class='pure-button pure-button-primary'>
            <input type='submit' name='deleteUsr' value='Eliminar' class='pure-button pure-button-primary'>
        </form>";
        echo $_COOKIE['rol'] == 'admin' ? $form : '';
        ?>
        </div>  
    </div>
    <?php 
    $usrTable = "
    <div class=\"pure-g\">
        <h1 class=\"pure-u-1\">Usuarios</h1>
        <div class=\"pure-u-1\">
            <table class=\"pure-table\">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Rol</th>
                    </tr>
                </thead>
                $tableData 
            </table>
        </div>
    </div>";
    echo $_COOKIE['rol'] == 'admin' ? $usrTable : '';
    ?>
</body>

</html>