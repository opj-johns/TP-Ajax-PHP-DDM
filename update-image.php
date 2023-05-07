<?php
// if(isset($_POST['id'])){
// require("inc_connexion.php");
// $file_name = $_FILES['image']['name'];
// $file_tmp = $_FILES['image']['tmp_name'];
// $target_dir = "img/";
// $target_file= $target_dir.basename($file_name);
// header('Content-Type: application/json');
// $req="select * from etudiants where id=".$_GET['id'];
// if(!$req){
//     echo json_encode(array('error'=>"Error occurred while fetching student"));
//     // die("Error occurred while fetching student"); 
// }
// $res=$idcon->query($req);
// if(!$res){
//     echo json_encode(array('error'=>"Error occurred while fetching student"));
//     // die("Error occurred while fetching student");
// }
// $resobj = $res->fetch(PDO::FETCH_OBJ);
// $photoUrl = $resobj->photo;

// $req="select * from etudiants where photo=".$photoUrl;
//    $res=$idcon->query($req);
// $rows=$res->rowCount();
// if(!$rows){
//     echo json_encode(array('error'=>"Error occurred while updating student photo")); 
//     // die("Error occurred while updating photo");
// }
// if($row==1){
//     if(file_exists($photoUrl)){
//         unlink($photoUrl);
//     }
// }
// if(!move_uploaded_file($file_tmp,$target_file)){
//     echo json_encode(array('error'=>"Error occurred while saving photo"));
// }else{
//     echo json_encode(array('response'=>"Successfully saved new student"));
// }
// $res->closeCursor();
// $idcon=NULL;
// }


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require("inc_connexion.php");
    $file_name = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $target_dir = "img/";
    $target_file= $target_dir.basename($file_name);
    header('Content-Type: application/json');


    $sql = "select * from etudiants where id=".$_POST['id'];
    $res = $idcon->query($sql);
    if($res){
        $resobj = $res->fetch(PDO::FETCH_OBJ);
        $photoUrl = $resobj->photo;
        $sql = "select * from etudiants where photo='".$photoUrl."'";
        $res=$idcon->query($sql);       
        $rows=$res->rowCount();
        if($rows==1){
            if(file_exists($photoUrl)){
                unlink($photoUrl);
            }
        }

        if(!move_uploaded_file($file_tmp,$target_file)){
            echo json_encode(array('error'=>"Error occurred while saving photo"));
            die();
        }
        $sql = "UPDATE etudiants 
                SET photo = '".$file_name."' 
                WHERE id=".$_POST["id"];
        $res = $idcon->query($sql);
        echo json_encode(array('response'=>"Successfully saved photo"));
    }else{
        echo json_encode(array('error'=>"Error occurred while saving photo"));
    }
  }


  $res->closeCursor();
$idcon=NULL;
?>