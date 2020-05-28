<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Taller 2 PW3, php, Alejandro A. 00020108631</title>
    <link rel="stylesheet" href="https://unpkg.com/purecss@2.0.3/build/pure-min.css" integrity="sha384-cg6SkqEOCV1NbJoCu11+bm0NvBRc8IYLRGXkmNrqUBfTjmMYwNKPWBTIKyw9mHNJ" crossorigin="anonymous">

</head>

<body>
    <?php     setcookie('visitas', $_COOKIE['visitas']+1 ,time()+36000);?>
    <div class="splash">
        <?php echo isset($top_message) ? $top_message : ""; ?>
    </div>

    <div class="pure-g">
        <h3 class="pure-u-1">Stuff</h3>
        <div class="pure-u-1">
            <form action="./index.php" method="POST" class="pure-form">
                Set up DB:
                <input type="submit" name="set_db" value="Reset DB" class="pure-button pure-button-primary">
            </form>
        </div>
        <div class="pure-u-1">
            <form action="./reqHandler.php" method="POST" class="pure-form">
                <label for="enterUsr"> ingresar o registrarse (usuarios)</label>
                <input type="submit" id="enterUsr" name="enterUsr" value="login page" class="pure-button pure-button-primary">
            </form>
        </div>
        <div class="pure-u-1">
            <form action="./reqHandler.php" method="POST" class="pure-form">
                    <input type="submit" name="logout" value="Salir" class="pure-button pure-button-primary">
            </form>
        </div>
    </div>
    <br>
    

    <div class="pure-g">
        <h1 class="pure-u-1">Gestor personas</h1>
        <div class="pure-u-1">
            <table class="pure-table">
                <thead>
                    <tr>
                        <form action="./index.php" method="POST">
                            <th><input type="submit" value="Cédula"> </th> <input type="hidden" name="switch" value="ced">
                        </form>
                        <form action="./index.php" method="POST">
                            <th><input type="submit" value="Nombre"></th> <input type="hidden" name="switch" value="nom">
                        </form>
                        <th>Apellido</th>
                        <th>Email</th>
                        <th>Edad</th>
                    </tr>
                </thead>
                <?php echo $tableData ?>
            </table>
        </div>
    </div>

    <h3>Agregar</h3>
    <form action="./index.php" method="POST" class="pure-form">
        <?php echo $formCreateFields ?>
        <br>
        <input type="submit" name="add" class="pure-button pure-button-primary">

    </form>

    <h3>Eliminar</h3>
    <form action="./index.php" method="POST" class="pure-form">
        Cédula
        <?php $tempVal = !$res&&isset($_POST['delete'])&&isset($_POST['cedula']) ? $_POST['cedula'] : '';
        echo "<input type=\"text\" name=\"cedula\" value='$tempVal' placeholder=\"0000000\">"; ?>
        <br>
        <input type="submit" name="delete" class="pure-button pure-button-primary">

    </form>
    <br>
    <div>
        <?php echo "fecha: " . date(DATE_RFC2822) . "</br>"; ?>
        <h3>Archivos</h3>
        <form action="./fileLoader.php" method="POST" enctype="multipart/form-data" class="pure-form">
            Seleccionar archivo:
            <input type="file" name="data">
            <br>
            <input type="submit" value="cargar" class="pure-button pure-button-primary">

        </form>
        <br>
        <?php
        $size = rand(250, 1000);
        echo "<img src=https://picsum.photos/$size>";
        ?>
    </div>
</body>

</html>