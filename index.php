<?php include('header.php'); ?>
<?php include('navbar.php'); ?>
<?php include('function.php'); ?>
<table class="table table-striped">
  <thead>
    <tr style="color:red;">
      <th scope="col">Name</th>
      <th scope="col">Description</th>
      <th scope="col">Price</th>
    </tr>
  </thead>
  <tbody>
<?php $col = select($pdo,$table='products');
     if($col) {
     foreach($col as $key=>$val):?>

   <tr>
      <td><?php echo $val["0"] ?></td>
      <td><?php echo $val["1"] ?></td>
      <td><?php echo $val["2"] ?></td>
      <td><input type="number" value="0" class="prod" data-prod-id="<?php echo $key ;?>"></td>
    </tr>

   <?php endforeach ?>
<?php } ?>
  </tbody>
</table>
<button  class="btn btn-primary" style="width:100px;" id="order"><a href="orders.php">Sign in</a></button>
<?php include('footer.php'); ?>