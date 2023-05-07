$.noConflict();	
jQuery(document).ready(function($) {
	// first things firt

	var deleteId = 0;
	var pageNumber = 1;
	var sortValue = "default";
	var pageSizeValue = 5;
	var searchParam = "";
	var STUDENT_TABLE_METHOD_V ="v1";
	// fetch student table
	function fetchStudentsTable(sortByValue, pageSizeValue, pageValue){
		
		STUDENT_TABLE_METHOD_V ="v1"
		let formData = new FormData();
		formData.append("sortBy",sortByValue);
		formData.append("pageSize",pageSizeValue);
		formData.append("page",pageValue);
		formData.append("email",localStorage.getItem("user_email"));
		console.log(sortByValue, pageSizeValue, pageValue);
		$.ajax({
			url:"student-table.php",
			method:"post",
			dataType:"html",
			cache : false,
    		processData: false,
			contentType: false, 
			data:formData,
			success:function(table){
				$("#display-content").html(table);
				// console.log(table);
				disableFunctionalities()
			},
			error:function(xhr, status, error){
				toastMessage("Error",error,false);
			}
		})
	}

	function fetchStudentsTableV2(searchParam,sortByValue, pageSizeValue, pageValue){
		STUDENT_TABLE_METHOD_V ="v2"
		let formData = new FormData();
		formData.append("sortBy",sortByValue);
		formData.append("pageSize",pageSizeValue);
		formData.append("page",pageValue);
		formData.append("param",searchParam);
		formData.append("email",localStorage.getItem("user_email"));
		console.log(sortByValue, pageSizeValue, pageValue);
		$.ajax({
			url:"student-table.php",
			method:"post",
			dataType:"html",
			cache : false,
    		processData: false,
			contentType: false, 
			data:formData,
			success:function(table){
				$("#display-content").html(table);
				disableFunctionalities()
				// console.log(table);
			},
			error:function(xhr, status, error){
				toastMessage("Error",error,false);
			}
		})
	}

	function disableFunctionalities(){
		var roles =  localStorage.getItem("roles");
		if(!roles.includes("ADMIN")){
			$("#btnNewStudent").prop('disabled', true);
		}else{
			$("#btnNewStudent").prop('disabled', false);
		}
	}

	$(document).on('click','a[data-role=delete]', function(e){
		deleteId = $(this).attr('id');
		$("#deleteModalContent").html(`Do you want to delete student ${deleteId}?`);
	});

	$(document).on('click','a[data-role=view]', function(e){
		deleteId = $(this).attr('id');
		$.ajax({
			url:'student-view.php',
			method:'GET',	
			data:{id:deleteId},
			success:function(viewPage){
				$("#viewModalContent").html(viewPage);
			},
		});
	});

	$(document).on('click','a[data-role=next]', function(e){
		console.log(pageNumber);
		fetchStudentsTable(sortValue, pageSizeValue, ++pageNumber);
	});

	$(document).on('click','a[data-role=previous]', function(e){
		console.log(pageNumber);
		fetchStudentsTable(sortValue, 5, --pageNumber);
	});

	$(document).on('click','a[data-role=edit]', function(e){
		deleteId = $(this).attr('id');
		$.ajax({
			url:'student-edit.php',
			method:'GET',	
			data:{id:deleteId},
			success:function(viewPage){
				$("#editModalContent").html(viewPage);
				prepareImageEdit();
				
			},
		});
	});

	function prepareImageEdit(){
		let lenImage;
		$("#btn-changeImg").click(function(){
			$("#field0").attr("style","visibility:none");
			$("#btn-upload").attr("style","visibility:none");
			$("#btn-upload").prop("disabled",true);
			$("#btn-changeImg").attr("style","visibility:hidden");
		});	
		
		$("#field0").change(function(e){
			// valide the input field
			let isValideFile = true;
			isValideFile = valideFile(isValideFile);
			if(isValideFile){
				// enable upload button
				showErrorMessage(0, "", "is-valid");
				$("#btn-upload").prop("disabled",false);

			}else{
				$("#btn-upload").prop("disabled",true);
			}

			displayImage();
		})

		$("#btnEditStudent").click(function(){
			let formData = new FormData();
			formData.append("id",$("#id").val());
			formData.append("civilite",$("#field1").val());
			formData.append("nom",$("#field2").val());
			formData.append("prenom",$("#field3").val());
			formData.append("email",$("#field4").val());
			formData.append("contact",$("#field5").val());
			if(validateForm(1)){
				$.ajax({
					url:"update-student.php",
					method:"POST",
					dataType:"html",
					cache : false,
    			processData: false,
				contentType: false, 
					data:formData,
					success:function(response){
						let respObject = $.parseJSON(response);
				 		// console.log(respObject.response);
				 		// console.log(response);
						if(respObject.response){
							toastMessage("Success", respObject.response,true);
							$("#editStudentModal").modal("toggle");
							$("#editModalContent").html("");
							fetchStudentsTable(sortValue, pageSizeValue, 1);
							
						}else{
							toastMessage("Error", respObject.error,false);
						}
					},
					error:function(data){
						// console.log("Error", data);
					}
				});
			}
		})

		function displayImage(){
			lenImage= $("#field0").prop("files").length;
			var selectedImage = $("#field0").prop("files")[lenImage-1];
			var reader = new FileReader();
			reader.onload = function() {
				var dataURL = reader.result;
				$("#displayImg").attr("src",dataURL);
			  };
			reader.readAsDataURL(selectedImage);
		}

		$("#btn-upload").click(function(){
			var formData = new FormData();
			formData.append("file",$("#field0").prop("files")[lenImage-1]);
			formData.append("id",$("#id").val());
			$.ajax({
				url:"update-image.php",
				method:"POST",
				dataType:"html",	
				cache : false,
    			processData: false,
				contentType: false, 
				data:formData,
				success:function(response){
				 var respObject = $.parseJSON(response);
				//  console.log(respObject);
				
				if(respObject.response){
					toastMessage("Success", respObject.response,true);
					fetchStudentsTable(sortValue, pageSizeValue, 1);
					
				}else{
					toastMessage("Error", respObject.error,false);
				}
				},
				error: function(xhr, status, error){
					toastMessage("Error",error,false);
					// console.log(error);
				}
			})
		});
	}
	
	$("#btnDeleteStudent").click(function(){
		$.ajax({
			url:'delete-student.php',
			method:'post',
			data:{id:deleteId},
			success:function(response){
				var split = response.split(",");
				if(split[0]==="success"){
					toastMessage("Success", split[1],true);
					$("#deleteStudentModal").modal("toggle");
					fetchStudentsTable(sortValue, pageSizeValue, 1);
					
				}else{
					toastMessage("error", response,false);
				}
			}
		})
	})

	$("#btn-search").click(function(){
		searchParam = $("#searchInput").val();
		if(searchParam!==""){
			fetchStudentsTableV2(searchParam, sortValue,pageSizeValue, 1);
		}else{
			pageNumber=1
			fetchStudentsTable(sortValue,pageSizeValue, 1)
		}
		// console.log(searchParam);
		// searchStudentTable(searchParam);
	});

	// Load student form into add new student modal content
	$("#btnNewStudent").click(function(){
		$.ajax({
			url:"student-form.php",
			success: function (form) {
				$("#studentModalContent").html(form);

				$('input[type="file"][name="phtotoInput"]').on('change', function() {
					displayImage2();
					function displayImage2(){
						lenImage= $("#field0").prop("files").length;
						let selectedImage = $("#field0").prop("files")[lenImage-1];
						let reader = new FileReader();
						reader.onload = function() {
							let dataURL = reader.result;
							$("#displayImage").attr("src",dataURL);
						  };
						reader.readAsDataURL(selectedImage);
					}
				});

				
			}
		});

		
	});

	$("#btnAddStudent").click(function(){
		// validate form  

		if(validateForm(0)){
			var formInputData = getFormData();
			// console.log(formInputData);
			// send data to PHP server
			$.ajax({
				url:"save-student.php",
				method:"POST",
				dataType:"html",
				data: formInputData,    			// contentType: false,				,
				cache : false,
    			processData: false,
				contentType: false, 
				success: function(response){
					// console.log(response);
					var respObject = $.parseJSON(response);
					// console.log(respObject);
				   
				   if(respObject.response){
					   toastMessage("Success", respObject.response,true);
					   fetchStudentsTable(sortValue, pageSizeValue, 1);
					   $("#newStudentModal").modal("toggle");
					   
				   }else{
					   toastMessage("Error", respObject.error,false);
				   }
				},
				error: function(xhr, status, error){
					toastMessage("Error",error,false);
					;
				}

			});
			
		}
	});

	function toastMessage(heading, message, good){
		$.toast({
			heading:heading,
			text:message,
			showHideTransition:"slide",
			icon: good ? "success":"error",
			loaderBg:"#f96868",
			position:"top-center"
			
		});
	}

	function getFormData(){
		var formData = new FormData();
		formData.append('image', $("#field0").prop("files")[0]);
		formData.append('civilite', $("#field1").val());
		formData.append('nom', $("#field2").val());
		formData.append('prenom', $("#field3").val());
		formData.append('email', $("#field4").val());
		formData.append('contact', $("#field5").val());
		return formData;
	}

	function validateForm(startIndex){
		let valide = true;
		for(let i=startIndex; i<6; i++){
			
			if($("#field"+i).val()==="" ){
				
				showErrorMessage(i, "Field is required!", "is-invalid");
				valide = false;
			}else{
				showErrorMessage(i, "", "is-valid");
				valide = checkFormat(i, valide);
				if(i===0){
					valide = valideFile(valide);
				}
			}
			
		}
		
		return valide;
	}

	function checkFormat(index, formState){
		let i = index;
		
		if(i===4 || i===5){
			let regex = (i===4) ? /^(.+)@(.+)$/ : /^\+?\d{1,3}?[\s-]?\d{6,9}$/;
			let elementId = "#field"+i;
			if(!validateFormat(regex, elementId)){
				var label = (i===4)? "Email":"Contact";
				showErrorMessage(i,`${label} is invalid!`, "is-invalid");
				formState = false;
				// console.log("Hello");
			}else{
				showErrorMessage(i,"", "is-valid");
			}
		}
		return formState;
	}

	function validateFormat(regex, elementId){
		let inputValue= $(elementId).val();
		return regex.test(inputValue)
	} 

	function valideFile(formState){
		let types = ["image/jpeg","image/png","image/jpg"];
		let file = $("#field0").prop('files')[0];
		if(file && !types.includes(file.type)){
			showErrorMessage(0,"File type invalid!", "is-invalid");
			formState = false;
		}
		if(file &&file.size>200000){
			showErrorMessage(0,"File size too big!","is-invalid");
			formState = false;
		}
		return formState;
	}
	
	function showErrorMessage(elementPosition,message,errorClass){
		$("#err"+elementPosition).html(message);
		$("#field"+elementPosition).attr("class",`form-control ${errorClass}`);
	}

	
	$("#sortParam").change(function(e){
		sortValue = $(this).val();
		if(searchParam===""){
			fetchStudentsTable(sortValue, pageSizeValue, 1);
		}else{
			fetchStudentsTableV2(searchParam, sortValue,pageSizeValue, 1);
		}
	});

	$("#pageSize").change(function(e){
		pageSizeValue = $(this).val();
		if(STUDENT_TABLE_METHOD_V==="v1"){
			fetchStudentsTable(sortValue, pageSizeValue, 1);
		}else{
			fetchStudentsTableV2(searchParam, sortValue,pageSizeValue, 1);
		}
	});

	// fetchStudentsTable(sortValue, pageSizeValue, 1);
    
	// authentication code
	function signin(){
		$.ajax({
			url:"login-form.php",
			success: function (form) {
				// hide main container and display login conatiner
				$("#mainContainer").attr("class", "container d-none");
				$("#loginContainer").attr("class", "container");
				$("#loginContainer").html(form);
			}
		});
	}	

	function signup(){
		$.ajax({
			url:"signup-form.php",
			success: function (form) {
				// hide main container and display login conatiner
				$("#mainContainer").attr("class", "container d-none");
				$("#loginContainer").attr("class", "container");
				$("#loginContainer").html(form);

			}
		});
	}

	
	$(document).on('click','a[data-role=signup]', function (e) {
		signup();
	});

	if(localStorage.getItem("user_email")){
		$('#username').html(localStorage.getItem("fname"));
		fetchStudentsTable(sortValue, pageSizeValue, ++pageNumber);
	}else{
		signin();
	}
	
	$(document).on('click','button[id=btn-login]', function(){
		var email = $("#email").val();
		var password = $("#password").val();
		if(email===""||password===""){
			toastMessage("Login Info","email or password must be provided", false);
		}else{
			var formData = new FormData();
			formData.append("email", email);
			formData.append("password", password);
			$.ajax({
				url:"login.php",
				method:"POST",
				dataType:"html",
				data: formData,    			// contentType: false,				,
				cache : false,
				processData: false,
				contentType: false, 
				success: function(response){
					var parts = response.split(',');
					if(parts[0]==="Failed"){
						toastMessage(parts[0],parts[1], false);
					}else{
						toastMessage(parts[0],parts[1], true);
						// save user email
						localStorage.setItem("user_email", email);
						localStorage.setItem("fname", parts[2]);
						localStorage.setItem("roles", parts[3]);
						if(!parts[3].includes("ADMIN")){
							$("a[data-role=users]").attr('class','btn disabled');
						}
						$("#mainContainer").attr("class", "container");
						$("#loginContainer").attr("class", "container d-none");
						$('#username').html(localStorage.getItem("fname"));
						fetchStudentsTable(sortValue, pageSizeValue, 1);
					}
				},
				error: function(xhr, status, error){
					toastMessage("Error",error,false);
				}
			})
		}
	});

	$(document).on('click','a[data-role=logout]', function(){
		localStorage.clear("user_email");
		localStorage.clear("fname");
		localStorage.clear("roles");
		$("#mainContainer").attr("class", "container d-none");
		$("#loginContainer").attr("class", "container");
		signin();
	});

	function validateSignupForm(){
		// check that all fields are not empty
		let formState = true;
		for (var i = 0; i <4; i++){
			if($("#field"+i).val() === ""){
				// $("err"+i).html("Field is required");
				showErrorMessage(i,"Field is required!","is-invalid");
				formState = false;
			}else{
				showErrorMessage(i,"","is-valid");
				if(i==2){
					if(!/^(.+)@(.+)$/.test($("#field"+i).val())){
						formState = false;
						showErrorMessage(i,"Invalid email","is-invalid");
					}else{
						showErrorMessage(i,"","is-valid");
					}
				}
				if(i===3){
					if($("#field"+i).val()!==$("#field4").val()){
						formState="false";
						showErrorMessage(i,"Passwords don't match","is-invalid");
					}
				}

			}
		}

		return formState;
	}
    // $("#btn-signup").click(function(){
	// 	alert("Hi");
	// });

	$(document).on("click","button[id=btn-signup]", function(){
		let formInputData = new FormData();
		formInputData.append("lname",$("#field0").val());
		formInputData.append("fname",$("#field1").val());
		formInputData.append("email",$("#field2").val());
		formInputData.append("role",$("#role").val());
		formInputData.append("pwd",$("#field3").val());
		let formState = validateSignupForm();
		console.log(formState);
		if(formState){
			$.ajax({
				url:"signup.php",
				method:"POST",
				dataType:"html",
				data: formInputData,    			// contentType: false,				,
				cache : false,
    			processData: false,
				contentType: false, 
				success: function(response){
					toastMessage("Success",response.split(',')[1],true);
					signin();
				},
				error: function(xhr, status, error){
					toastMessage("Error",error,false);
				}

			});
		}
	});

	$(document).on('click','a[data-role=profile]', function(){
		var userEmail = localStorage.getItem('user_email');
		var formData = new FormData();
		formData.append('email',userEmail);
		$.ajax({
			url:'view-user.php',
			method:'POST',
			dataType:"html",
			data: formData,
			cache : false,
			processData: false,
			contentType: false,
			success:function(response){
				$("users-modal-title").html("User Profile");
				$("#userModalContent").html(response);
			},
			error: function(xhr, status, error){

			}
		});
	});

	$(document).on('click','a[data-role=users]', function(){
		$.ajax({
			url:'users-table.php',
			method:'GET',
			dataType:"html",
			success:function(response){
				$("#userModalContent").html(response);
				$("users-modal-title").html("Users Table");
			},
			error: function(xhr, status, error){

			}
		});
	});

	$(document).on('click','button[id=add-admin]', function(e){
		$(this).attr('id','remove-admin')
		var userId = $(this).attr('user-id');
		var formData = new FormData();
		formData.append('userId',userId);
		formData.append('action','add');
		$.ajax({
			url:'add-remove-admin.php',
			method:'POST',
			dataType:"html",
			data: formData,
			cache : false,
			processData: false,
			contentType: false,
			success:function(response){
				$("#role"+userId).html("USER ADMIN");
				$("button[user-id="+userId+"]").attr("class","btn btn-warning");
				$("button[user-id="+userId+"]").html("Remove admin");
				toastMessage("Success",response,true);
			},
			error: function(xhr, status, error){

			}
		});
	});
	$(document).on('click','button[id=remove-admin]', function(e){
		var userId = $(this).attr('user-id');
		$(this).attr('id','add-admin')
		var formData = new FormData();
		formData.append('userId',userId);
		formData.append('action','remove');
		$.ajax({
			url:'add-remove-admin.php',
			method:'POST',
			dataType:"html",
			data: formData,
			cache : false,
			processData: false,
			contentType: false,
			success:function(response){
				$("#role"+userId).html("USER");
				$("button[user-id="+userId+"]").attr("class","btn btn-danger");
				$("button[user-id="+userId+"]").html("Add admin");
				toastMessage("Success",response,true);
			},
			error: function(xhr, status, error){

			}
		});
	});


});

