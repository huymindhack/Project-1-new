<?php 
  session_start();
  include "../Project-1/mvc/core/code.php";
  $sql = "select * from orders where status = 'uncharged'";

  $result = mysqli_query($conn, $sql);

  if (isset($_POST['pay'])) {
      while ($row = mysqli_fetch_array($result)) {
        $id = $row['id'];
        $sql = "update orders set status = 'charged' where id = $id";
        
        if (mysqli_query($conn, $sql)) {
          echo "<script>alert('Your stuff will arrived at your home as soon as possible');</script>";
        }
      }
  }
?>

<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <link rel="icon" href="images/fevicon.png" type="image/gif" />
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Edgecut</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="../Project-1/mvc/views/Templete/css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700&display=swap" rel="stylesheet" />

  <!-- font awesome style -->
  <link href="../Project-1/mvc/views/Templete/css/font-awesome.min.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="../Project-1/mvc/views/Templete/css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="../Project-1/mvc/views/Templete/css/responsive.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body class="sub_page">

    <div class="hero_area">
        <!-- header section strats -->
        <?php include "header.php" ?>
        <!-- end header section -->
    </div>


    <?php if (mysqli_num_rows($result) == 0): ?>
        <section class="layout_padding">
            <div class="container">
                <div class="alert alert-danger">
                    There are still no order yet!!!
                </div>
            </div>
        </section>
    <?php else: ?>
        <section class="layout_padding">
            <div class="container">
              <div class="heading_container mb-4">
                <h2>Order Information</h2>
              </div>
                
              <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th class="bg-success text-center text-white">Customer</th>
                            <th class="bg-success text-center text-white">Phone Number</th>
                            <th class="bg-success text-center text-white">Address</th>
                            <th class="bg-success text-center text-white">Date</th>
                            <th class="bg-success text-center text-white">Payment Method</th>
                            <th class="bg-success text-center text-white">Total Price</th>
                            <th class=" bg-success text-center text-white">Status</th>
                        </tr>

                        <?php 
                            
                            while ($row = mysqli_fetch_array($result)) {
                            
                        ?>
                            <tr>
                                <td align="center"><?php echo $row['customer_name']; ?></td>
                                <td align="center"><?php echo $row['phone_number']; ?></td>
                                <td align="center"><?php echo $row['address']; ?></td>
                                <td align="center"><?php echo $row['order_date']; ?></td>
                                <td align="center"><?php echo $row['payment_method']; ?></td>
                                <td align="center"><?php echo $row['total_price']; ?></td>
                                <td align="center"><p class="p-3 bg-warning text-white font-weight-bold rounded-lg"><?php echo $row['status']; ?></p></td>
                            </tr>
                        <?php

                            }
                        ?>
                    </table>
                </div>

                <form action="order" method="post" class="mt-3">
                      <input type="submit" name="pay" value="Pay Now" class="btn btn-primary w-100">
                </form>
            </div>
        </section>
    <?php endif; ?>

  <!-- info section -->
  <?php include "info_section.php" ?>
  <!-- end info_section -->


  <!-- footer section -->
  <footer class="footer_section">
    <div class="container">
      <p>
        &copy; <span id="displayYear"></span> All Rights Reserved By
        <a href="https://html.design/">Free Html Templates</a>
      </p>
    </div>
  </footer>
  <!-- footer section -->


  <!-- jQery -->
  <script src="../Project-1/mvc/views/Templete/js/jquery-3.4.1.min.js"></script>
  <!-- bootstrap js -->
  <script src="../Project-1/mvc/views/Templete/js/bootstrap.js"></script>
  <!-- custom js -->
  <script src="../Project-1/mvc/views/Templete/js/custom.js"></script>
  <!-- Google Map -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap"></script>
  <!-- End Google Map -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <!-- End Google Map -->

</body>

</html>