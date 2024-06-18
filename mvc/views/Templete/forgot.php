<?php 
    include "../Project-1/mvc/core/code.php";

    $error = "";
    $email_forgot = "";

    if (isset($_POST['submit'])) {
        $email_forgot = $_POST['email-forgot'];

        if ($email_forgot == "") {
            $error = "Invalid email address";
        }

        else {
            $sql = "select * from users_account where email = '$email_forgot'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                $_SESSION['email_forgot'] = $email_forgot;
            }

            else {
                $error = "Wrong email address";
            }
        }
    }

    if (isset($_POST['reset'])) {
        $password = $_POST['password_forgot'];
        $password_confirm = $_POST['password_confirm_forgot'];

        if ($password == "" || $password_confirm == "") {
            $error = "Please enter a new password";
        }

        else if ($password != $password) {
            $error = "Passwords do not match";
        }

        else {
            $email_forgot_session = $_SESSION['email_forgot'];

            $password_crypt = md5($password);
            $sql = "update users_account set password = '$password_crypt' where email = '$email_forgot_session'";

            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Password has been updated');</script>";
                unset($_SESSION['email_forgot']);
                header("Location: login");
            }

            else {
                echo "<script>alert('An error has been occur while updating the password')</script>";
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
        <?php if (!isset($_SESSION['email_forgot'])): ?>
            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="mx-auto py-3 px-5 mt-5 bg-white container-fluid" id="login-form" method="post">
            <h1 class="mb-5 text-center ">Email Verification</h1>

            <?php if ($error != ""): ?>
              <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
              </div>
            <?php endif; ?>

            <div class="mb-3 mt-5 input-group">
                <span class="input-group-text">@</span>

                <input type="email" placeholder="Enter your email" name="email-forgot" class="form-control">
            </div>

            <input type="submit" name="submit" class="btn btn-success w-100 mt-3 mb-3" value="Submit">
            </form>
        <?php else: ?>
            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="mx-auto py-3 px-5 mt-5 bg-white container-fluid" id="login-form" method="post">
            <h1 class="mb-5 text-center ">Reset Password</h1>

            <?php if ($error != ""): ?>
              <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
              </div>
            <?php endif; ?>

            <div class="mb-3 mt-5 input-group">
                <span class="input-group-text"><i class="bi bi-key-fill"></i></span>

                <input type="password" placeholder="Enter your new password" name="password_forgot" class="form-control">
            </div>

            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="bi bi-key-fill"></i></span>

                <input type="password" placeholder="Confirm password" name="password_confirm_forgot" class="form-control">
            </div>

            <input type="submit" name="reset" class="btn btn-success w-100 mt-3 mb-3" value="Reset">
            </form>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>