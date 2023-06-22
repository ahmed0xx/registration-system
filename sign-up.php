<?php
require('include.php');
if(isset($_SESSION['username'])){
    header("Location:dashboard.php");
}

$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    // Validate and sanitize data
    $name = filter_var(htmlspecialchars($_POST['name']), FILTER_SANITIZE_STRING);
    $email = filter_var(htmlspecialchars($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    if ($_POST['name'] == '' || $_POST['email'] == '' || $_POST['password'] == '') {
        array_push($errors, "All fields are required");
    }
    if (strlen($_POST['password']) < 8 && $_POST['password']!='') {
        array_push($errors, "Password must be larger than 8 characters");
    }
    if (filter_var($email,FILTER_VALIDATE_EMAIL)==false && $_POST['email']!=''){
        array_push($errors,"Please enter valid email");
    }

    // check if email already exists in database
    $sql = $con->prepare("SELECT `email` FROM `user` WHERE `email`= '$email'");
    $sql->execute();
    if ($sql->rowCount() > 0) {
        array_push($errors, "Email already exists in database");
    }


    // insert data to Database
    if (empty($errors)) {
        $insert = $con->prepare("INSERT INTO `user`(`username`, `password`, `email`) VALUES (:name,:password,:email)");
        $insert->bindParam(':name', $name);
        $insert->bindParam(':password', $hashed_password);
        $insert->bindParam(':email', $email);
        $result = $insert->execute();
        if ($result) {
            echo " <script>alert('You are registered successfully.')</script> ";
        }
    }
}
?>



<!DOCTYPE html>
<html>

<head>
    <title>SafeSys</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <!-- show errors -->
                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    foreach ($errors as $error) {
                        echo "<div class='alert alert-danger' role='alert'> $error </div>";
                    }
                }
                ?>
                <div class="card">
                    <div class="card-header">
                        Sign Up
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="text" class="form-control" name="email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <button type="submit" class="btn btn-primary">Sign Up</button>
                        </form>
                        <div class="text-center mt-3">
                            Already have an account? <a href="login.php">Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>