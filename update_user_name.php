<?php session_start();
ob_start();
    include 'pdo_class_data.php';
    include 'connection.php';
    include 'administrator/function.php';
    $pdo_auth = authenticate();
    $pdo = new PDO($dsn, $user, $pass, $opt);
    
    
    try {
            $stmt = $pdo->prepare('UPDATE `users` SET `username`="'.$_REQUEST['username'].'" WHERE id= '.$pdo_auth['id']);
            //echo 'UPDATE `users` SET `username`="'.$_REQUEST['username'].'" WHERE id= '.$pdo_auth['id'];
        } catch(PDOException $ex) {
            echo "An Error occured!"; 
            print_r($ex->getMessage());
        }
        $stmt->execute();
        header('Location:dashboard.php?choice=success&value=Your Username has been Allotted as :'.$_REQUEST['username']);
        exit;
?>