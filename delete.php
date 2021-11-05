<?php
    require_once 'helper.php';
    $connection = connect_database();
    $pk = $_GET['id'];
    $strDelete = "DELETE FROM actor WHERE actor_id={$pk}";
    $resultDelete = mysqli_query($connection, $strDelete);
    if ($resultDelete) {
        $flag = 1;
    } else {
        $flag = 0;
    }
    header("Location: index.php?delete={$flag}");
?>