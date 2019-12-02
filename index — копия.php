<?php include('header.php'); ?>
<?php include('navbar.php'); ?>
<table class="table table-striped">
  <thead>
    <tr style="color:red;">
      <th scope="col">Name</th>
      <th scope="col">Description</th>
      <th scope="col">Price</th>
    </tr>
  </thead>
  <tbody>
<?php  $result = $pdo->query("SELECT * FROM products ");
while ( $row = $result->fetch(PDO::FETCH_ASSOC) ) {; ?>
   <tr>
      <td><?php echo $row['name'] ?></td>
      <td><?php echo $row['description'] ?></td>
      <td><?php echo $row['price'] ?></td>
      <td><input type="number" value="0" class="prod" data-prod-id="<?php echo $row['id']; ?>"></td>
    </tr>
<?php }; ?>
  </tbody>
</table>
<button  class="btn btn-primary" style="width:100px;" id="order"><a href="orders.php">Sign in</a></button>
<?php include('footer.php'); ?>