<?php include('header.php');
include('navbar.php'); ?>
<?php $error=false;
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    if ( empty($name)) {
        $error_name = "Please enter name";
        $error=true;
    }
    if ( empty($price)) {
        $error_price = "Please enter price";
        $error=true;
    }
    if (empty($description)) {
        $error_description = "Please enter description";
        $error=true;
    }
    if(!$error){
        $result_reg = mysqli_query($conn,"INSERT INTO products ( name,price,description) VALUES('$name','$price','$description' )");
        
    }
}
?>

<h1 style="margin:20px;">Add new product</h1>
<form style="width:50%;margin:20px;" action="products.php" method="POST">
  <div class="form-group">
    <label for="exampleFormControlInput1">Product name</label>
    <input type="text" name="name" class="form-control"  placeholder=""><br>
    <span style="color:red"><?php echo $error_name ?></span>
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Price</label>
    <input type="text" name="price" class="form-control"  placeholder=""><br>
    <span style="color:red"><?php echo  $error_price  ?></span>
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Description</label>
    <textarea class="form-control"name="description"  rows="3"></textarea><br>
    <span style="color:red"><?php echo  $error_description  ?></span>
  </div>
  <input type="submit"name="submit" class="btn btn-primary"  placeholder="Sign in">
</form>
<?php include('footer.php'); ?>