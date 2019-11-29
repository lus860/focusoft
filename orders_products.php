<?php session_start();
include('header.php'); 
include('navbar.php'); ?>

<h3>What they ordered</h3>
<table class="table table-hover">
  <thead>
    <tr style="color:red;">
      <th scope="col">Name</th>
      <th scope="col">Description</th>
      <th scope="col">Price</th>
      <th scope="col">QTY</th>
    </tr>
  </thead>
    <tbody>
     <?php  $result_orders = mysqli_query($conn,"SELECT * FROM order_products ");
         $product_orders=[];
      while ( $row_orders = $result_orders->fetch_assoc()) {
          $id=$row_orders['product_id'];
          if(isset($product[$id])){
             continue; 
          }else{
           $result = mysqli_query($conn,"SELECT SUM(qty) FROM order_products WHERE product_id='$id' ");
            $row=$result->fetch_assoc();
            $product_orders[$id] = $row["SUM(qty)"];
            $product[$id]=$id;
          };
          };
          foreach($product_orders as $key => $value ){ ;
          $result_products = mysqli_query($conn,"SELECT * FROM products WHERE id ='$key'");
          $row_products = $result_products ->fetch_assoc(); ?>
         <tr>
           <th scope="row"><?php echo $row_products['name'] ;?></th>
           <td><?php echo $row_products['description'] ;?></td>
           <td><?php echo $row_products['price'] ?></td>
           <td><?php echo $value ?></td>
        </tr>  
    <?php };?>
    </tbody>
</table>  
<?php include('footer.php'); ?>