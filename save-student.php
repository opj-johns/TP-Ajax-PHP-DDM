<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require("inc_connexion.php");
    $file_name = $_FILES['image']['name'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $target_dir = "img/";
    $target_file= $target_dir.basename($file_name);
    header('Content-Type: application/json');
    $sql = "INSERT INTO etudiants (nom,prenom,civilite,email,tel,photo) values('".$_POST['nom']."','"
             .$_POST['prenom']."','"
             .$_POST['civilite']."','"
             .$_POST['email']."','" 
             .$_POST['contact']."','"
             .$file_name."')";
    
    $result = $idcon->query($sql);
    if($result){
        if(!move_uploaded_file($file_tmp,$target_file)){
            echo json_encode(array('error'=>"Error occurred while saving photo"));
        }
        echo json_encode(array('response'=>"Successfully saved new student"));
    }else{
        echo json_encode(array('error'=>"Error occurred while saving student"));
    }
    
    
  }
  $result->closeCursor();
  $idcon=NULL;
?>