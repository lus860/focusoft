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
   
   <?php  $result=mysqli_query($conn,"SELECT * FROM products ");
            while($row = $result->fetch_assoc()) { ?>
   <tr>
      <td> <a  href="product.php.?product=<?php echo $row['id']; ?>"> <?php echo $row['name'] ?> </a> </td>
      <td><?php echo $row['description'] ?></td>
      <td><?php echo $row['price'] ?></td>
    </tr>
   <?php }; ?>
  </tbody>
</table>
<?php include('footer.php'); ?>