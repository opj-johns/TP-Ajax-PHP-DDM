<?php
if(isset($_GET['id'])){
require("inc_connexion.php");
$req="select * from etudiants where id=".$_GET['id'];
$res=$idcon->query($req);
$resobj = $res->fetch(PDO::FETCH_OBJ);

}
?>
<div class="row">
<div class="col-md-12 text-center">
        		<div class="form-group">
                	<img src="img/<?php echo $resobj->photo ?>" id="etdimg" class="rounded-circle " width="110" height="110"/>
				</div>
</div>
        
        <div class="col-md-6">
        	<div class="form-group">
        		<label class="col-form-label col-form-label-sm" for="clientCity">ID : </label><br>
                <input type="text"  id="etdid" class="form-control" required disabled value="<?php echo $resobj->id ?>">
             </div>
       	</div>
       		
                                           
			<div class="col-md-6">
        		<div class="form-group">
        			<label class="col-form-label col-form-label-sm" for="clientCity">Civilité: </label><br>
                    <input type="text" disabled  id="etdcivilite" class="form-control" required value="<?php echo $resobj->civilite ?>">
				</div>
       		 </div>
             
       		<div class="col-md-6">
        		<div class="form-group">
        			<label class="col-form-label col-form-label-sm" for="clientCity">Nom: </label><br>
                    <input type="text" disabled id="etdnom" class="form-control" required value="<?php echo $resobj->nom ?>">
				</div>
			</div>
            
         	<div class="col-md-6">
        		<div class="form-group">
        			<label class="col-form-label col-form-label-sm" for="clientCity">Prénom: </label><br>
                    <input type="text"  id="etdprenom" disabled class="form-control" required value="<?php echo $resobj->prenom ?>">
				</div>
        	</div>
            
         	<div class="col-md-6">
        		<div class="form-group">
        			<label class="col-form-label col-form-label-sm" for="clientCity">E-mail: </label><br>
                    <input  type="text" id="etdemail" class="form-control" disabled required value="<?php echo $resobj->email ?>">
				</div>
        	</div>    
            <div class="col-md-6">
        		<div class="form-group">
        			<label class="col-form-label col-form-label-sm" for="clientCity">Téléphone: </label><br>
                    <input  type="text" id="etdtel" class="form-control" disabled required value="<?php echo $resobj->tel ?>">
				</div>
        	</div> 
            </div>  
</div>
<?php
$res->closeCursor();
$idcon=NULL;
?>