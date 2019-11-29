<?php session_start();
include('header.php');
include('navbar.php');
$cart = $_SESSION['cart'];
$error=false;
if(isset($_POST['submit'])) {
    $firstname = $_POST['first_name'];
    $lastname = $_POST['last_name'];
    $email = $_POST['email'];
    $sum = $_POST['sum'];
    if ( empty($firstname) ) {
        $error=true;
    }
    if ( empty($email) ) {
        $error=true;  
    }
    if ( empty( $lastname) ) {
        $error=true;     
        }
    $result_query = mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");
    if ( $result_query->num_rows > 0) {
        $error=true;
    }
    if (!$error) {
       $result_reg = mysqli_query($conn,"INSERT INTO users ( first_name, last_name, email) VALUES('$firstname','$lastname','$email')");
       $_SESSION['email'] =  $email;
       $result = mysqli_query($conn,"SELECT * FROM users WHERE email='$email' ");
       $row = $result->fetch_assoc();
       $id = $row['id'];
       mysqli_query($conn,"INSERT INTO orders ( user_id, sum) VALUES ( '$id', '$sum')");
       $result_orders=mysqli_query($conn,"SELECT MAX(ID) FROM orders ");
        $row_orders = $result_orders->fetch_assoc();
       $id_orders = $row_orders['MAX(ID)'];
       foreach ( $cart as $key => $value){
       mysqli_query($conn,"INSERT INTO order_products ( order_id, product_id, qty) VALUES ( '$id_orders', '$key', '$value')"); };
        $_SESSION['cart']=null;
        $alert = "Your order has been confirmed";
        
    }
}
?>

<h1 style="margin:20px;color:blue;"><?php echo $alert; ?></h1>
   
<?php $cart = $_SESSION['cart'];
if (!isset( $_SESSION['cart'])) {; ?>
    <h1 style="margin:20px;">Your shopping cart is empty</h1>  
   <?php 
} else{; ?>
<h1 style="margin:20px;">Your basket</h1>
<table class="table table-bordered">
  <thead>
    <tr style="color:red;">
      <th scope="col">Name</th>
      <th scope="col">Description</th>
      <th scope="col">Price</th>
      <th scope="col">Quantity</th>
    </tr>
  </thead>
  <tbody>
<?php $sum;
    //var_dump($cart);
    foreach( $cart as $key => $value ){;
    $resalt = mysqli_query($conn,"SELECT * FROM products WHERE id='$key'");
    $row = $resalt->fetch_assoc();
    $sum += $row['price']*$value ;?>
   <tr>
      <td ><?php echo $row['name'] ;?></td>
      <td><?php echo $row['description'] ;?></td>
      <td><?php echo $row['price']; ?></td>
      <td><?php echo $value ?></td>
   </tr>
<?php };?>
</tbody>
</table>
<h4 style="float:right;margin:30px;">Total price <?php echo $sum; ?></h4>


<?php if(!$email ){; ?>
<h4 style="clear:both;margin-top: 200px;">Confirm your order</h4>
 <form class="needs-validation" novalidate action="orders.php" method="post">
  <div >
    <div class="col-md-4 mb-3">
      <label for="validationCustom01">First name</label>
      <input type="text" class="form-control" id="validationCustom01" placeholder="First name" name="first_name"  required>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationCustom02">Last name</label>
      <input type="text" class="form-control" id="validationCustom02" placeholder="Last name" name="last_name" required>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationCustomUsername">Username</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text" id="inputGroupPrepend">@</span>
        </div>
        <input type="text" class="form-control" id="validationCustomUsername" placeholder="Username" aria-describedby="inputGroupPrepend" name="email"  required>
        <div class="invalid-feedback">
          Please choose a username.
        </div>
      </div>
    </div>
  </div>
  <input type="hidden" name="sum" value="<?php echo $sum; ?>">
  <input class="btn btn-primary ml-3" type="submit" name="submit" placeholder="Confirm the order">
</form>
<?php } 
       
        //mysqli_query($conn,"DELETE FROM users WHERE id='$id' ");
        //unset($_SESSION);
        //session_destroy();
    
    
  }; ?>





<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>
<?php include('footer.php'); ?>