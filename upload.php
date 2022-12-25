<?php 
// Include the database configuration file  
require_once 'database.php'; 
 
// If file upload form is submitted 
$status = $statusMsg = ''; 
if(isset($_POST["submit"])){ 
    $status           = 'error'; 
    $product_code     = $_POST['product_code'];
    $product_name     = $_POST['product_name'];
    $product_stock    = $_POST['product_stock'];
    $product_detail   = $_POST['product_detail'];
    $product_price    = $_POST['product_price'];
    $product_category = $_POST['product_category'];

    if(!empty($_FILES["product_image"]["name"])) { 
        // Get file info 
        $fileName = basename($_FILES["product_image"]["name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
         
        // Allow certain file formats 
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){ 
            $image = $_FILES['product_image']['tmp_name']; 
            $imgContent = addslashes(file_get_contents($image)); 
         
            // Insert image content into database 
            $insert = $connect->query("INSERT INTO product(product_name,product_image,product_stock,product_detail,product_price,product_category,product_code) VALUES ('$product_name','$imgContent','$product_stock','$product_detail','$product_price','$product_category','$product_code')"); 
             
            if($insert){ 
                $status = 'success'; 
                $statusMsg = "File uploaded successfully."; 
            }else{ 
                $statusMsg = "File upload failed, please try again."; 
            }  
        }else{ 
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
        } 
    }else{ 
        $statusMsg = 'Please select an image file to upload.'; 
    } 
} 
 
// Display status message 
echo $statusMsg; 
?>