<?php 
    require("./session.php");
    require("./retrieve.php");

    class Employee {
        public $salary;
        public $job_position;
        function setSalary($salary) {
            $this ->salary = $salary;
        }
        function getSalary() {
            return $this ->salary;
        }
        function setJobPosition($job_position) {
            $this ->job_position = $job_position;
        }
        function getJobPosition() {
            return $this ->job_position;
        }
    };

    $manager = new Employee();
    $manager -> salary = 25000;
    $manager -> job_position = "Manager";
    $fullStackDev = new Employee();

    $fullStackDev -> setJobPosition("Full Stack Developer");
    $fullStackDev -> setSalary(100000);
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">.
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
    <div class="container  text-center mt-3">
                <div class="d-flex column-gap-3">
            <h1>Welcome <?php echo $_SESSION['access']?>!</h1>
        </div>
    <h3>Create User</h3>
    <form action="./create.php" method="POST">
        <div class="row">
        <div class="col w-25">
        <input class="form-control" id="firstname" name="firstname" type="text" placeholder="Enter First Name" required>
        </div>
        <div class="col w-25">
        <input class="form-control" id="lastname" name="lastname" type="text" placeholder="Enter Last Name" required>
        </div>
        <div class="col w-25">
        <input class="form-control" id="email" name="email" type="email" placeholder="Enter Email Address" required>
        </div>
        <div class="col w-25">
        <input class="form-control" id="password" name="password" type="password" placeholder="Enter Password" >
        </div>
        <div class="col w-25">
        <select class="form-control" name="gender" id="gender">
            <option value="" readonly>Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>
        </div>
        <div class="col w-25">
        <select class="form-control" name="access" id="access">
            <option value="" readonly>Select Access Type</option>
            <option value="User">User</option>
            <option value="Admin">Admin</option>
        </select>
        </div>
        <div class="col w-25">
            <button class="btn btn-primary" id="create" name="create" type="submit" value="Create">Create</button>
        <!-- <input class="form-control" id="create" name="create" type="submit" value="Create"> -->
        </div>

        </div>
        </div>
    </form>
    </div>
    <?php
    if (mysqli_num_rows($result) > 0) {

    ?>
    <div class="container p-2">
    <table class="table table-dark table-hover ">
        <thead>
            <tr>
                <th scope="col">
                <a href="?col=first_name&sort=<?php echo $sort?>"><i class="bi bi-arrow-down-up"></i></a>
                First Name
                </th>
                <th scope="col">
                    <a href="?col=last_name&sort=<?php echo $sort?>"></a>
                    Last Name
                </th>
                <th scope="col">
                    <a href="?col=email&sort=<?php echo $sort?>"></a>
                    Email
                </th>
                    <th scope="col">
                    <a href=""></a>
                    Job
                </th>
                <th scope="col">
                    <a href=""></a>
                    Salary
                </th>
                <th scope="col">
                    <a href="?col=gender&sort=<?php echo $sort?>"></a>
                    Gender
                </th>
                <th scope="col">
                    <a href="?col=access&sort=<?php echo $sort?>"></a>
                    Access Type
                </th>
                    <?php 
                        if ($_SESSION['access'] == "Admin") :
                    ?>
                        <th>Action</th>
                    <?php 
                        endif;
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_array($result)) :
                ?>
                <tr>
                    <td><?php echo $row['first_name'] ?></td>
                    <td><?php echo $row['last_name'] ?></td>
                    <td><?php echo $row['email'] ?></td>
                    <td><?php echo $fullStackDev->getJobPosition()?></td>
                    <td><?php echo $fullStackDev->getSalary()?></td> 
                    <td><?php echo $row['gender'] ?></td>
                    <td><?php echo $row['access'] ?></td>
                    <?php 
                        if ($_SESSION['access'] == "Admin") :
                    ?>
                    <td class="d-flex justify-content-center column-gap-2">
                        <form action="./edit.php" method='post'>
                            <button class='btn btn-warning btn-sm' type="button" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $row['id']?>">Edit</button>
                            <input type="hidden" name="account_id" value=<?php echo $row['id']?>>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal<?php echo $row['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" role="dialog" data-bs-backdrop="static">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fw-bold" id="exampleModalLabel">Edit User <span class="text-primary"><?php echo $row['email'] ?></span>.</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body d-flex flex-column row-gap-3">
                                            <div class="form-group row">
                                                <label for="editFirstName" class="col-sm-3 col-form-label">First Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="editFirstName" name="editFirstName" value="<?php echo $row['first_name'] ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="editLastName" class="col-sm-3 col-form-label">Last Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="editLastName" name="editLastName" value="<?php echo $row['last_name'] ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="editEmail" class="col-sm-3 col-form-label">Email</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="editEmail" name="editEmail" value="<?php echo $row['email'] ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="editGender" class="col-sm-3 col-form-label">Gender</label>
                                                <div class="col-sm-9">
                                                    <select name="editGender" id="editGender" class="form-select">
                                                        <option value="" disabled>Select Gender</option>
                                                        <option value="Male" <?php echo ($row['gender'] == "Male") ? "selected" : "" ; ?>>Male</option>
                                                        <option value="Female" <?php echo ($row['gender'] == "Female") ? "selected" : "" ; ?>>Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="editAccess" class="col-sm-3 col-form-label">Access</label>
                                                <div class="col-sm-9">
                                                    <select name="editAccess" id="editAccess" class="form-select">
                                                        <option value="" disabled>Select Access Type</option>
                                                        <option value="User" <?php echo ($row['access'] == "User") ? "selected" : "" ; ?>>User</option>
                                                        <option value="Admin" <?php echo ($row['access'] == "Admin") ? "selected" : "" ; ?>>Admin</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <form action="./delete.php" method="post">
                            <button type="submit" class='btn btn-danger btn-sm' onclick="return confirm('Are you sure you want to delete?')">Delete</button>
                            <input type="hidden" name="account_id" value=<?php echo $row['id'] ?>>
                            <input type="hidden" name="tempEmail" value=<?php echo $row['email'] ?>>
                        </form>
                    </td>
                    <?php 
                        endif;
                    ?>
                </tr>
        
                <?php
                    endwhile;
                ?>
            </tbody>
        </table>
        
        
        <?php
        } else {
            echo "<div class='d-flex justify-content-center mt-4'><div class='alert alert-danger w-50 text-center'>No results were found!</div></div>";
        }
        ?>
    </div>
    ?>

    <form action="./logout.php" method="post">
        <div class="container">
            <button class="btn btn-danger me-5" type="submit" value="logout" name="logout">Logout</button>
        </div>
    </form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>