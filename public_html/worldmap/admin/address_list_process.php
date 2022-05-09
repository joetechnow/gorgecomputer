<?php include '../includes/db.php';
	
	if (isset($_REQUEST['del_id']) ) {
		
		$del_sql = "DELETE FROM names WHERE id = '$_REQUEST[del_id]'";
		mysqli_query($conn, $del_sql);
	}

	   if (isset($_REQUEST['up_id']) ) {
	   	 $country =  mysqli_real_escape_string($conn, strip_tags($_REQUEST['country']));
	   	 $name_last =  mysqli_real_escape_string($conn, $_REQUEST['name_last']);
	   	 $name_first =  mysqli_real_escape_string($conn, strip_tags($_REQUEST['name_first']));
	   	 $children_num =  mysqli_real_escape_string($conn, strip_tags($_REQUEST['children_num']));
	   	 $email =  mysqli_real_escape_string($conn, strip_tags($_REQUEST['email']));
	   	 $phone =  mysqli_real_escape_string($conn, strip_tags($_REQUEST['phone']));
	   	 $organization =  mysqli_real_escape_string($conn, strip_tags($_REQUEST['organization']));
	   	 $address =  mysqli_real_escape_string($conn, strip_tags($_REQUEST['address']));
	   	 $city =  mysqli_real_escape_string($conn, strip_tags($_REQUEST['city']));
	   	 $id = $_REQUEST['up_id'];







   			 		 // $item_ins_sql = "INSERT INTO items (country, name_last, name_first, children_num, email, phone, organization, address) VALUES ('$country', '$name_last', '$name_first', '$children_num', '$email', '$phone', '$organization', '$address');";
   			 		 

   			 		 $address_up_sql ="UPDATE names SET country = '$country', name_last = '$name_last', name_first = '$name_first', children_num = '$children_num', email = '$email' phone = '$phone', organization = '$organization', address = '$address'  WHERE id = '$id'  ";
   			 		 $address_ins_run = mysqli_query($conn, $address_up_sql);



   }

 ?>



<table class="table table-border table-striped">
			<thead>
				<tr class="item-head">
					<th>ID</th>
					<th>Image</th>
					<th>Country</th>
					<th>Last Name</th>
					<th>First Name</th>
					<th>Num. of Children</th>
					<th>Email</th>
					<th>Phone</th>
					<th>Organization</th>
					<th>Address</th>					
					<th>City</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$c = 1; 
				$sel_sql = "SELECT * FROM names";
				$sel_run = mysqli_query($conn, $sel_sql);
				// $country_sql = "SELECT * FROM country";
				// $country_run = mysqli_query($conn, $country_sql);
				while($rows = mysqli_fetch_assoc($sel_run)){
				 	
					$id = $rows[id];
				  echo "
				<tr>
					<td>$rows[id]</td>
					<td><img src=../$rows[img] style='width: 60px;'></td>
					<td>"; echo ucwords($rows['country']); echo "</td>
					<td>"; echo ucwords($rows['name_last']); echo "</td>
					<td>"; echo ucwords($rows['name_first']); echo "</td>
					<td>$rows[children_num]</td>
					<td>$rows[email]</td>
					<td>$rows[phone]</td>
					<td>"; echo ucwords($rows['organization']); echo "</td>
					<td>$rows[address]</td>
					<td>"; echo ucwords($rows['city']); echo "</td>
					<td>
						<div class='dropdown'>
						 <button class='btn btn-red btn-danger dropdown-toggle' data-toggle='dropdown'>Actions<span class='caret'></span></button>
							<ul class='dropdown-menu drop-downmenu-right'>
								<li>
								
								<a href='#edit_modal$id' data-toggle='modal' data-target='#edit_modal$id'>Edit</a>
								
								</li>"; 
								?>
								<li><a href="javascript:;" onclick="del_address(<?php echo $rows['id']; ?>);">Delete</a></li>
								<?php
								echo "
							</ul>
						</div>
		<div class='modal fade' id='edit_modal$id'>
			<div class='modal-dialog'>
				<div class='modal-content'>
					<div class='modal-header'>
						<button class='close' data-dismiss='modal'>&times;</button>
						<h4 class='modal-title'>Edit Address</h4>
					</div>
					<div class='modal-body'>
						<div id=form1>

							<div class='form-group'>
								<label>Country</label>
							<select class='form-control' id='country' required>
								<option>Select a Country</option>";
								

									$country_up = ucwords($rows['country']);
									$country = $rows['country'];

										echo "<option value='$country' selected>$country_up</option>";



														
								// $ctry_sql = "SELECT * FROM country";
								// $ctry_run = mysqli_query($conn, $ctry_sql);
								// while ($ctry_rows = mysqli_fetch_assoc($ctry_run) ) {
								// 	$country_query = ucwords($ctry_rows['country']);
								// 	if ($ctry_rows['country_slug'] == '') {
								// 		$country_slug = $ctry_rows['country_name'];
								// 	} else {$country_slug = $ctry_rows['country_slug'];
								// 	}
								// 	echo "<option value='$country_slug' selected>$country</option>";
								// }
							



								
							
								
					echo "	</select>
							</div>
							<div class='form-group'>
								<label>Last Name</label>
								<input type='text' id='name_last' value='"; echo ucwords($rows['name_last']); echo "' class='form-control' required>
							</div>
							<div class='form-group'>
								<label>First Name</label>
								<input type='text' id='name_first' value='"; echo ucwords($rows['name_first']); echo "' class='form-control' required>
							</div>
							<div class='form-group'>
								<label>Num. of Children</label>
								<input type='number' id='children_num' value='$rows[children_num]' class='form-control' required>	
							</div>
							<div class='form-group'>
								<label>Email</label>
								<input type='email'  id='email' value='$rows[email]' class='form-control' required>
							</div>
							<div class='form-group'>
								<label>Phone</label>
								<input type='number'  id='phone' value='$rows[phone]' class='form-control' required>
							</div>
							<div class='form-group'>
								<label>Organization</label>
								<input type='text'  id='organization' value='"; echo ucwords($rows['organization']); echo "' class='form-control' required>
							</div>
							<div class='form-group'>
								<label>Address</label>
								<input type='text'  id='address' value='$rows[address]' class='form-control'>
							</div>
							<div class='form-group'>
								<label>City</label>
								<input type='text'  id='city' value='"; echo ucwords($rows['city']); echo "' class='form-control'>
							</div>							
							<div class='form-group'>
								<input type='hidden' id='up_id' value='$rows[id]'>"; ?>
								<button  onclick="edit_address(<?php echo "$rows[id]"; ?>);" class='btn btn-primary btn-block'>Submit</button>
							</div>
						</div>
					</div>
					<div class='modal-footer'>
						<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
					</div>
					</div>
				</div>
			</div>
		</td>
	</tr>
				 <?php  
				  $c++;
				}
			?>


			</tbody>
		</table>