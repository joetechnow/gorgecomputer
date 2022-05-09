<?php 
	
	 session_start();


      if(!isset($_SESSION['username'])){
      echo "no username session"; 
      header("Location: ../index.php");  

}



   include "../includes/db.php"; 
   if (isset($_POST['address_submit']) ) {
	   	 $country =  mysqli_real_escape_string($conn, strip_tags($_POST['country']));
	   	 $name_last =  mysqli_real_escape_string($conn, $_POST['name_last']);
	   	 $name_first =  mysqli_real_escape_string($conn, strip_tags($_POST['name_first']));
	   	 $children_num =  mysqli_real_escape_string($conn, strip_tags($_POST['children_num']));
	   	 $email =  mysqli_real_escape_string($conn, strip_tags($_POST['email']));
	   	 $phone =  mysqli_real_escape_string($conn, strip_tags($_POST['phone']));
	   	 $organization =  mysqli_real_escape_string($conn, strip_tags($_POST['organization']));
	   	 $address =  mysqli_real_escape_string($conn, strip_tags($_POST['address']));
	   	 $city =  mysqli_real_escape_string($conn, strip_tags($_POST['city']));

   		if (isset($_FILES['img']['name']) ) {
   			$file_name = $_FILES['img']['name'];
   			$path_address = "../images/$file_name";
   			$path_address_db = "images/$file_name";
   			$img_confirm = 1;
   			$file_type = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
   			if ($_FILES['img']['size'] > 200000 )  {
   				$img_confirm = 0;
   				echo 'The file size is too large.';
   			}
   			if ($file_type != 'jpg' && $file_type != 'png' && $file_type != 'gif') {
   				$img_confirm = 0;
   				echo 'This is the wrong type of file.  It must be a .jpg, .png or .gif file.';
   			}
   			if ($img_confirm == 0) {
   				
   			 }else {
   			 	if (move_uploaded_file($_FILES['img']['tmp_name'], $path_address)) {
   			 		 $address_ins_sql = "INSERT INTO names (img, country, name_last, name_first, children_num, email, phone, organization, address, city) VALUES ('$path_address_db', '$country', '$name_last', '$name_first', '$children_num', '$email', '$phone', '$organization', '$address', '$city');";
   			 		 $address_ins_run = mysqli_query($conn, $address_ins_sql);
   			 	}
   			 }
  		} else {
  			echo 'sorry';
  		}



   }


?>

<!DOCTYPE html>
<html>
<head>

	<title>Address List</title>







<?php
 include '../includes/inHead.php';
?>




<!-- Optional theme -->


  <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script>tinymce.init({
  selector: 'textarea',
  menubar: true,
    plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table contextmenu paste code'
  ],
  toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
  content_css: '//www.tinymce.com/css/codepen.min.css'
});</script>


<script>
	function get_address_list_data(){

		xmlhttp =  new XMLHttpRequest();
		xmlhttp.onreadystatechange = function () {	
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				document.getElementById('get_address_list_data').innerHTML = xmlhttp.responseText;
			}
		}
		xmlhttp.open('GET', 'address_list_process.php', true);
		xmlhttp.send();
	}

	function del_address(id) {

			xmlhttp.onreadystatechange = function () {	
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				document.getElementById('get_address_list_data').innerHTML = xmlhttp.responseText;
			}
		}	
		
		xmlhttp.open('GET', 'address_list_process.php?del_id='+id, true);
		xmlhttp.send();
	}

	function edit_address(id) {
		id = document.getElementById('up_id').value;
		country = document.getElementById('country').value;
		name_last = document.getElementById('name_last').value;
		name_first = document.getElementById('name_first').value;
		children_num = document.getElementById('children_num').value;
		email = document.getElementById('email').value;
		phone = document.getElementById('phone').value;
		organization = document.getElementById('organization').value;
		address = document.getElementById('address').value;
		city = document.getElementById('city').value;


		xmlhttp.open('GET', 'address_list_process.php?up_id='+id+'&country='+country+'&name_last='+name_last+'&name_first='+name_first+'&children_num='+children_num+'&email='+email+'&phone='+phone+'&organization='+organization+'&address='+address+'&city='+city, true);
		xmlhttp.send();
	}

</script>

</head>
<body onload="get_address_list_data();">

<?php
	include '../includes/headeradmin.php';
?>
	
<div class="container">






	<button class="btn btn-red btn-danger" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#add_new_address">Add New Address</button>

	<div id="add_new_address" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add New Address</h4>
				</div>
				<div class="modal-body">
					<form method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label>Image</label>
							<input type="file" name="img" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Country</label>
							<select class="form-control" name="country" required>
							<option>Country List</option>
							<?php
								$sql = "SELECT * FROM country";
								$run = mysqli_query($conn, $sql);
								while ($rows = mysqli_fetch_assoc($run) ) {
									$country = ucwords($rows['country_name']);
									if ($rows['country_slug'] == '') {
										$country_slug = $rows['country_name'];
									} else {$country_slug = $rows['country_slug'];
									}
									echo "<option value='$country_slug'>$country</option>";
								}
							?>
								
							</select>
						</div>
						<div class="form-group">
							<label>Last Name</label>
							<input type="text" name="name_last" class="form-control" required>
						</div>
						<div class="form-group">
							<label>First Name</label>
							<input type="text" name="name_first" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Number of Children</label>
							<input type="number" name="children_num" class="form-control" required>						
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="email"  name="email" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Phone</label>
							<input type="number"  name="phone" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Organization</label>
							<input type="text"  name="organization" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Address</label>
							<input type="text"  name="address" class="form-control">
						</div>
						<div class="form-group">
							<label>City</label>
							<input type="text"  name="city" class="form-control">
						</div>
						<div class="form-group">
							<input type="submit"  name="address_submit" class="btn btn-primary btn-block">
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>


<!--    This one works but want to try a modal
	<a class="btn btn-red btn-danger" href="register.php">Register New User</a> -->


<!-- 	Below is the new added modal try -->

	<button class="btn btn-red btn-danger" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#register_new_user">Register New User for Access to Address List</button>

	<div id="register_new_user" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Register New User for Access to Address List</h4>
				</div>
				<div class="modal-body">
					
					<?php
						
						if (isset($_POST) & !empty($_POST)) {
							if (isset($_POST['username'])) {
							$username = $_POST['username'];
							$password = ($_POST['password']);
							$password = md5($password);
							$isAdmin = ($_POST['isAdmin']);

							$sql = "INSERT INTO users (userName, pass, isAdmin) VALUES ('$username', '$password', '$isAdmin')";
							
							$result = mysqli_query($conn, $sql);
							
							if ($result) {
								$GLOBAL['smsg'] = "User Registration Successful";
							}else{
								$GLOBAL['fmsg'] = "User Registration Failed";
							}
						}
					}

					?>

				     <form class="form-signin" method="POST">
				        <h2 class="form-signin-heading">Please Input New User Credentials</h2>
				        <div class="input-group">
					  		<span class="input-group-addon" id="basic-addon1">User Name:</span>
					  		<input type="text" name="username" class="form-control" placeholder="Username" required>
						</div>
				        <label for="inputPassword" class="sr-only">Password</label>
						<div class="input-group">
				        	<span class="input-group-addon" id="basic-addon2">Password:</span>
				        	<input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
				        </div>
				        <div class="input-group">
					  		<span class="input-group-addon" id="basic-addon1">Admin User?:</span>
					  		<input type="text" name="isAdmin" class="form-control" placeholder="(1 for yes 0 for no)" required>
						</div>
				        <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
				        
				      </form>



					</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>

			</div>

		</div>
	</div>


<!-- <button class="btn btn-red btn-danger" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#register_new_admin">Register New Admin User for Access to Address Management</button>


		<div id="register_new_admin" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Register New Admin User for Access to Address Management</h4>
				</div>
				<div class="modal-body">
					
					<?php
						
						if (isset($_POST) & !empty($_POST)) {
							if (isset($_POST['username_admin'])) {
							
							
							$username_admin = $_POST['username_admin'];
							$password_admin = $_POST['password_admin'];

							$sql_admin = "INSERT INTO users (userName, pass) VALUES ('$username_admin', '$password_admin')";
							
							$result_admin = mysqli_query($conn, $sql_admin);
							
							if ($result_admin) {
								$GLOBAL['asmsg'] = "Admin User Registration Successful";
							}else{
								$GLOBAL['afmsg'] = "Admin User Registration Failed";
							}
						}
					}

					?>

				     <form class="form-signin" method="POST">
				        <h2 class="form-signin-heading">Please Input New Admin User Credentials</h2>
				        <div class="input-group">
					  		<span class="input-group-addon" id="basic-addon1admin">User Name:</span>
					  		<input type="text" name="username_admin" class="form-control" placeholder="Username" required>
						</div>
				        <label for="inputPasswordadmin" class="sr-only">Password</label>
						<div class="input-group">
				        <span class="input-group-addon" id="basic-addon2admin">Password:</span>
				        <input type="password" name="password_admin" id="inputPasswordadmin" class="form-control" placeholder="Password" required>
				        </div>
				        <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
				        
				      </form>



					</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>

			</div>

		</div>
	</div> -->


	<?php if(isset($smsg)) { ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?></div>
	<?php } ?>
	<?php if(isset($fmsg)) { ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?></div>
	<?php } ?>	




<!-- End new added modal try -->

	<div id="get_address_list_data">
		
		<!-- Area to get the processed item list data -->

	</div>
		
</div>






<?php
	include '../includes/footer.php';
?>








</body>
</html>