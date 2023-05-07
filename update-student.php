<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require("inc_connexion.php");
    header('Content-Type: application/json');
    $sql = "UPDATE etudiants SET 
            nom='".$_POST['nom']."', 
            prenom='".$_POST['prenom']."',
            civilite='".$_POST['civilite']."',
            email='".$_POST['email']."',
            tel='".$_POST['contact']."'
            WHERE id =".$_POST['id'];

    $result = $idcon->query($sql);
    if($result){
        echo json_encode(array('response'=>"Successfully updated student"));
    }else{
        echo json_encode(array('error'=>"Error updating student"));
    }
  }
  $result->closeCursor();
$idcon=NULL;
?>