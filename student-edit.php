<?php
if(isset($_GET['id'])){
	require("inc_connexion.php");
$req="select * from etudiants where id=".$_GET['id'];
$res=$idcon->query($req);
$resobj = $res->fetch(PDO::FETCH_OBJ);

}
?>
<div class="row">
<div class="col-md-9 text-end me-0 pe-0">
        		
                    <input type="file" class="form-control" name="image" style="visibility:hidden" id="field0">
                    <span id="err0" class="text-danger px-1"></span><br>
                    <button class="btn btn-primary" style="visibility:hidden" id="btn-upload">Upload Image</button>
                    <button     
                     class="btn btn-primary"  
                     type="button" 
                     id="btn-changeImg">Change Img</button>
            
    </div>
<div class="col-md-3  text-end   ps-1 ">
        		<div class="form-group">
                	<img src="img/<?php echo $resobj->photo ?>" id="displayImg" class="rounded-circle " width="110" height="110"/>
				</div>
    </div>
        
        <div class="col-md-6">
        	<div class="form-group">
        		<label class="col-form-label col-form-label-sm" for="id">ID : </label><br>
                <input type="text" disabled  id="id" class="form-control" required  value="<?php echo $resobj->id ?>">
             </div>
       	</div>
                                           
			<div class="col-md-6">
        		<div class="form-group">
        			<label class="col-form-label col-form-label-sm" for="field1">Civilité: </label><span id="err1" class="text-danger px-1"></span><br>
                    
                    <select  id="field1" class="form-control">
				        <option value="" ></option>
				        <option value="Mme" 
                        <?php if($resobj->civilite=='Mme'){echo 'selected';} ?>>
                            Mme
                        </option>
				        <option value="Mr" 
                        <?php if($resobj->civilite=='Mr'){echo 'selected';} ?> >Mr</option>
				        <option value="Mlle"
                         <?php if($resobj->civilite=='Mlle'){echo 'selected';} ?> >Mlle
                        </option>
			        </select>
				</div>
       		 </div>
             
       		<div class="col-md-6">
        		<div class="form-group">
        			<label class="col-form-label col-form-label-sm" for="field2">Nom: </label><span id="err2" class="text-danger px-1"></span><br>
                    <input type="text"  id="field2" class="form-control" required value="<?php echo $resobj->nom ?>">
				</div>
			</div>
            
         	<div class="col-md-6">
        		<div class="form-group">
        			<label class="col-form-label col-form-label-sm" for="field3">Prénom: </label><span id="err3" class="text-danger px-1"></span><br>
                    <input type="text"  id="field3"  class="form-control" required value="<?php echo $resobj->prenom ?>">
				</div>
        	</div>
            
         	<div class="col-md-6">
        		<div class="form-group">
        			<label class="col-form-label col-form-label-sm" for="field4">E-mail: </label><span id="err4" class="text-danger px-1"></span><br>
                    <input  type="text" id="field4" class="form-control"  required value="<?php echo $resobj->email ?>">
				</div>
        	</div>    
            <div class="col-md-6">
        		<div class="form-group">
        			<label class="col-form-label col-form-label-sm" for="field5">Téléphone: </label><span id="err5" class="text-danger fs-5 px-1"></span><br>
                    <input  type="text" id="field5" class="form-control" required value="<?php echo $resobj->tel ?>">
				</div>
        	</div> 
            </div>  
</div>
<?php
$res->closeCursor();
$idcon=NULL;
?>