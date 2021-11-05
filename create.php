<?php
    require_once 'helper.php';
    $msj = '';
    $firstNameDefault = '';
    $lastNameDefault = '';
    if (count($_POST) > 0) {
        $firstNameDefault = $_POST['first_name'];
        $lastNameDefault = $_POST['last_name'];
        $connection = connect_database();
        $strValidateUser = "SELECT * FROM `actor` where first_name = '{$_POST['first_name']}' AND last_name = '{$_POST['last_name']}'";
        $queryValidator = mysqli_query($connection, $strValidateUser);
        if (mysqli_num_rows($queryValidator) > 0) {
            $msj = "Este usuario ya existe. Por lo tanto no se creara nuevamente.";
        } else {
            $stringInsert = "INSERT INTO actor(first_name, last_name) VALUES ('{$_POST['first_name']}', '{$_POST['last_name']}')";
            $responseDatabase = mysqli_query($connection, $stringInsert);
            if ($responseDatabase) {
                $msj = "Su registro ha sido guardado con éxito";
            } else {
                $msj = "Ha habido un problema para almacenar su registro.";
                echo mysqli_error($connection);
            }
        }
        mysqli_close($connection);
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear</title>
</head>
<body>
    <a href="index.php"><< Regresar</a>
    <h1>Bienvenido a crear nuevo actor</h1>
    <p class="message"><?php echo $msj; ?></p>
    <form method="POST">
        <label for="first_name">Nombre:</label>
        <input type="text" name="first_name" required="required" placeholder="Ingrese aqui su nombre" maxlength="45" size="50" value="<?php echo $firstNameDefault; ?>">
        <label for="first_name">Apellido:</label>
        <input type="text" name="last_name" required="required" placeholder="Ingrese aqui su apellido" maxlength="45" size="50" value="<?php echo $lastNameDefault; ?>">
        <button type="submit">Guardar</button>
    </form>
</body>
</html>