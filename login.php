<?php 
 if(isset($_POST['email']) && isset($_POST['password'])){
    include('inc_connexion.php');

    $sql = "SELECT * FROM user WHERE email = '".$_POST['email']."'";
    $result = $idcon->query($sql);
    if($result->rowCount()>0){
        $users=$result->fetchALL(PDO::FETCH_OBJ);
        $email = $users[0]->email;
        $password = $users[0]->pwd;
        if($password===$_POST['password'] && $email===$_POST['email']){
            echo "Success, Authenticated, ".$users[0]->fname.", ".$users[0]->role;
        }else{
            echo "Failed, email or password is incorrect";
        }
    }else{
        echo "Failed, No user matches your credentials";
    }
 }
?>

