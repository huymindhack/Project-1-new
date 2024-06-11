<?php 
  include "../Project-1/mvc/core/code.php";

  $error = "";

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    $regex = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/';

    $sql = "select * from users_account where email = '$email'";

    $result = mysqli_query($conn, $sql);

    if ($email == "" || $password == "") {
      $error = "Pleae fill out all the information";
    }

    else if (!preg_match($regex, $email)) {
      $error = "Invalid email address";
    }

    else if (mysqli_num_rows($result) > 0) {
      $error = "Email has already been used";
    }

    else if ($password != $password2) {
      $error = "Password mismatch";
    }

    else {
      $password_cript = md5($password);
      $data = array(
        "fullname" => $name,
        "email" => $email,
        "password" => $password_cript
      );

      if (insertData($conn, "users_account", $data)) {
        $_SESSION['fullname'] = $name;
        header("Location: Home");
      } else {
        $error = "Failed to register";
      }
    }
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
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
            <h1 class="mb-5 text-center ">Sign Up</h1>

            <?php if ($error != ""): ?>
              <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
              </div>
            <?php endif; ?>
            <div class="mb-3 mt-5 input-group">
              <span class="input-group-text"><i class="bi bi-person-circle"></i></span>
              <input type="text" placeholder="Enter your full name" name="name" class="form-control">
            </div>

            <div class="mb-3 input-group">
                <span class="input-group-text">@</span>

                <input type="text" placeholder="Enter your email" name="email" class="form-control">
            </div>

            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="bi bi-key-fill"></i></span>

                <input type="password" placeholder="Enter your password" name="password" class="form-control">
            </div>

            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="bi bi-key-fill"></i></span>

                <input type="password" placeholder="Confirm your password" name="password2" class="form-control">
            </div>

            <input type="submit" name="submit" class="btn btn-success w-100 mt-3 mb-3" value="Login">

            <hr>

            <p class=" text-success text-center">Already have an account? <a href="login" class=" font-italic text-success">Log in</a></p>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>