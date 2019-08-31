<?php session_start();
   include 'connection.php';
   include 'function.php';
   $pdo = new PDO($dsn, $user, $pass, $opt);

   // Add User Starts Here
    if(isset($_REQUEST['update_price'])){
     if($_REQUEST['total_supply']<$_REQUEST['total_sold']){
         header('Location:update_price.php?choice=error&value=Total Supply can never be less that Sold Tokens ie, '.$_REQUEST['total_sold']);
         exit();
     }    
    
      $table = "entrc_price";
      $result = $pdo->exec("UPDATE $table SET `price`='".$_REQUEST['price']."', `total_supply`='".$_REQUEST['total_supply']."', `user_transaction_limit`='".$_REQUEST['user_transaction_limit']."' , `withdraw_transaction_fees`='".$_REQUEST['withdraw_transaction_fees']."' , `sell_transaction_fees`='".$_REQUEST['sell_transaction_fees']."'");

      add_notification("Toekn Price Updated", "admin");
      header('Location:update_price.php?choice=success&value=Token Price Updated');
      exit();
    }
?>