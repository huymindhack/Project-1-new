<?php 

  if (isset($_POST['logout'])) {
    unset($_SESSION['fullname']);
    header('Location: Home');
  }
?>
    <header class="header_section long_section px-0">
      <nav class="navbar navbar-expand-lg custom_nav-container ">
        <a class="navbar-brand" href="Home">
          <span>Jessica's Furnitures</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class=""> </span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <div class="d-flex mx-auto flex-column flex-lg-row align-items-center">
            <ul class="navbar-nav  ">
              <li class="nav-item active">
                <a class="nav-link" href="Home">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="about"> About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="furniture">Furnitures</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="blog">Blog</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contact">Contact Us</a>
              </li>
            </ul>
          </div>
          <div class="quote_btn-container">
              <span>
                <?php if (isset($_SESSION['fullname'])): ?>
                  <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                      Welcome <strong><?php echo $_SESSION['fullname']; ?></strong>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                      <li>
                        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                          <input type="submit" name="logout" class="dropdown-item text-danger" value="LOG OUT">
                        </form>
                      </li>
                      <li><a class=" dropdown-item text-secondary" href="Cart"><i class="bi bi-cart"></i></a></li>
                      <li><a class=" dropdown-item text-secondary" href="order">Check Orders</a></li>
                    </ul>
                  </div>
                <?php else: ?>
                  <a href="login">Login</a>
                <?php endif; ?>
              </span>
            <!-- <form class="form-inline">
              <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit">
                <i class="fa fa-search" aria-hidden="true"></i>
              </button>
            </form> -->
          </div>
        </div>
      </nav>
    </header>