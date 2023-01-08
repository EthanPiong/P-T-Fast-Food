<!DOCTYPE html>
<html lang="en-US">
<head>
  <title>P&T Fast Food | Edit Profile</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="CSS/editProfile.css">
<?php
  include('database.php');
  session_start();
  $id=$_SESSION['id'];
  $query=mysqli_query($connect,"SELECT * FROM customer where cusName='$id'")or die(mysqli_error());
  $row=mysqli_fetch_array($query);
?>
</head>
  
<body>
  
  
  <div class="profile-input-field">
  <p><i class="fa fa-user-o fa-2x" aria-hidden="true"><br><br>Profile Setting</i></p>
  
        
        <form method="post" action="#" >
        <h3>Please Fill-out All Fields</h3>
          <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" name="username"  placeholder="Enter your New Username" value="<?php echo $row['cusName']; ?>"  />
          </div>
          <div class="form-group">
            <label>Nickname</label>
            <input type="text" class="form-control" name="nickname"  placeholder="Enter your New Nickname"  value="<?php echo $row['cusFullName']; ?>" />
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="text" class="form-control" name="password"  placeholder="Enter your New Password" value="<?php echo $row['cusPass']; ?>">
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="email"  placeholder="Enter your New Email" value="<?php echo $row['cusEmail']; ?>">
          </div>
          <div class="form-group">
            <label>Phone</label>
            <!-- <span><?php echo $row['cusPhone']; ?></span><br><br> -->
            <input type="number" class="form-control" name="phone"  placeholder="Enter your New Phone Number" value="<?php echo $row['cusPhone']; ?>">
          </div>
          <div class="form-group">
            <input type="submit" name="editbtn" class="btn btn-primary" Value="Save">
            <a href="product.php">Back&nbsp;<i class="fa fa-long-arrow-right"></i></a>
          </div>
        </form>
      </div>
      
      <?php
      if(isset($_POST['editbtn'])){
        $Username = $_POST['username'];
        $Nickname = $_POST['nickname'];
        $Password = $_POST['password'];
        $Email = $_POST['email'];
        $Phone = $_POST['phone'];
      $query = "UPDATE customer SET cusName = '$Username',
                      cusNickName = '$Nickname', cusPass = $Password, cusEmail = '$Email',cusPhone = '$Phone'
                      WHERE cusId = '$id'";
                    $result = mysqli_query($connect, $query) or die(mysqli_error($connect));
                    ?>
                     <script type="text/javascript">
            alert("Update Successfull.");
            window.location = "Index.php";
        </script>
        <?php
             }               
?>  
</body>
</html>