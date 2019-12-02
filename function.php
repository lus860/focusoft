<?php include('connect.php'); 
function select( $pdo, $table) {
       $col;
       $result = $pdo->query("SELECT * FROM $table "); 
        while ( $row = $result->fetch(PDO::FETCH_ASSOC) ) {
           $col[$row ['id']]=[$row ['name'], $row ['description'], $row ['price']];  
        }
      return $col;
}