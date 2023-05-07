<?php
if(isset($_POST['userId'])&& isset($_POST['action'])){
require("inc_connexion.php");
$action=$_POST['action']=='add'? ' ADMIN':'';
$req="UPDATE user SET role='USER".$action."' WHERE id='".$_POST['userId']."'";
$res=$idcon->query($req);
if($res){
    echo"success,Enregistremnt supprimer avec succes";
}
else{
    echo"error,Enregistremnt n'est pas supprimer !!!!!!!!!!!"; 
}
}
?>