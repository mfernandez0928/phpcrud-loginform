<?php 
    require("./connection/config.php");

    $sort = "ASC";
    $col = "id";

    if (isset($_GET['col']) && isset($_GET['sort'])) {
        $col = $_GET['col'];
        $sort = $_GET['sort'];
        $sort == "ASC" ? $sort = "DESC" : $sort = "ASC";
    }

    $query = "SELECT * FROM people ORDER BY $col $sort";

    $result = mysqli_query($connection, $query);
?>