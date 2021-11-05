<?php
    require_once 'helper.php';
    $connection = connect_database();
    $pk = $_GET['id'];
    $stringWhoIs = "SELECT * FROM actor WHERE actor_id={$pk}";
    $resultWhoIs = mysqli_query($connection, $stringWhoIs);
    $row = mysqli_fetch_assoc($resultWhoIs);
    $firstNameDefault = $row['first_name'];
    $lastNameDefault = $row['last_name'];
    $msj = "";
    if (count($_POST) > 0) {
        $strUpdateRecord = "UPDATE actor SET first_name='{$_POST['first_name']}', last_name='{$_POST['last_name']}' WHERE actor_id = {$pk}";
        $responseDatabase = mysqli_query($connection, $strUpdateRecord);
        if ($responseDatabase) {
            $msj = "Su registro ha sido actualizado con éxito";
            $firstNameDefault = $_POST['first_name'];
            $lastNameDefault = $_POST['last_name'];
        } else {
            $msj = "Ha habido un problema al actualizar su registro.";
            echo mysqli_error($connection);
        }
    }
    mysqli_close($connection);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar</title>
</head>
<body>
    <a href="index.php"><< Regresar</a>
    <h1>Actualización de actor</h1>
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