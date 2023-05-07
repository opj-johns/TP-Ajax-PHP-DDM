<?php
require("inc_connexion.php");
$page_size = $_POST["pageSize"];
$page = $_POST["page"];
$offset = (($page - 1) * $page_size);
$req = "SELECT COUNT(*) FROM etudiants";
$result = mysqli_query($conn, $req);
$row = mysqli_fetch_array($result);
$disableFeatures = "";
// $res = $idcon->query($req);
$book_size = $row[0];
$pages = floor($book_size/$page_size) + ($book_size%$page_size==0? 0 : 1);
$searchQuery =false;

if(isset($_POST['email'])){
	$result = $idcon->query("SELECT role FROM user WHERE email = '".$_POST['email']."'");
	$users=$result->fetchALL(PDO::FETCH_OBJ);
	$roles = $users[0]->role;
	if(!strpos($roles,'ADMIN')){
		$disableFeatures = "btn disabled";
	}
}

if(isset($_POST["param"])){
	$searchQuery = true;
    $req="select * from etudiants where nom like '%".$_POST["param"]."%' or prenom like '%".$_POST["param"]."%' LIMIT ".$page_size." OFFSET ".$offset;
	if(isset($_POST["sortBy"]) && $_POST["sortBy"]!=="default"){
		$req="select * from etudiants where nom like '%".$_POST["param"]."%' or prenom like '%".$_POST["param"]."%' order by ".$_POST["sortBy"]." ASC LIMIT ".$page_size." OFFSET ".$offset;
		// echo $req;
		echo "<h5 class='fw-bold'>Sorted by 
        <span class='text-success'>".$_POST["sortBy"]."</span></h5>";
	}
}else{
    if(isset($_POST["sortBy"])){
        if($_POST["sortBy"]!=="default"){
            $req="select * from etudiants order by ".$_POST["sortBy"]." ASC LIMIT ".$page_size." OFFSET ".$offset;
			// echo  $req;
            echo "<h5 class='fw-bold'>Sorted by 
            <span class='text-success'>".$_POST["sortBy"]."</span></h5>";
        }else{
            $req="select * from etudiants LIMIT ".$page_size." OFFSET ".$offset;
        }
    }else{
        $req="select * from etudiants LIMIT ".$page_size." OFFSET ".$offset;
    }
}

// code to disable or enable greater than and less than pagination links
$disable_previous_link="";
$disable_next_link="";

$res=$idcon->query($req);
$nbr=$res->rowCount();
if($searchQuery){
	$book_size = $nbr;
	$pages = floor($book_size/$page_size) + ($book_size%$page_size==0? 0 : 1);
}

if($page==1){
	$disable_previous_link="disabled";
}
if($page==$pages){
	$disable_next_link= "disabled";
}

if($nbr>0){
	echo"<table class='table table-bordered table-sm'>
<tr class='bcolor'><td>Id</td><td>Civilité</td><td>Nom</td><td>Prénom</td><td>E-mail</td><td>Actions</td></tr>";
	$resobj=$res->fetchALL(PDO::FETCH_OBJ);									
	foreach($resobj as $cle=>$val){
		echo"<tr>";
		echo"<td>".$val->id."</td>";
		echo"<td>".$val->civilite."</td>";
		echo"<td>".$val->nom."</td>";
		echo"<td>".$val->prenom."</td>";
		echo"<td>".$val->email."</td>";
		echo"<td>
		<a href='#' id='".$val->id."' class='text-success' data-role='view' data-bs-toggle='modal' data-bs-target='#viewStudentModal'><i class='bi bi-eye-fill' title='Afficher'></i></a>
&nbsp;&nbsp;&nbsp;
<a href='#' id='".$val->id."' id='edit'  class='text-warning ".$disableFeatures."' data-role='edit' data-bs-toggle='modal' data-bs-target='#editStudentModal'><i class='bi bi-pencil-fill' title='Modifier'></i></a>
&nbsp;&nbsp;&nbsp;
<a href='#' id='".$val->id."' id='delete' class='text-danger ".$disableFeatures."' data-role='delete' data-bs-toggle='modal' data-bs-target='#deleteStudentModal'><i class='bi bi-trash-fill' title='Supprimer'></i></a>
		</td>";
		echo"</tr>";
	}
	echo"</table>";
	echo "<div class='row'>";
		echo '<nav aria-label="Page navigation example">';
		echo '<ul class="pagination">';
		echo '<li class="page-item disabled"><a class="page-link"  href="#">page size: '.$page_size.'</a></li>';
		echo '<li class="page-item disabled"><a class="page-link"   href="#">pages: '.$pages.'</a></li>';
		echo '<li class="page-item disabled"><a class="page-link"  href="#">page: '.$page.'</a>
		</li>';
		echo '<li class="page-item '.$disable_previous_link.' "><a class="page-link" data-role="previous" href="#">&lt</a></li>';
	   		echo '<li class="page-item '.$disable_next_link.'"><a class="page-link" data-role="next" href="#">&gt</a></li>';
	   		echo '<li class="page-item disabled">
			   <a class="page-link" href="#">book size: '.$book_size.'</a></li>';
			echo '</ul>';
		echo '</nav>';
	echo "</div";
} 
else{

  echo '<div class="card text-white bg-success mb-3" style="max-width: 18rem;">
  <div class="card-body">
    <p class="card-text fs-5 fw-bold">Oohps!! Found Nothing...</p>
	</div>
	</div> ';
}
$res->closeCursor();
$idcon=NULL;
?>