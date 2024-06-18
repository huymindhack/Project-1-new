<?php 
  session_start();
  include "../Project-1/mvc/core/code.php";
  $sort_option = "name ASC";

// Check if a sort option is selected
  if (isset($_POST['sort_by'])) {
      switch ($_POST['sort_by']) {
          case 'name_asc':
              $sort_option = "p_name ASC";
              break;
          case 'name_desc':
              $sort_option = "p_name DESC";
              break;
          case 'price_asc':
              $sort_option = "price ASC";
              break;
          case 'price_desc':
              $sort_option = "price DESC";
              break;
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

  <title>Jessica's Furniture</title>
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

  <!-- furniture section -->

  <section class="furniture_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Our Furniture
        </h2>
        <p>
          which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't an
        </p>
      </div>

      <form method="post" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <select name="sort_by" class="form-select" onchange="this.form.submit()">
          <option value="name_asc">Name A-Z</option>
          <option value="name_desc">Name Z-A</option>
          <option value="price_asc">Price Low to High</option>
          <option value="price_desc">Price High to Low</option>
        </select>
      </form>
              
      <div class="row">
          <?php 
              if (isset($_POST['sort_by'])) {
                $query = "select * from product order by $sort_option";
                $result = mysqli_query($conn, $query);
              }

              else {
                $query = "select * from product";
                $result = mysqli_query($conn, $query);
              }

              if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_array($result)) {
            ?>
                    <div class="col-md-6 col-lg-4">
                      <div class="box">
                        <div class="img-box">
                          <img src="../Project-1/mvc/views/Templete/images/<?php echo $row['img']; ?>" alt="">
                        </div>
                        <div class="detail-box">
                          <h5>
                            <?php echo $row['p_name']; ?>
                          </h5>
                          <div class="price_box">
                            <h6 class="price_heading">
                              <span>$</span> <?php echo $row['price']; ?>
                            </h6>
                          </div>
                        </div>

                        <form action="Cart" method="post" class="mt-3">
                            <input type="hidden" name="hidden_img" value="<?php echo $row['img']; ?>">
                            <input type="hidden" name="hidden_id" value="<?php echo $row['p_id']; ?>">
                            <input type="hidden" name="hidden_name" value="<?php echo $row['p_name'] ?>">
                            <input type="hidden" name="hidden_price" value="<?php echo $row['price'] ?>">
                            <input type="number" name="quantity" value="1" class="form-control mb-3">
                            <input type="submit" class="btn btn-primary" value="Add to cart" name="add_to_cart">
                          </form>
                      </div>
                    </div>

                    <?php
                      }
                    }
                  ?>
        </div>
    </div>
  </section>

  <!-- end furniture section -->

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