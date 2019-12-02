<?php include('header.php');
include( 'navbar.php');
include( 'Submit.php'); 
?>
<?php 
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $error_name = "Please enter name";
    $error_price = "Please enter price";
    $error_description = "Please enter description";
    $submit=new Submit($error_name,$error_price, $error_description);
    $submit->submit( $error_name,$error_price, $error_description );
    $submit->insert( $pdo, $name, $price, $description,$table='products', $var1='name', $var2='price', $var3='description');
};?>

<h1 style="margin:20px;">Add new product</h1>
<form style="width:50%;margin:20px;" action="products.php" method="POST">
  <div class="form-group">
    <label for="exampleFormControlInput1">Product name</label>
    <input type="text" name="name" class="form-control"  placeholder=""><br>
    <span style="color:red"><?php echo $submit->errors['name']; ?></span>
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Price</label>
    <input type="text" name="price" class="form-control"  placeholder=""><br>
    <span style="color:red"><?php echo $submit->errors['price'] ;?></span>
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Description</label>
    <textarea class="form-control"name="description"  rows="3"></textarea><br>
    <span style="color:red"><?php echo $submit->errors['description'] ;?></span>
  </div>
  <input type="submit"name="submit" class="btn btn-primary"  placeholder="Sign in">
</form>
<?php include('footer.php'); ?>