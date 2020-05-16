<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Taller 1 PW3,  php,  Alejandro A. 00020108631</title>
    <link rel="stylesheet" href="https://unpkg.com/purecss@2.0.3/build/pure-min.css" integrity="sha384-cg6SkqEOCV1NbJoCu11+bm0NvBRc8IYLRGXkmNrqUBfTjmMYwNKPWBTIKyw9mHNJ" crossorigin="anonymous">
    
</head>
<body>
    <h1>Gestor personas</h1>
    <table class="pure-table">
        <thead>
            <tr>
            <form action="./index.php" method="POST"><th><input type="submit" value="Cédula">  </th>  <input type="hidden" name="switch" value="ced"> </form>
            <form action="./index.php" method="POST"> <th><input type="submit" value="Nombre"></th> <input type="hidden" name="switch" value="nom">
            <th>Apellido</th>
            <th>Email</th>
            <th>Edad</th>
            </tr>
        </thead>
        <?php echo $tableData ?>
    </table>

    <h3>Agregar</h3>
    <form action="./create.php" method="GET" class="pure-form">
        <?php echo $formCreateFields?>
        <br>
        <input type="submit" class="pure-button pure-button-primary">    

    </form>
    <h3>Eliminar</h3>
    <form action="./delete.php" method="GET" class="pure-form">
        Cédula
        <input type="text" name="cedula" > 
        <br>
        <input type="submit" class="pure-button pure-button-primary">    

    </form>
    <h3>Archivos</h3>
    <form action="./fileLoader.php" method="POST" enctype="multipart/form-data" class="pure-form">
        Seleccionar archivo:
        <input type="file" name="data" > 
        <br>
        <input type="submit" value = "cargar" class="pure-button pure-button-primary">    

    </form>
    <br>
    <?php
    $size = rand(250,1000);
    echo "<img src=https://picsum.photos/$size>";
    ?>
</body>
</html>