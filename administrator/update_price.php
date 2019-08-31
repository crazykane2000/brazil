<?php session_start();
    include 'pdo_class_data.php';
    include 'connection.php';
    $pdo_auth = authenticate_admin();
    $pdo = new PDO($dsn, $user, $pass, $opt);
    include 'function.php';

?>
<!DOCTYPE html>
<html>
<head>
  <?php include 'head.php'; ?>
  <title>Update User Administration Credentials </title>
  </head>
 <body class="sidebar-mini fixed  pace-done sidebar-collapse">
    <div class="wrapper">
      <!-- Navbar-->
      <?php include 'navbar.php'; ?>

       <div class="content-wrapper ">
         <div class="page-title" style="padding: 32px;background-color: #101d85;box-shadow: 0px 2px 10px rgba(0,0,0,.2);">
          <div class="row" style="width: 100%;margin-left:0px;">
           <div class="col-sm-3 lft">
            <div style="padding: 20px;" class="mobss"></div>
              <div class="lft_pad">
                <div style="padding: 10px;"></div>
                <h1 style="font-family: 'Century Gothic';color: #999;font-size: 25px;font-weight: normal;"><div style="font-weight: bold;color: #ddd">Update </div>Credentials</h1>
                
              </div>
           </div>
           <div class="col-sm-9">
             <?php include 'price_panel.php';  ?>
           </div>
          
          </div>
        </div>

        

        <div style="padding: 20px;"></div>
        <?php see_status2($_REQUEST); 
            $rata = get_data_id("entrc_price");
            // print_r($rata);
        ?>
         <div class="clearfix"></div>
          <div class="col-md-5">
            <div class="card">
              <div class="table-responsive">
                <!--<h3>Buy Requests </h3><hr/>-->
                  <form action="update_price_handle.php" method="POST">
                      <div class="form-group">
                        <label class="control-label">Enter Price of Single Token</label>
                        <input class="form-control" style="border-radius: 0px;border:solid 1px #03a9f4;font-size:20px;" type="text" name="price" value="<?php echo $rata['price']; ?>" step=".1" placeholder="Enter Price of single Token ">
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label">Enter Total Supply</label>
                        <?php  
                            try {
                                    $stmt = $pdo->prepare('SELECT SUM(balance) as total_sold FROM `users` ');
                                } catch(PDOException $ex) {
                                    echo "An Error occured!"; 
                                    print_r($ex->getMessage());
                                }
                                $stmt->execute();
                                $user = $stmt->fetch();
                               // print_r($user);
                        ?>
                        <input type="hidden" name="total_sold"  value="<?php echo $user['total_sold']; ?>" />
                        <input class="form-control" style="border-radius: 0px;border:solid 1px #03a9f4;font-size:20px;" type="text" name="total_supply" value="<?php echo $rata['total_supply']; ?>" step=".1" placeholder="Enter Total Supply ">
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label">Withdraw Transaction Fees</label>
                        <input class="form-control" style="border-radius: 0px;border:solid 1px #03a9f4;font-size:20px;" type="text" name="withdraw_transaction_fees" value="<?php echo $rata['withdraw_transaction_fees']; ?>" step=".1" placeholder="Enter Withdraw Transaction Fee in Tokens ">
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label">Sell Transaction Fees</label>
                        <input class="form-control" style="border-radius: 0px;border:solid 1px #03a9f4;font-size:20px;" type="text" name="sell_transaction_fees" value="<?php echo $rata['sell_transaction_fees']; ?>" step=".1" placeholder="Enter Sell Transaction Fee in Tokens ">
                      </div>
                      
                      
                       <div class="form-group">
                        <label class="control-label">Users Transaction Limit</label>
                        <input class="form-control" style="border-radius: 0px;border:solid 1px #03a9f4;font-size:20px;" type="text" name="user_transaction_limit" value="<?php echo $rata['user_transaction_limit']; ?>" step=".1" placeholder="Enter User Transaction Limit ">
                      </div>
                      <br/><br/>
                      
                      <div class="form-group">
                          <input type="submit" class="btn btn-info" style="font-size:14px;" name="update_price" value="Update Token Statistics">
                      </div>
                      
                      
                                     
                    </form>
              </div>
            </div>
        </div>
        
        
       
        <?php include 'footer.php'; ?>        
      </div>
    </div>
    
    <!-- Javascripts-->
    <?php// include 'modal.php'; ?>
    <?php include 'scripts.php'; ?>    
  </body>
</html>