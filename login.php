<?php 
require('include.php');
if(isset($_SESSION['username'])){
    header("Location:dashboard.php");
}

$errors = [];
if($_SERVER['REQUEST_METHOD']=='POST'){

	$email = filter_var(htmlspecialchars($_POST['email']), FILTER_SANITIZE_EMAIL);
	$password = $_POST['password'];

	$sql = $con->prepare("SELECT * FROM `user` WHERE `email`=:email");
	$sql->bindParam(':email',$email);
	$sql->execute();
	if($sql->rowCount()>0){
	$data = $sql->fetch(PDO::FETCH_ASSOC);
	if(password_verify($password,$data['password'])){
        $_SESSION['username'] = $data['username'];
        $_SESSION['email'] = $data['email'];
		header("Location:dashboard.php");
	}else{
		array_push($errors,"<h4>Invalid credentials</h4>");
	}
	}else{
		array_push($errors,"<h4>Invalid credentials</h4>");
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
            Login
          </div>
          <div class="card-body">
            <form action="login.php" method="post">
              <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" name="email">
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control"  name="password">
              </div>
              <button type="submit" class="btn btn-primary">Login</button>
            </form>
            <div class="text-center mt-3">
              Don't have an account? <a href="sign-up.php">Sign up</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>