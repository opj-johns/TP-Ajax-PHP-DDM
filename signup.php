<?php 
 if(isset($_POST['email']) && isset($_POST['pwd'])){
    include('inc_connexion.php');

    $sql = "INSERT INTO user (fname,lname,email,role,pwd) values('".$_POST['fname']."','"
             .$_POST['lname']."','"
             .$_POST['email']."','"
             .$_POST['role']."','" 
             .$_POST['pwd']."')";

    $result = $idcon->query($sql);
    if( $result){
        echo "Success, User saved successfully";
    }else{
        echo "Failed, No user matches your credentials";
    }
 }
?>
