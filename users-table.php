<?php
require("inc_connexion.php");


	$result = $idcon->query("SELECT id,fname,lname,email,role FROM user");
	
	$nbr=$result->rowCount();
if($nbr>0){
	echo"<table class='table table-bordered table-sm'>
<tr class='bcolor'><td>Id</td><td>Prenom</td><td>Nom</td><td>E-mail</td><td>role</td><td>Action</td></tr>";
	$users=$result->fetchALL(PDO::FETCH_OBJ);
	foreach($users as $cle=>$user){
		echo"<tr>";
		echo"<td>".$user->id."</td>";
		echo"<td>".$user->fname."</td>";
		echo"<td>".$user->lname."</td>";
		echo"<td>".$user->email."</td>";
		echo"<td id='role".$user->id."'>".$user->role."</td>";	
		if(strpos($user->role,'ADMIN')){
			echo"<td>
			<button type='button' user-id='".$user->id."' class='btn btn-warning' id='remove-admin'>
				Remove admin 
        	</button>
		</td>";
		echo"</tr>";
		}else{
			echo"<td>
			<button type='button' user-id='".$user->id."' class='btn btn-danger' id='add-admin'>
				Add admin 
        	</button>
			</td>";
			echo"</tr>";
		}
	}
	echo"</table>";
} 
else{

  echo '<div class="card text-white bg-success mb-3" style="max-width: 18rem;">
  <div class="card-body">
    <p class="card-text fs-5 fw-bold">Oohps!! Found No user...</p>
	</div>
	</div> ';
}
$result->closeCursor();
$idcon=NULL;
?>