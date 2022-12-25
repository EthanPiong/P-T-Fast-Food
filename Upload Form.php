<html lang="en">

    <head>
        <title>P&T FastFood | Add Product</title>
    </head>
<body>



<form action="upload.php" method="post" enctype="multipart/form-data">
    
    <label>Product ID:</label>
    <input type="text" name="product_code"><br>
    <label>Product Name:</label>
    <input type="text" name="product_name"><br>
    <label>Select Image File:</label>
    <input type="file" name="product_image"><br>
    <label>Product Stock:</label>
    <input type="number" name="product_stock"><br>
    <label>Product Detail:</label>
    <input type="text" name="product_detail"><br>
    <label>Product Price:</label>
    <input type="number" step="any" name="product_price"><br>
    <label>Product Category:</label><br>
    <input type="radio" name="product_category" value="Burger">
    <label for="burger">Burger</label><br>
    <input type="radio" name="product_category" value="Beverage">
    <label for="beverage">Beverage</label><br>
    <input type="radio" name="product_category" value="Dessert">
    <label for="dessert">Dessert</label><br>
    <input type="submit" name="submit" value="Upload">
</form>


</body>
</html>