<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Assignment #7</title>
  <link rel='shortcut icon' type='image/x-icon' href='favicon.ico' />
  <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.html">Hack the Pearl Shop</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="#" data-toggle="modal" data-target="#registerModal">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" data-toggle="modal" data-target="#loginModal">Login</a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0" method="get" action="search.php">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" name="searchtext" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </nav>
  <hr>
  <h1 class="title">Merchandise</h1>

  <!-- Register Modal -->
  <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="registerModalLabel">Register an Account</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="post" action="register.php">
          <div class="modal-body">
            <div class="form-group">
              <label for="firstname">First Name</label>
              <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter first name">
            </div>
            <div class="form-group">
              <label for="lastname">Last Name</label>
              <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter last name">
            </div>
            <div class="form-group">
              <label for="registeremail">Email Address</label>
              <input type="email" class="form-control" id="registeremail" name="registeremail" placeholder="Enter email">
            </div>
            <div class="form-group">
              <label for="registerpassword">Password</label>
              <input type="password" class="form-control" id="registerpassword" name="registerpassword" placeholder="Password">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Login Modal -->
  <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="loginModalLabel">Login to your account</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="post" action="login.php">
          <div class="modal-body">
            <div class="form-group">
              <label for="loginemail">Email Address</label>
              <input type="email" class="form-control" id="loginemail" name="loginemail" placeholder="Enter email">
            </div>
            <div class="form-group">
              <label for="loginpassword">Password</label>
              <input type="password" class="form-control" id="loginpassword" name="loginpassword" placeholder="Password">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Shopping content -->
  <div class="content">
    <div class="receipt-item">
      <h3>Your Receipt</h3>
      <?php
      $quantity1 = $_POST["quantity1"];
      $quantity2 = $_POST["quantity2"];
      $quantity3 = $_POST["quantity3"];
      $quantity4 = $_POST["quantity4"];
      $quantity5 = $_POST["quantity5"];
      $quantity6 = $_POST["quantity6"];
      $firstname = $_POST["firstname"];
      $phonenumber = $_POST["phonenumber"];
      $email = $_POST["paymentemail"];
      $address = $_POST["address"];
      $city = $_POST["city"];
      $state = $_POST["state"];
      $zipcode = $_POST["zipcode"];
      $creditcard = $_POST["creditcard"];
      $shippingcost = 0.00;
      print("<p>Full Name: $firstname</p>");
      print("<p>Phone Number: $phonenumber</p>");
      print("<p>Email Address: $email</p>");
      print("<p>Street Address: $address</p>");
      print("<p>City: $city</p>");
      print("<p>State: $state</p>");
      print("<p>Zip Code: $zipcode</p>");
      if ($_POST['shippingmethod'] == 'pickup'){
        print("<p>Shipping Method: Pick Up</p>");
      }
      else{
        $shippingcost = 7.00;
        print("<p>Shipping Method: Ship to Home</p>");
      }
      print("<h5>Ordered Items</h5>");
      $didOrder = FALSE;
      if ((int)$quantity1 > 0){
        print("<p>($quantity1)x Circle Logo T-Shirt</p>");
        $didOrder = TRUE;
      }
      if ((int)$quantity2 > 0){
        print("<p>($quantity2)x Color Bar T-Shirt</p>");
        $didOrder = TRUE;
      }
      if ((int)$quantity3 > 0){
        print("<p>($quantity3)x Square Logo T-Shirt</p>");
        $didOrder = TRUE;
      }
      if ((int)$quantity4 > 0){
        print("<p>($quantity4)x Orbit T-Shirt</p>");
        $didOrder = TRUE;
      }
      if ((int)$quantity5 > 0){
        print("<p>($quantity5)x Round Sticker</p>");
        $didOrder = TRUE;
      }
      if ((int)$quantity6 > 0){
        print("<p>($quantity6)x Triangle Sticker</p>");
        $didOrder = TRUE;
      }
      if($didOrder == FALSE){
        print("<p>No items ordered</p>");
      }
      $subtotal = number_format(((int)$quantity1 * 10.00) + ((int)$quantity2 * 10.00) + ((int)$quantity3 * 10.00) + ((int)$quantity4 * 10.00) + ((int)$quantity5 * 5.00) + ((int)$quantity6 * 5.00), 2, '.', '');
      $tax = number_format((float)$subtotal * 0.08, 2, '.', '');
      $total = number_format($subtotal + $tax + $shippingcost, 2, '.', '');
      $shipping = number_format($shippingcost, 2, '.', '');
      print("<p>Subtotal: \$$subtotal</p>");
      print("<p>Shipping: \$$shipping</p>");
      print("<p>Tax: \$$tax</p>");
      print("<p>Total: \$$total</p>");
      $filea = fopen("shop.txt","a") or die("can't open file");
      $line= $firstname.":".$phonenumber.":".$email.":".$address.":".$city.":".$state.":".$zipcode.":".$creditcard.":".$total."\n";
      fwrite($filea, $line);
      fclose($filea);
       ?>
    </div>
  </div>
</body>
</html>
