<?php 
    require('./connection/config.php');
    session_start();
    $_SESSION['status'] = 'invalid';
    unset($_SESSION['email']);
    mysqli_close($connection);
    session_destroy();
    echo "<script>window.location.href='./login.php'</script>";
?>