     
       <?php $data = file_get_contents("http://api.etherscan.io/api?module=account&action=tokenbalance&contractaddress=0xAf55F3B7DC65c8f9577cf00C8C5CA7b6E8Cc4433&address=0xe34f89153495cc29c02b8b863e5bf44af9cd26cb&tag=latest&apikey=KN6UV25CEHMII57MUZ9BNZPTG8IXPNJF71");              
          $mata = json_decode($data, true);          
         // print_r($mata); 
 ?>
 
 <?php
    //stats Data
    // find totals users
  try {
          $stmt = $pdo->prepare('SELECT id FROM `users`');
      } catch(PDOException $ex) {
          echo "An Error occured!"; 
          print_r($ex->getMessage());
      }
      $stmt->execute();
      $user = count($stmt->fetchAll());  

      // Find Total Sold Tokens
       try {
          $stmt = $pdo->prepare('SELECT sum(no_of_tokens) as tokenss FROM `buy_token`');
      } catch(PDOException $ex) {
          echo "An Error occured!"; 
          print_r($ex->getMessage());
      }
      $stmt->execute();
      $tokens = ($stmt->fetchAll());   
      //print_r($tokens);
      
      
    
    $dara =  get_data_id("entrc_price");
    
       try {
          $stmt = $pdo->prepare('SELECT sum(balance) as tokens_sold FROM `users`');
      } catch(PDOException $ex) {
          echo "An Error occured!"; 
          print_r($ex->getMessage());
      }
      $stmt->execute();
      $tokens_sold = ($stmt->fetch()); 
      
   // print_r($tokens_sold);
    
    $total_supply = $dara['total_supply'];
    $total_users = $user;
    $tokens_sold = $tokens_sold['tokens_sold']; 
    $tokens_left = $total_supply - $tokens_sold;
       

  ?>
  
  
        <div class="row">
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card">
              <div class="row">
                <div class="col-sm-4" style="text-align: center;">
                  <img src="img/profits.svg" class="ico" style="opacity: 1">
                </div>
                <div class="col-sm-8 rgt">
                  <div style="padding: 10px;"></div>
                  <div style="font-size: 12px;color: #000db3;">TOTAL SUPPLY</div>
                  <div style="font-size: 25px;color: #777;font-family: 'Century Gothic';font-weight: bold;"><?php echo number_format((float)$total_supply, 2, '.', '');; ?></div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card">
              <div class="row">
                <div class="col-sm-4 lft">
                  <img src="img/available.svg" class="ico" style="opacity: .8">
                </div>
                <div class="col-sm-8 rgt">
                  <div style="padding: 10px;"></div>
                  <div style="font-size: 12px;color: #000db3;">AVAILABLE</div>
                  <div style="font-size: 25px;color: #777;font-family: 'Century Gothic';font-weight: bold;"><?php echo number_format((float)$tokens_left, 2, '.', '');; ?></div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card">
              <div class="row">
                <div class="col-sm-4 lft">
                  <img src="img/sold.svg" class="ico" style="opacity: .8">
                </div>
                <div class="col-sm-8 rgt">
                  <div style="padding: 10px;"></div>
                  <div style="font-size: 12px;color: #000db3;">SOLD</div>
                  <div style="font-size: 25px;color: #777;font-family: 'Century Gothic';font-weight: bold;"><?php echo number_format((float)$tokens_sold, 2, '.', '');; ?></div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card">
              <div class="row">
                <div class="col-sm-4 lft">
                  <img src="img/use.svg" class="ico" style="opacity: .8">
                </div>
                <div class="col-sm-8 rgt">
                  <div style="padding: 10px;"></div>
                  <div style="font-size: 12px;color: #000db3;">USERS/CONTRIBUTORS</div>
                  <div style="font-size: 25px;color: #777;font-family: 'Century Gothic';font-weight: bold;"><?php echo $total_users; ?></div>
                </div>
              </div>
            </div>
          </div>

        </div>

