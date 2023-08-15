<?php 
require("./connection/config.php");
session_start();
if(@$_SESSION['status'] == "invalid" || empty(@$_SESSION['status'])) {
    $_SESSION['status'] = "invalid";
} else {
    echo "<script>window.location.href='./index.php'</script>";
}

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        echo "<script>alert('Please fill out the filled!');</script>";
    } else {
        $query = "SELECT * FROM PEOPLE WHERE email = '$email'";
        $result = mysqli_query($connection, $query);

        $rowValidate = mysqli_fetch_array($result);
        if (password_verify($password, $rowValidate['password'])) {
            $_SESSION['email'] = $email;
            $_SESSION['status'] = 'valid';
            $_SESSION['access'] = $rowValidate['access'];
            echo "<script>alert('Successfully logged in!');</script>";
            echo "<script>window.location.href='./index.php'</script>";
        } else {
           echo "<script>alert('Invalid Password!');</script>";
        }
        // $query = "SELECT * FROM people WHERE email = '$email' AND password = '$password'";
        // $result = mysqli_query($connection, $query);
        // $row = mysqli_fetch_assoc($result);
        // if ($row) {
        //     $_SESSION['status'] = "valid";
        //     $_SESSION['email'] = $email;
        //     header("location:./index.php");
        // } else {
        //     echo "<script>alert('Invalid Username or Password!');</script>";
        // }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
    <div class="container">
<section class="vh-100">
  <div class="container py-5 h-100">
    <div class="row d-flex align-items-center justify-content-center h-100">
        <div class="col-md-3 col-lg-5 col-xl-4">
        <img src="https://img.freepik.com/icones-gratuites/connexion_318-275322.jpg"
          class="img-fluid">
      </div>
      <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
        <form action="login.php" method="POST">
          <!-- Email input -->
          <div class="form-outline mb-4">
            <input type="email" id="email" name="email" class="form-control form-control-lg" />
            <label class="form-label" for="email">Email address</label>
          </div>

          <!-- Password input -->
          <div class="form-outline mb-4">
            <input type="password" id="password" name="password" class="form-control form-control-lg" />
            <label class="form-label" for="password">Password</label>
          </div>

          <div class="d-flex justify-content-around align-items-center mb-4">
            <!-- Checkbox -->
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
              <label class="form-check-label" for="form1Example3"> Remember me </label>
            </div>
            <a href="#!">Forgot password?</a>
          </div>

          <!-- Submit button -->
          <button type="submit" class="btn btn-primary btn-lg btn-block" value="login" name="login">Sign in</button>
        </form>
      </div>
    </div>
  </div>
</section>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>