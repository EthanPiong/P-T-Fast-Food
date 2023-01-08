<?php
	require 'database.php';

	$grand_total = 0;
	$allItems = '';
	$items = [];

	$sql = "SELECT CONCAT(cart_Pname, ' (',cart_Pqty,')') AS ItemQty, cart_Totalprice FROM cart";
	$stmt = $connect->prepare($sql);
	$stmt->execute();
	$result = $stmt->get_result();
	while ($row = $result->fetch_assoc()) {
	  $grand_total += $row['cart_Totalprice'];
	  $items[] = $row['ItemQty'];
	}
	$allItems = implode(" ", $items);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Checkout</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="CSS/product.css" type="text/css" />

  <?php
  session_start();
  $id=$_SESSION['id'];
  $query=mysqli_query($connect,"SELECT * FROM customer where cusName='$id'")or die(mysqli_error());
  $go=mysqli_fetch_array($query);
?>

</head>

<body>
  <nav class="navbar navbar-expand-md">
    <!-- Brand -->
    <a class="navbar-brand" href="product.php">&nbsp;&nbsp;P&T Fast Food</a>
    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Navbar links -->
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link active" href="product.php"><i class="fas fa-hamburger mr-2"></i> All Products</a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" href="#"><i class="fas fa-th-list mr-2"></i> Categories</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><i class="fa fa-history mr-2"></i> Order History</a>
        </li> -->
        <li class="nav-item">
          <a class="nav-link" href="checkout.php"><i class="fas fa-money-check-alt mr-2"></i>Checkout</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="edit profile.php"><i class="fas fa-edit mr-2"></i>Edit Profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt mr-2"></i>Log Out</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart mr-1"></i><span id="cart-item" class="cart-num">0</span></a>
        </li>
        <li class="nav-user">
          <h6 class="nav-link" id="nav-user" ><i class="fa fa-user mr-2"></i>Hi <?php echo $go['cusName']; ?></h6>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6 px-4 pb-4" id="order">
        <h4 class="text-center text-info p-2">Complete your order!</h4>
        <div class="jumbotron p-3 mb-2 ">
          <h6 class="lead"><b>Your Product(s) : </b><br><?= $allItems; ?></h6>
          <h5><b>Total Amount Payable : </b>RM<?= number_format($grand_total,2) ?></h5>
        </div>
        <form action="" method="post" id="placeOrder">
          <input type="hidden" name="products" value="<?= $allItems; ?>">
          <input type="hidden" name="grand_total" value="<?= $grand_total; ?>">
          <div class="form-group" style="background-color:white; border-radius:7px; padding:5px;">
          <h5>Your detail : </h5>
            <label>Name : 
            <?php echo $go['cusName']; ?>
            <input type="hidden" name="name" value="<?=$go['cusName'];?>">
            </label>
          <br>
          <label>Email : 
            <?php echo $go['cusEmail']; ?>
        </label>
          <br>
          <label>Phone Number : 
            <?php echo $go['cusPhone']; ?>
        </label>
          </div>
          <h6 class="text-center lead">Select Payment Mode</h6>
          <div class="form-group">
            <select name="pmode" class="form-control" id="pmode">
              <option value="" selected disabled>Select Payment Mode</option>
              <option value="Cash">Cash</option>
              <option value="Debit/Credit Card">Debit/Credit Card</option>
            </select>
          </div>

          <div class="form-group" id="otherType" style="background-color:white; border-radius:7px; padding:5px;">
            <label for="specify" style="width: 150px;">CARD NUMBER</label>
            <input type="text" name="card_number" placeholder="xxxx xxxx xxxx xxxx"><br>
            <label for="specify" style="width: 150px;">CARD EXPIRY</label>
            <input type="text" name="card_expiry" placeholder="xx/xxxx"/><br>
            <label for="specify" style="width: 150px;">CARD CVC</label>
            <input type="password" name="card_cvc" placeholder="xxx"/>
          </div>

          <div class="form-group">
            <input type="submit" name="submit" value="Place Order" class="btn btn-danger btn-block">
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" ></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
  <script type="text/javascript">

$(document).ready(function () {
    toggleFields(); // call this first so we start out with the correct visibility depending on the selected form values
    // this will call our toggleFields function every time the selection value of our other field changes
    $("#pmode").change(function () {
        toggleFields();
    });

});
// this toggles the visibility of other server
function toggleFields() {
    if ($("#pmode").val() === "Debit/Credit Card")
        $("#otherType").show();
    else
        $("#otherType").hide();
}

  $(document).ready(function() {

    // Sending Form data to the server
    $("#placeOrder").submit(function(e) {
      e.preventDefault();
      $.ajax({
        url: 'productAction.php',
        method: 'post',
        data: $('form').serialize() + "&productAction=order",
        success: function(response) {
          $("#order").html(response);
        }
      });
    });

    // Load total no.of items added in the cart and display in the navbar
    load_cart_item_number();

    function load_cart_item_number() {
      $.ajax({
        url: 'productAction.php',
        method: 'get',
        data: {
          cartItem: "cart_item"
        },
        success: function(response) {
          $("#cart-item").html(response);
        }
      });
    }
  });
  </script>
</body>

</html>