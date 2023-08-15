<?php 

require('./connection/config.php');
if(isset($_POST['delete'])){
    $delete = $_POST['delete_id'];
    $query = "DELETE FROM people WHERE id = '$delete'";
    $result = mysqli_query($connection, $query);

    echo "<script>alert('Successfully Deleted')</script>";

    header("location: index.php");
}else{
    header("location: index.php");
}




?>