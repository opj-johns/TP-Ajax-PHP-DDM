
<div class="row">
    <div class="row">
            <div class="col-12 p-2 text-center bg-primary text-white m-3">
            <h2>TP AJAX & PHP - Sign up Page</h2>
            </div>
    </div>
    <div class="col-5 ">
        <div class="form-group  py-1">
            <label for="field0">Nom</label>  <span class="  text-danger"  id="err0"></span>
            <input type="text" class="form-control" id="field0" placeholder="nom">
        </div>
        <div class="form-group py-1">
            <label for="field1">Prenom</label> <span class="    text-danger" id="err1"></span>
            <input type="text" class="form-control" id="field1" placeholder="prenom">
        </div>
        <div class="form-group py-1">
            <label for="field2">Email</label> <span class=" text-danger" id="err2"></span>
            <input type="email" class="form-control" id="field2" placeholder="Email">
        </div>
        <div class="form-group py-1">
            <label for="role">Role</label>
            <input type="text" disabled class="form-control" id="role" value="USER" placeholder="Email">
        </div>
    <div class="form-group py-1">
        <label for="field3">Password</label> <span class="  text-danger" id="err3"></span>
        <input type="password" class="form-control" id="field3" placeholder="Password">
    </div>
    <div class="form-group py-1">
        <label for="field4">Confirm Password</label>
        <input type="password" class="form-control" id="field4" placeholder="Password">
    </div>
    <div class="form-group py-1">
        <label class="form-check-label"><input type="checkbox"> Remember me</label>
    </div>
    <button  class="btn btn-primary" id="btn-signup">Sign up</button>
    </div>
</div>