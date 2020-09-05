<?php
class Submit 
{  
public $error=false;
public $error_name;
public $error_price;
public $error_description;
public $error_first_name;
public $error_last_name;
public $error_email;
public  $tabl;
public $errors=[];
public function __construct( $error_name=null, $error_price=null, $error_description=null,                           $error_first_name=null, $error_last_name=null, $error_email=null) 
{
    if (isset($_POST['submit']) ) {
        $this->error_name=$error_name;
        $this->error_description=$error_description;
        $this->error_price=$error_price;
        $this->error_first_name=$error_first_name;
        $this->error_last_name=$error_last_name;
        $this->error_email=$error_email;
    }
}
public function submit()
    
{
    
    if (isset($_POST['submit'])) {
       foreach ($_POST as $key=>$val ) {
          if (empty($val)) {
             $this->error = true;
             $this->errors[$key] = $this->{'error_'."$key"};
           }   
        };
    }; 
}   
public function insert($pdo, $col1, $col2, $col3, $table, $var1, $var2, $var3)
    
{
   if (!$this->error) {
     $stmt = $pdo->prepare("INSERT INTO $table ($var1, $var2, $var3 ) VALUES(?, ?, ?)");
     $stmt->execute([ $col1, $col2, $col3 ]); 
    };
    
}  
    
}
 























