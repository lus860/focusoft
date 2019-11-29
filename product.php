<?php session_start();
include('header.php'); 
include('navbar.php'); ?>
<?php
$pid=$_GET['product'];
$resalt = mysqli_query($conn,"SELECT * FROM products WHERE id='$pid'");
$row=$resalt->fetch_assoc();
?>


<table class="table table-striped">
  <thead>
    <tr style="color:red;">
      <th scope="col">Name</th>
      <th scope="col">Description</th>
      <th scope="col">Price</th>
    </tr>
  </thead>
  <tbody>
   <tr>
      <td><h3><?php echo $row['name'] ;?></h3></td>
      <td><?php echo $row['description'] ;?></td>
      <td><?php echo $row['price'] ?></td>
    </tr>
  </tbody>
</table>

<form style="width:50%;margin:20px;">
  <div class="form-group">
    <label for="exampleFormControlInput1">Quantity</label>
    <input type="text" class="form-control" id="quantity" placeholder="">
  </div>
  <input type="button" class="btn btn-primary" style="width:100px;" id="order" data-prod-id="<?php echo $pid ?>" placeholder="Sign in">
</form>

<?php include('footer.php'); ?>