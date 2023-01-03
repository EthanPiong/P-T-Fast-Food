<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>P&T Fast Food | Place Order</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
  <link rel="stylesheet" href="CSS/product.css" type="text/css" />
  <?php
  include('database.php');
  session_start();
  $id=$_SESSION['id'];
  $query=mysqli_query($connect,"SELECT * FROM customer where cusId='$id'")or die(mysqli_error());
  $row=mysqli_fetch_array($query);
?>
</head>

<body>
  <!-- Navbar start -->
  <nav class="navbar navbar-expand-md ">
    <a class="navbar-brand" href="product.php">&nbsp;&nbsp;P&T Fast Food</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link active" href="#"><i class="fas fa-hamburger mr-2"></i> All Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><i class="fas fa-th-list mr-2"></i> Categories</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><i class="fas fa-money-check-alt mr-2"></i> Checkout</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><i class="fa fa-history mr-2"></i> Order History</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart mr-1"></i><span id="cart-item" class="cart-num">0</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="nav-user" href="edit profile.php"><i class="fa fa-user mr-2"></i>Hi <?php echo $row['cusNickName']; ?></a>
        </li>

      </ul>
    </div>
  </nav>
  <!-- Navbar end -->

  <!-- Displaying Products Start -->
  <div class="container">
    <div id="message"></div>
    <div class="row mt-3 pb-3">
      <?php
  			include 'database.php';
  			$stmt = $connect->prepare('SELECT * FROM product');
  			$stmt->execute();
  			$result = $stmt->get_result();
  			while ($row = $result->fetch_assoc()):
  		?>
      <div class="col-sm-6 col-md-4 col-lg-4 mb-2 ">
        <div class="card-deck">
          <div class="card">
          <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['product_image']); ?>" class="card-img-top" >
            <div class="card-body">
            
            <h4 class="card-title text-center text-info"><?= $row['product_name'] ?></h4>
              <h5 class="card-text text-center text-danger">RM <?= number_format($row['product_price'],2) ?></h5>
              <span class="card-detail text-center"><?= $row['product_detail'] ?></span>
            </div>
            <div class="card-footer p-1">
              <form action="" class="form-submit">
                <div class="row p-2">
                  <div class="col-md-6 py-1 pl-3">
                    <b>Quantity : </b>
                  </div>
                  <div class="col-md-6">
                    <input type="number" class="form-control" value="<?= $row['product_quantity'] ?>">
                  </div>
                </div>
                <input type="hidden" class="pid" value="<?= $row['product_id'] ?>">
                <input type="hidden" class="pname" value="<?= $row['product_name'] ?>">
                <input type="hidden" class="pprice" value="<?= $row['product_price'] ?>">
                <input type="hidden" class="pimage" value="<?php echo base64_encode($row['product_image']); ?>">
                <input type="hidden" class="pdetail" value="<?= $row['product_detail'] ?>">
                <input type="hidden" class="pcategory" value="<?= $row['product_category'] ?>">
                <input type="hidden" class="pstock" value="<?= $row['product_stock'] ?>">
                <input type="hidden" class="pcode" value="<?= $row['product_code'] ?>">
                <button class="btn btn-info btn-block addItemBtn"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Add to
                  cart</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
  </div>
  <!-- Displaying Products End -->

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

  <script type="text/javascript">
  $(document).ready(function() {

    // Send product details in the server
    $(".addItemBtn").click(function(e) {
      e.preventDefault();
      var $form = $(this).closest(".form-submit");
      var pid = $form.find(".pid").val();
      var pname = $form.find(".pname").val();
      var pprice = $form.find(".pprice").val();
      var pimage = $form.find(".pimage").val();
      var pdetail = $form.find(".pdetail").val();
      var pcategory = $form.find(".pcategory").val();
      var pstock = $form.find(".pstock").val();
      var pcode = $form.find(".pcode").val();
      var pqty = $form.find(".pqty").val();

      $.ajax({
        url: 'productAction.php',
        method: 'post',
        data: {
          pid: pid,
          pname: pname,
          pprice: pprice,
          pimage: pimage,
          pdetail: pdetail,
          pcategory: pcategory,
          pstock: pstock,
          pcode: pcode,
          pqty: pqty;
          
        },
        success: function(response) {
          $("#message").html(response);
          window.scrollTo(0, 0);
          load_cart_item_number();
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