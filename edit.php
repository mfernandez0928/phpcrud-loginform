<?php 
require("./connection/config.php");

if (isset($_POST['account_id'])) {
    $first_name = $_POST['editFirstName'];
    $last_name = $_POST['editLastName'];
    $email = $_POST['editEmail'];
    $gender = $_POST['editGender'];
    $access = $_POST['editAccess'];

    $query = "UPDATE people SET first_name = '$first_name', last_name = '$last_name', gender = '$gender', access = '$access' WHERE email = '$email'";
    $result = mysqli_query($connection, $query);

    echo "<script>alert('Successfully updated account " . "$email!" . "')</script>";
    echo "<script>window.location.href='./index.php'</script>";
} else {
    echo "<script>window.location.href='./index.php'</script>";
}

?>