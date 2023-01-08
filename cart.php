<?php
   include('database.php');
   session_start();
   $id=$_SESSION['id'];
   $query=mysqli_query($connect,"SELECT * FROM customer where cusName='$id'")or die(mysqli_error());
   $go=mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Cart</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
  <link rel="stylesheet" href="CSS/product.css" type="text/css" />
</head>

<body>
<nav class="navbar navbar-expand-md ">
    <a class="navbar-brand" href="product.php">&nbsp;&nbsp;P&T Fast Food</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
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
      <div class="col-lg-10">
        <div style="display:<?php if (isset($_SESSION['showAlert'])) {
  echo $_SESSION['showAlert'];
} else {
  echo 'none';
} unset($_SESSION['showAlert']); ?>" class="alert alert-success alert-dismissible mt-3">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong><?php if (isset($_SESSION['message'])) {
  echo $_SESSION['message'];
} unset($_SESSION['showAlert']); ?></strong>
        </div>
        <div class="table-responsive mt-2">
          <table class="table table-bordered table-striped text-center">
            <thead>
              <tr>
                <td colspan="7">
                  <h4 class="text-center text-info m-0">Products in your cart!</h4>
                </td>
              </tr>
              <tr>
                <th>Image</th>
                <th colspan="2">Product</th>
                <th>Single Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th >
                  <a href="productAction.php?clear=all" class="badge-danger badge p-1" onclick="return confirm('Are you sure want to clear your cart?');"><i class="fas fa-trash"></i>&nbsp;&nbsp;Clear Cart</a>
                </th>
              </tr>
            </thead>
            <tbody>
              <?php
                require 'database.php';
                $stmt = $connect->prepare('SELECT * FROM cart');
                $stmt->execute();
                $result = $stmt->get_result();
                $grand_total = 0;
                while ($row = $result->fetch_assoc()):
              ?>
              <tr>
                
                <td><img src="<?= $row['cart_Pimage'] ?>" width="50"></td>
                <td colspan="2"><?= $row['cart_Pname'] ?></td>
                <td>
                  RM&nbsp;&nbsp;<?= number_format($row['cart_Pprice'],2); ?>
                </td>
                <input type="hidden" class="pprice" value="<?= $row['cart_Pprice'] ?>">
                <td>
                  <?= $row['cart_Pqty'] ?>
                </td>
                <td>RM&nbsp;&nbsp;<?= number_format($row['cart_Totalprice'],2); ?></td>
                <td >
                  <a href="productAction.php?remove=<?= $row['cart_id'] ?>" class="text-danger lead" onclick="return confirm('Are you sure want to remove this item?');"><i class="fas fa-trash-alt"></i></a>
                </td>
              </tr>
              <?php $grand_total += $row['cart_Totalprice']; ?>
              <?php endwhile; ?>
              <tr>
                <td colspan="3">
                  <a href="product.php" class="btn btn-success"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Continue
                    Shopping</a>
                </td>
                <td colspan="2"><b>Grand Total</b></td>
                <td><b>RM&nbsp;&nbsp;<?= number_format($grand_total,2); ?></b></td>
                <td>
                  <a href="checkout.php" class="btn btn-info <?= ($grand_total > 1) ? '' : 'disabled'; ?>"><i class="far fa-credit-card"></i>&nbsp;&nbsp;Checkout</a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

  <script type="text/javascript">
  $(document).ready(function() {

    // Change the item quantity
    $(".itemQty").on('change', function() {
      var $el = $(this).closest('tr');

      var pid = $el.find(".pid").val();
      var pprice = $el.find(".pprice").val();
      var qty = $el.find(".itemQty").val();
      location.reload(true);
      $.ajax({
        url: 'action.php',
        method: 'post',
        cache: false,
        data: {
          qty: qty,
          pid: pid,
          pprice: pprice
        },
        success: function(response) {
          console.log(response);
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