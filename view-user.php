<?php 
if(isset($_POST['email'])){
    include('inc_connexion.php');
    $sql = "SELECT * FROM user WHERE email = '".$_POST['email']."'";
    $result = $idcon->query($sql);
    if($result->rowCount()>0){
        $users=$result->fetchALL(PDO::FETCH_OBJ);
        echo '<div class="col-7 ">
        <div class="form-group  py-1">
            <label for="field0">Nom</label> <span class="text-danger"  id="err0"></span>
            <input type="text" class="form-control" value="'.$users[0]->lname.'" id="field0" placeholder="nom">
        </div>
        <div class="form-group py-1">
            <label for="field1">Prenom</label> <span class="text-danger" id="err1"></span>
            <input type="text" class="form-control" value="'.$users[0]->fname.'" id="field1" placeholder="prenom">
        </div>
        <div class="form-group py-1">
            <label for="field2">Email</label> <span class=" text-danger" id="err2"></span>
            <input type="email" class="form-control" value="'.$users[0]->email.'" id="field2" placeholder="Email">
        </div>
        <div class="form-group py-1">
            <label for="role">Role</label>
            <input type="text" disabled class="form-control" value="'.$users[0]->role.'" id="role" value="USER" placeholder="Email">
        </div>';
   echo '</div> ';
    }else{
        echo "Failed, No user matches your credentials";
    }
    $result->closeCursor();
    $idcon=NULL;
  
}

?>