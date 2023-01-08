<?php
	session_start();
	require 'database.php';

	// Add products into the cart table
	if (isset($_POST['pid'])) {
	  $pid = $_POST['pid'];
	  $pname = $_POST['pname'];
	  $pprice = $_POST['pprice'];
	  $pimage = $_POST['pimage'];
	  $pcode = $_POST['pcode'];
	  $pqty = $_POST['pqty'];
	  $total_price = $pprice * $pqty;

	  $stmt = $connect->prepare('SELECT product_code FROM cart WHERE product_code=?');
	  $stmt->bind_param("s",$pcode);
	  $stmt->execute();
	  $res = $stmt->get_result();
	  $r = $res->fetch_assoc();
	  $code = $r['product_code']?? '';

	  if (!$code) {
	    $query = $connect->prepare("INSERT INTO cart (cart_Pname,cart_Pprice,cart_Pimage,cart_Pqty,cart_Totalprice,product_code) VALUES (?, ?, ?, ?, ?, ?)");
	    $query->bind_param('ssssss',$pname,$pprice,$pimage,$pqty,$total_price,$pcode);
	    $query->execute();

	    echo '<div class="alert alert-success alert-dismissible mt-2">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Item added to your cart!</strong>
						</div>';
	  } else {
	    echo '<div class="alert alert-danger alert-dismissible mt-2">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Item already added to your cart!</strong>
						</div>';
	  }
	}

	// Get no.of items available in the cart table
	if (isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item') {
	  $stmt = $connect->prepare('SELECT * FROM cart');
	  $stmt->execute();
	  $stmt->store_result();
	  $rows = $stmt->num_rows;

	  echo $rows;
	}

	// Remove single items from cart
	if (isset($_GET['remove'])) {
	  $id = $_GET['remove'];

	  $stmt = $connect->prepare('DELETE FROM cart WHERE cart_id=?');
	  $stmt->bind_param('i',$id);
	  $stmt->execute();

	  $_SESSION['showAlert'] = 'block';
	  $_SESSION['message'] = 'Item removed from the cart!';
	  header('location:cart.php');
	}

	// Remove all items at once from cart
	if (isset($_GET['clear'])) {
	  $stmt = $connect->prepare('DELETE FROM cart');
	  $stmt->execute();
	  $_SESSION['showAlert'] = 'block';
	  $_SESSION['message'] = 'All Item removed from the cart!';
	  header('location:cart.php');
	}

	// Set total price of the product in the cart table
	if (isset($_POST['pqty'])) {
	  $qty = $_POST['pqty'];
	  $pid = $_POST['pid'];
	  $pprice = $_POST['pprice'];

	  $tprice = $qty * $pprice;

	  $stmt = $connect->prepare('UPDATE cart SET cart_Pqty=?, cart_Totalprice=? WHERE cart_id=?');
	  $stmt->bind_param('idi',$qty,$tprice,$pid);
	  $stmt->execute();
	}

	//Checkout and save customer info in the orders table
	if (isset($_POST['productAction']) && isset($_POST['productAction']) == 'order') {
	  $name = $_POST['name'];
	  $products = $_POST['products'];
	  $grand_total = $_POST['grand_total'];
	  $pmode = $_POST['pmode'];

	  $data = '';

	  $stmt = $connect->prepare('INSERT INTO orders (cusName,pmode,product,amount_paid)VALUES(?,?,?,?)');
	  $stmt->bind_param('ssss',$name,$pmode,$products,$grand_total);
	  $stmt->execute();
	  $stmt2 = $connect->prepare('DELETE FROM cart');
	  $stmt2->execute();
	  $data .= '<div class="text-center">
								<h1 class="display-4 mt-2 text-danger">Thank You!</h1>
								<h2 class="text-success">Your Order Placed Successfully!</h2>
								<h4 class="bg-danger text-light rounded p-2">Items Purchased : ' . $products . '</h4>
								<h4>Your Name : ' . $name . '</h4>
								<h4>Total Amount Paid : RM' . number_format($grand_total,2) . '</h4>
								<h4>Payment Mode : ' . $pmode . '</h4>
						  </div>';
	  echo $data;
	}
?>