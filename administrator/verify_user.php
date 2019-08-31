<?php include 'connection.php';
	  include 'add_notification_user.php';
	  include 'administrator/function.php';
	  $pdo = new PDO($dsn, $user, $pass, $opt);
	  //print_r($_REQUEST);
	  
	  try {
	      $stmt = $pdo->prepare('SELECT * FROM `users` WHERE `id`='.$_REQUEST['id']);
	     //echo 'SELECT * FROM `users` WHERE `id`="'.$_REQUEST['id'];
	  } catch(PDOException $ex) {
	      echo "An Error occured!"; 
	      print_r($ex->getMessage());
	  }
	  $stmt->execute();
  	  $user = $stmt->fetchAll();
  	  $row_count = $stmt->rowCount();
  	  $piyush="";
  	  
  	  //echo $row_count;
  	  
  	  
  	  
        $stmt = $pdo->prepare('SELECT * FROM `tx_addresses` WHERE `status`="Pending" LIMIT 1');
         $stmt->execute();
         $fata = $stmt->fetch();  
         //print_r($fata);
    
          $table = "tx_addresses";
          $result = $pdo->exec("UPDATE $table SET `status`='Used', `email`='".$email."'  WHERE id=".$fata['id']);
          $tx_address = $fata['tx_address'];

  	  
	 if($row_count>0){	 	
	  	  try {
		      $stmt = $pdo->prepare('UPDATE users SET `verified`="Yes", `tx_address`="'.$tx_address.'" WHERE `id`='.$_REQUEST['id']);
		  } catch(PDOException $ex) {
		      echo "An Error occured!"; 
		      print_r($ex->getMessage());
		  }
		  $stmt->execute();
		  header('Location:users.php?choice=success&value=Verification success!');
		  exit();
	 }
	 else{
	 	$piyush = '<div style="padding:10px;color:#fff;background-color:red;">Verification Failled, Try Registering Again</div>';
	 }
  ?>