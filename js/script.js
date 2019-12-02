$(function () {
    
   $("#order").on( "click", function() {
        $cart=[];
       $(".prod").each(function(){
        if( $(this).val()==0){
            
        } else {
         $prodid = $(this).attr("data-prod-id");
         $quantity = $(this).val();
         $cart.unshift([$(this).val(),$prodid]);
         console.log($(this).val());
          console.log($prodid);     
        };
        });
        console.log($cart);
        //alert( $prod_id);
        //alert( $quantity);
     $.ajax({
            url: "../order.php",
            method: "POST",
            dataType: "jsonp",
            data: { 
                order:$cart
            },
            success: function(data){
            //$cart={};
            },
   })
});
    
});