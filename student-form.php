<div class="col-md-12 text-center "  id="imgContainer">
    <img  src="./img/test.png" 
	id="displayImage" class="rounded-circle " width="110" height="110"/>
</div>
<div class="row">
	<!-- Add photo -->
	<div class="col-md-6">
		<label class="col-form-label col-form-label-sm" for="photo">
		Photo: </label> <span id="err0" class="text-danger px-1"></span><br>
    	<div class="form-group">
        	<input type="file" id="field0" name="phtotoInput" class="form-control">
		</div>
    </div>                               
	<div class="col-md-6">
    	<div class="form-group">
    		<label class="col-form-label col-form-label-sm" for="field1">Civilité: </label><span id="err1" class="text-danger px-1"></span><br>
            <select  id="field1" class="form-control">
				<option value=""></option>
				<option value="Mme">Mme</option>
				<option value="Mr">Mr</option>
				<option value="Mlle">Mlle</option>
			</select>
		</div>
     </div>
    <div class="col-md-6">
    	<div class="form-group">
    		<label class="col-form-label col-form-label-sm" for="field2">Nom: </label><span id="err2" class="text-danger px-1"></span><br>
            <input type="text"  id="field2" class="form-control" required >
		</div>
	</div>
    <div class="col-md-6">
    	<div class="form-group">
    		<label class="col-form-label col-form-label-sm" for="field3">Prénom: </label><span id="err3" class="text-danger px-1"></span><br>
            <input type="text"  id="field3" class="form-control" required >
		</div>
    </div>
    
    <div class="col-md-6">
    	<div class="form-group">
    		<label class="col-form-label col-form-label-sm" for="field4" >E-mail: </label><span id="err4" class="text-danger px-1"></span><br>
            <input  type="email" id="field4" class="form-control">
		</div>
    </div>    
    <div class="col-md-6">
    	<div class="form-group">
    		<label class="col-form-label col-form-label-sm" for="field5">Téléphone: </label><span id="err5" class="text-danger px-1"></span><br>
            <input  type="text" id="field5" class="form-control" required >
		</div>
    </div> 
    </div>  
</div>