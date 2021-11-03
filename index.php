<?php
    $connection = mysqli_connect("localhost", "root", "", "sakila");
    if (!$connection) {
        echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
        echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
        echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }
    $page = $_GET['page'] ?? 1;
    $page = (int) $page;
    //var_dump($page);
    /*
        Version Larga de validación parametro GET

        if (is_null($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }
        */
    /**
     * Page 1: Record 0
     * Page 2: Record 10
     * Page 3: Record 20
     * Page 4: Record 30
     */
    $quantityItems = 10;
    $record = ($page - 1) * $quantityItems;
    /**
     * Lado programación
            $stringQueryTotal = "SELECT * FROM actor";
            $responseDB = mysqli_query($connection, $stringQueryTotal);
            $totalRows = mysqli_num_rows($responseDB);
            $totalPages = ceil($totalRows/$quantityItems);
    */
    /**
     * Lado motor mysql
     */
    $stringQueryCount = "SELECT COUNT(*) AS conteo FROM actor";
    $query = mysqli_query($connection, $stringQueryCount);
    $totalRows = mysqli_fetch_assoc($query);
    $totalPages = ceil($totalRows['conteo']/$quantityItems);
    $stringQuery = "SELECT * FROM actor LIMIT {$record}, {$quantityItems}";
    $responseDatabase = mysqli_query($connection, $stringQuery);

    /**
     * Ciclo while siempre le doy una condicion si la misma se cumple el ciclo se repite, si el resultado en algun momento
     * es false el ciclo se rompe
     * ¿Cual es el resultado de cualquier condicion? V o F
     * 
     * while (T) => Repite
     * while (F) => Detiene
     * 
     * NULL es lo mismo que FALSE
            $fila = mysqli_fetch_assoc($responseDatabase);
            while ($fila != NULL) {
                var_dump($fila);
                echo "<br>";
                $fila = mysqli_fetch_assoc($responseDatabase);
            }
    */
    $actors = [];
    while ($fila = mysqli_fetch_assoc($responseDatabase)) {
        $actors[] = $fila;
    }
    mysqli_close($connection);
    //var_dump($actors);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de actores</title>
</head>

<body>
    <h1>Lista de actores</h1>
    <table border="1">
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th colspan="2">Acciones</th>
        </tr>
        <?php foreach ($actors as $key => $row) { ?>
            <tr>
                <td><?php echo $row['first_name'] ?></td>
                <td><?php echo $row['last_name'] ?></td>
                <td><a href="#">Editar</a></td>
                <td><a href="#">Eliminar</a></td>
            </tr>
        <?php } ?>
    </table>
    <?php if ($page - 1 > 0) { ?>
        <a href="./index.php?page=<?php print($page - 1); ?>"><< Anterior</a>
    <?php } ?>
    <?php if ($page < $totalPages) { ?>
        <a href="./index.php?page=<?php print($page + 1); ?>">Siguiente >></a>
    <?php } ?>
</body>

</html>