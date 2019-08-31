<?php
   include 'connection.php';
   include 'function.php';
   include '../add_notification_user.php';
   $pdo = new PDO($dsn, $user, $pass, $opt);
   
    
   
$data = get_data_id("buy_token", $_REQUEST['id']);
     //print_r($data);
     $user_id = $data['user_id'];
     
    $dara =  get_data_id("entrc_price");
    if($dara['total_supply']<$data['no_of_tokens']){
      header('Location:buy_requests.php?choice=error&value= Cant be more than total Supply');
      exit();
    }
   // Add User Starts Here
      $table = "buy_token";
      $result = $pdo->exec("UPDATE $table SET `status`='Approved'  WHERE id=".$_REQUEST['id']);

     

     $user_data = get_data_id("users", $user_id);
     //print_r($user_data);
     $balance = $user_data['balance'];
     //echo $balance;
    // echo " / /".$data['no_of_tokens'];;
     $balance = $balance+$data['no_of_tokens'];
    // echo " /".$balance;

     $result = $pdo->exec("UPDATE `users` SET `balance`='".$balance."'  WHERE id=".$user_id);

     //bbt admin wallet address
     
     
     
    

      // Starts Here monitoring the Transactions
        $tx_hash = "0x".md5(date("U")).md5(date("Y"));
        $table = "transfer";
        $from_address = "0xAf55F3B7DC65c8f9577cf00C8C5CA7b6E8Cc4433 : SXT ADMIN";


          $key_list = "`to`,`from`, `tx_address`, `tokens`, `status`, `process`";
          $value_list = "'".$data['tx_address']."',";
          $value_list.= "'".$from_address."',";
          $value_list.="'".$tx_hash."',";
          $value_list.="'".$data['no_of_tokens']."',";
          $value_list.="'Success',";
          $value_list.="'Buy Tokens'";   

          try {
              $stmt = $pdo->prepare("INSERT INTO `$table` ($key_list) VALUES ($value_list)");
          } catch(PDOException $ex) {
              echo "An Error occured!"; 
              print_r($ex->getMessage());
          }
          
          $stmt->execute();


      //ends here m,onitoring Transfers



      add_notification("Buy Token Request Approved", "admin");
      add_notification_user("Your Buy Token Request Approved, Balance Has Been Added To Your Wallet", "user",$user_id);
     header('Location:buy_requests.php?choice=success&value= Buy Token Request Approved');
?>