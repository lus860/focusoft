$(function () {
    
   $("#order").on( "click", function() {
        //$this = $(this);
        $prod_id= $(this).attr("data-prod-id");
        $quantity=$("#quantity").val();
        //alert( $prod_id);
        //alert( $quantity);
     $.ajax({
            url: "../order.php",
            method: "POST",
            data: {
                prod_id:$prod_id,
                quantity:$quantity, 
            },
            success: function(data){
            console.log(data);
            },
   })
});
    
});