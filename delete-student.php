<?php
if(isset($_POST['id'])){
require("inc_connexion.php");
$req="delete  from etudiants where id=".$_POST['id'];
$res=$idcon->exec($req);
if($res){
 echo"success,Enregistremnt supprimer avec succes";
}
else{
echo"error,Enregistremnt n'est pas supprimer !!!!!!!!!!!"; 
}
}
?>