<?php
require('auth-session.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Dashboard</title>
  <!-- Bootstrap 5 CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="">User Dashboard</a>
    </div>
  </nav>
  
  <div class="container mt-4">
    <div class="row">
      <div class="col">
            <h2 class="card-title">Profile Information</h2>
            <strong class="card-text">Name: <?php echo $_SESSION['username'] ;?></strong>
            <br>
            <strong class="card-text">Email: <?php echo $_SESSION['email'] ;?></strong>
            <br>
            <br>
            <a href="logout.php" class="btn btn-primary">Log out</a>
      </div>
    </div>
  </div>
  
  <!-- Bootstrap 5 JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>