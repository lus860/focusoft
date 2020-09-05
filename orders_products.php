<?php session_start();
include('header.php'); 
include('navbar.php'); ?>
<h2 class="text-center my-5">What they ordered</h2>
<?php  $result = $pdo->query( "SELECT * FROM orders INNER JOIN order_products ON order_products.order_id = orders.id INNER JOIN products ON order_products.product_id = products.id  INNER JOIN users ON orders.user_id = users.id" );
$row = $result->fetch(PDO::FETCH_ASSOC);
while ( $row = $result->fetch(PDO::FETCH_ASSOC)){

if ($row['order_id']!==$order_id):?>
     <h3 class="text-center mt-5"><?php echo $row['first_name']." ".$row['last_name'] ;?></h3>
     <p class="text-right mr-5"><?php echo "<b>Order date</b>"." ".$row['order_date'] ;?></p>
     <p class="text-right  mr-5"><?php echo "<b>Sum</b>"." ".$row['sum'] ;?></p>
     <table class="table table-hover" style="width:50%;margin:auto;" class="mx-auto">
        <thead>
            <tr style="color:red;">
               <th scope="col">Name</th>
               <th scope="col">Description</th>
               <th scope="col">Price</th>
               <th scope="col">Sum</th>
               <th scope="col">QTY</th>
            </tr>
        </thead>
    </table>   
  <?php endif;?>
   <table class="table table-hover" style="width:50%;margin:auto;" class="mx-auto">
       <tbody>
          <tr>
            <th scope="row"><?php echo $row['name'] ;?></th>
            <td><?php echo $row['description'] ;?></td>
            <td><?php echo $row['price'];?></td>
            <td><?php echo $row['price']*$row['qty'] ;?></td>
            <td><?php echo $row['qty'] ;?></td>
          </tr> 
      </tbody>
   </table>   
<?php $order_id=$row['order_id']; 
};?>
<?php include('footer.php'); ?>






