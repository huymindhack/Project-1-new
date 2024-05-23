<?php   
 session_start();  
 $connect = mysqli_connect("localhost", "root", "", "Project-1"); 

 if(isset($_POST["add_to_cart"]))  
 {  
      if(isset($_SESSION["shopping_cart"]))  
      {  
           $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");  
           if(!in_array($_POST['hidden_id'], $item_array_id))  
           {  
                $count = count($_SESSION["shopping_cart"]);  
                $item_array = array( 
                     'item_id' => $_POST['hidden_id'], 
                     'item_name'               =>     $_POST["hidden_name"],  
                     'item_price'          =>     $_POST["hidden_price"], 
                     'quantity' => $_POST["quantity"]    
                );  
                $_SESSION["shopping_cart"][$count] = $item_array;  
           }  
           else  
           {  
                echo '<script>alert("Item Already Added")</script>';  
                echo '<script>window.location="furniture"</script>';  
           }  
      }  
      else  
      {  
           $item_array = array( 
                'item_id' => $_POST['hidden_id'],   
                'item_name'               =>     $_POST["hidden_name"],  
                'item_price'          =>     $_POST["hidden_price"],
                'quantity' => $_POST["quantity"]  
           );  
           $_SESSION["shopping_cart"][0] = $item_array;  
      }  
 }  

 if (isset($_POST['delete'])) {
    foreach($_SESSION["shopping_cart"] as $keys => $values)  
    {  
        if($values["item_id"] == $_POST["hidden_id"])  
        {  
            unset($_SESSION["shopping_cart"][$keys]);  
            echo '<script>alert("Item Removed")</script>';  
            echo '<script>window.location="Cart"</script>';  
        }  
    }  
 }
 ?>

<!doctype html>
<html lang="en">
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

  <title>Cart</title>

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
        <?php include("header.php") ?>
    </div>

    <?php if (empty($_SESSION['shopping_cart'])): ?>
        <section class="layout_padding">
            <div class="container">
                <div class="alert alert-danger">
                    The cart is empty, let's fill it with your products
                </div>
            </div>
        </section>
    <?php else: ?>
        <section class="layout_padding">
            <div class="container">
                <div class="heading_container mb-4">
                    <h2>Order Details</h2>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>

                        <?php 
                            $total = 0;
                            foreach($_SESSION['shopping_cart'] as $key => $values)
                            {
                        ?>
                            <tr>
                                <td><?php echo $values['item_id']; ?></td>
                                <td><?php echo $values['item_name']; ?></td>
                                <td><?php echo $values['quantity']; ?></td>
                                <td>$ <?php echo number_format($values['item_price'] * $values['quantity']); ?></td>
                                <td>
                                    <form action="Cart" method="post">
                                        <input type="hidden" name="hidden_id" value="<?php echo $values['item_id']; ?>">
                                        <input type="submit" name="delete" class="btn btn-danger" value="Remove">
                                    </form>
                                </td>
                                <td></td>
                            </tr>
                        <?php 
                            $total = $total + ($values['item_price'] * $values['quantity']);

                            }
                        ?>

                            <tr>
                                <td colspan="3" align="right">Total:</td>
                                <td>$ <?php echo number_format($total); ?></td>
                                <td></td>
                            </tr>
                    </table>
                </div>
            </div>
    <?php endif; ?>
        
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>