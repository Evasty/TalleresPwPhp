<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Taller 2 PW3, php, Alejandro A. 00020108631</title>
    <link rel="stylesheet" href="https://unpkg.com/purecss@2.0.3/build/pure-min.css" integrity="sha384-cg6SkqEOCV1NbJoCu11+bm0NvBRc8IYLRGXkmNrqUBfTjmMYwNKPWBTIKyw9mHNJ" crossorigin="anonymous">

</head>

<body>
    <div class="splash">
        <?php echo isset($top_message) ? $top_message : ""; ?>
    </div>
    <div class="pure-g"><h1 class="pure-u">Users things</h1></div>
    <div>
        <form action="./reqHandler.php" method="post" class="pure-form">
            <h2>Login</h2>
            <input type="text" name="user" value="<?php echo $failure&&isset($_POST['user']) ? $_POST['user']:'' ;?>" placeholder="nombre de usuario">
            <input type="password" name="pass" placeholder="contraseña">
            <input type="submit" name="login" value="Ingresar" class="pure-button pure-button-primary">
        </form>

        <h2>Register new user</h2>
        <form action="./reqHandler.php" method="POST" class="pure-form-stacked">
            <?php echo $formRegisterFields ?>
            <br>
            <input type="submit" name="register" value="register" class="pure-button pure-button-primary">

        </form>

        <div>

            <h3>Set up DB</h3>
            <form action="./index.php" method="POST" class="pure-form">
                <input type="submit" name="set_db" value="Reset DB" class="pure-button pure-button-primary">
            </form>
            <form action="./reqHandler.php" method="POST" class="pure-form">
                <input type="submit" name="logout" value="Salir" class="pure-button pure-button-primary">
            </form>

            <h3>Extra shiny stuff</h3>
            <br>
            <?php
            $size = rand(250, 1000);
            echo "<img src=https://picsum.photos/$size>";
            ?>
        </div>
</body>

</html>