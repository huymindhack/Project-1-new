<?php 
  include "../Project-1/mvc/core/code.php";

  $error = "";

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = $_POST['fullname'];
    $password = $_POST['password'];

    $regex = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/';

    if ($fullname == "" || $password == "") {
      $error = "Please fill out all the information";
    }

    // else if () {
    //   $error = "Email has already been used";
    // }

    else {
      $password_cript = md5($password);
      $sql = "select * from users_account where fullname = '$fullname' and password = '$password_cript'";

      $result = mysqli_query($conn, $sql);

      $rows = mysqli_fetch_assoc($result);

      if (mysqli_num_rows($result) > 0) {

        if ($rows['role'] != 'admin') {

          $_SESSION['fullname'] = $rows['fullname'];
          header("Location: Home");

        }

        else {
          header('Location: ../Project-1/mvc/views/Templete/admin/home.php');
        }

        
      } else {
        $error = "Incorrect full name  or password";
      }
    }
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jessica's Furniture</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <style>
    @media (min-width: 1000px) {
        #login-form {
            width: 40%;
        }
    }
  </style>
  <body class=" d-flex justify-content-center align-items-center bg-success">
    <div class="container-fluid">
        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="mx-auto py-3 px-5 mt-5 bg-white container-fluid" id="login-form" method="post">
            <h1 class="mb-5 text-center ">Login</h1>

            <?php if ($error != ""): ?>
              <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
              </div>
            <?php endif; ?>

            <div class="mb-3 mt-5 input-group">
                <span class="input-group-text"><i class="bi bi-person-circle"></i></span>

                <input type="text" placeholder="Enter your full name" name="fullname" class="form-control">
            </div>

            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="bi bi-key-fill"></i></span>

                <input type="password" placeholder="Enter your password" name="password" class="form-control">
            </div>

            <a href="forgot" class=" text-decoration-none text-success">Forgot your password?</a>

            <input type="submit" name="submit" class="btn btn-success w-100 mt-3 mb-3" value="Login">

            <hr>

            <p class=" text-success text-center">Don't have an account? <a href="signup" class=" font-italic text-success">Sign Up</a></p>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>