<?php session_start();
include('header.php');
include('navbar.php');
include( 'submit.php'); 
$cart = $_SESSION['cart'];
$error=false;
if( isset($_POST['submit']) ) {
    $firstname = $_POST['first_name'];
    $lastname = $_POST['last_name'];
    $email = $_POST['email'];
    $sum = $_POST['sum'];
    $error_first_name = "Please enter firstname";
    $error_last_name = "Please enter lastname";
    $error_email = "Please enter email";
    $submit=new Submit( $error_name=null, $error_price=null, $error_description=null,$error_first_name, $error_last_name, $error_email);
    $submit->submit($error_first_name, $error_last_name,  $error_email);
    $result_query = $pdo->prepare("SELECT * FROM users WHERE email = ? ");
    $result_query->execute([$email]);
    if ( count($result_query->fetchAll()) > 0) {
        $error=true;
    }
    if ( !$error ) {
        $stmt = $pdo->prepare("INSERT INTO users ( first_name, last_name, email) VALUES(?, ?, ?)");
        $stmt->execute([$firstname, $lastname, $email]);
        $_SESSION['email'] =  $email;
        $result = $pdo->prepare("SELECT * FROM users WHERE email = ? ");
        $result->execute([$email]);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $id = $row['id'];
        $orders = $pdo->prepare("INSERT INTO orders ( user_id, sum) VALUES(?, ? )");
        $orders->execute(array($id, $sum));
        $id_orders = $pdo->lastInsertId();
        foreach ( $cart as $value ) {
            $id = $value['1'];
            $quant = $value['0'];
            $stmt1 = $pdo->prepare("INSERT INTO order_products ( order_id, product_id, qty) VALUES(?, ?, ?)");
            $stmt1->execute([$id_orders, $id, $quant]);   
        };
        $_SESSION['cart']=null;
        $alert = "Your order has been confirmed";
        
    };
};
?>
<h1 style="margin:20px;color:blue;"><?php echo $alert ;?></h1>
<?php $cart = $_SESSION['cart'];  
if (!isset( $_SESSION['cart'])) {; ?>
    <h1 style="margin:20px;">Your shopping cart is empty</h1><?php 
} else {; ?>
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
  foreach ( $cart as $value ) {
        $id = $value['1'];
        $quant = $value['0'];
        $result=$pdo->prepare("SELECT * FROM products WHERE id=? ");
        $result->execute(array($id));
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $sum +=  $row['price']*$quant ;?>
           <tr>
               <td ><?php echo $row['name'];?></td>
               <td><?php echo $row['description'];?></td>
               <td><?php echo $row['price']; ?></td>
               <td><?php echo $quant ?></td>
           </tr><?php 
      };?>
        </tbody>
    </table>
    <h4 style="float:right;margin:30px;">Total price <?php echo $sum; ?></h4>
<?php if (!$email ){; ?>
<h4 style="clear:both;margin-top: 200px;">Confirm your order</h4>
 <form class="needs-validation" novalidate action="orders.php" method="post">
  <div >
    <div class="col-md-4 mb-3">
        <label for="validationCustom01">First name</label>
        <input type="text" class="form-control" id="validationCustom01" placeholder="First name" name="first_name"  required>
        <span style="color:red"><?php echo $submit->errors['first_name']; ?></span>
    </div>
    <div class="col-md-4 mb-3">
       <label for="validationCustom02">Last name</label>
       <input type="text" class="form-control" id="validationCustom02" placeholder="Last name" name="last_name" required>
       <span style="color:red"><?php echo $submit->errors['last_name']; ?></span>
    </div>
    <div class="col-md-4 mb-3">
       <label for="validationCustomUsername">Username</label>
        <div class="input-group">
           <div class="input-group-prepend">
           <span class="input-group-text" id="inputGroupPrepend">@</span>
           </div>
           <input type="text" class="form-control" id="validationCustomUsername" placeholder="Username" aria-describedby="inputGroupPrepend" name="email"  required><br>
        </div>
         <span style="color:red"><?php echo $submit->errors['email']; ?></span>
    </div>
  </div>
  <input type="hidden" name="sum" value="<?php echo $sum; ?>">
  <input class="btn btn-primary ml-3" type="submit" name="submit" placeholder="Confirm the order">
</form><?php 
}; ?> 
<?php 
};?>       
<?php include('footer.php'); ?>