<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>TP AJAX & PHP DDM</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap-icons.css">
<link rel="stylesheet" href="css/jquery.toast.min.css">
<link rel="stylesheet" href="./css/style.css"> 
</head>
<body>
<div class="container " id="mainContainer">
  <div class="row">
        <div class="col-10 p-2 text-center bg-primary text-white my-3">
          <h2>TP AJAX & PHP  </h2>
        </div>
        <div class="col-2 py-2 text-center bg-primary  my-3">
          <div class="dropdown">
            <span><a href="#" class="text-warning fw-bold fs-5 pt-1"  id="username"></a></span>
              <div class="dropdown-content">
              <a href="#"  
                  data-role="profile"
                  class='btn' 
                  data-bs-toggle='modal' 
                  data-bs-target='#viewUserModal'>
                  Profile 
                </a>
                 <hr class="my-1">
                <a href="#"   data-role="users" data-bs-toggle='modal' 
                  data-bs-target='#viewUserModal' >Users</a>
                <hr class="my-1">
                <a href="#" class=" text-danger" class='btn' data-role="logout">Logout</a>
              </div>
          </div>
        </div>
  </div>
  <div class="row">
    <div class="col-md-2 py-1">
      <button class="btn btn-primary" 
              id="btnNewStudent"
              data-bs-toggle='modal' 
              data-bs-target='#newStudentModal'  
              data-role='addStudent'>
        Nouveau Etudiant
      </button>
    </div>
    <div class="col-md-3 py-1 pe-0">
        <!-- <input type="text" id="searchInput" class="form-control"   name="searchParam"> -->
        
            <input class="form-control" id="searchInput" type="search" placeholder="Chercher Nom ou Prenom" aria-label="Search">
            
    </div>
    <div class="col-md-2 py-1 ps-0">
    <button class="btn btn-outline-success " id="btn-search" type="button">
              Chercher
    </button> 
    </div>
    <div class="col-md-2 text-start py-1">
      <div class="form-group">
          <select class="form-select" 
                  id="sortParam" 
                  aria-label="Sort parameter selection">
            <option value='default' selected>Trier par</option>
            <option value="id">Id</option>
            <option value="nom">Nom</option>  
            <option value="prenom">Prenom</option>
            <option value="civilite">Civilite</option>
          </select>
      </div>
    </div>
    <div class="col-md-2 text-start py-1">
      <div class="form-group">
          <select class="form-select" 
                  id="pageSize" 
                  aria-label="page size selection">
            <option value='5' selected>Page size</option>
            <option value="5">5</option>
            <option value="10">10</option>  
            <option value="15">15</option>
            <option value="20">20</option>
          </select>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 fs-3 text-primary fw-bold text-center">
      Student Table
    </div>
  </div>
  <div class="row" id="display-content">
  </div>


</div>

<div class="container d-none" id="loginContainer">
  Hello
</div>

 
 <!-- New student modal  -->
<div class="modal fade" id="newStudentModal">
  <div class="modal-dialog">
    <div class="modal-content">       

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title" id="modal-title">Add New Student to DB</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="row" id="studentModalContent">
          student form goes here.
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer" id="modal-footer">
        <button type="button"
                class="btn btn-success" 
                id="btnAddStudent" >
          Add Student
        </button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteStudentModal">
  <div class="modal-dialog">
    <div class="modal-content">       

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title" id="modal-title">Delete Student</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="row fs-5 ps-1" id="deleteModalContent">
          
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer" id="modal-footer">
        <button type="button"
                class="btn btn-danger" 
                id="btnDeleteStudent">
          Delete
        </button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="viewStudentModal">
  <div class="modal-dialog">
    <div class="modal-content">       
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title" id="modal-title">Student View Page</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <div class="row fs-5 ps-1" id="viewModalContent">
          
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer" id="modal-footer">
        <button type="button"
                class="btn btn-success" 
                data-bs-dismiss="modal"
                id="btnDeleteStudent">
          OK
        </button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editStudentModal">
  <div class="modal-dialog">
    <div class="modal-content">       
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title" id="modal-title">Student Edit Page</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <div class="row fs-5 ps-1" id="editModalContent">
          
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer" id="modal-footer">
        <button type="button"
                class="btn btn-success" 
                id="btnEditStudent">
          Edit
        </button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="viewUserModal">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">       
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title text-center text-primary" id="users-modal-title">User Profile</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <div class="row fs-5 ps-1" id="userModalContent">
          
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer" id="modal-footer">
        <button type="button"
                data-bs-dismiss="modal"
                class="btn btn-success">
          Ok
        </button>
      </div>
    </div>
  </div>
</div>


</body>
<script src="js/jQuery_v3.6.3_min.js"></script> 
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.toast.min.js"></script>
<script src="./js/script2.js?v=1234568"></script>
<script src="./js/popper.min.js"></script>
</html>