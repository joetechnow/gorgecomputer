	<nav class="navbar navbar-inverse">
	  <div class="container">
		<ul class="nav navbar-nav">	
			<div class="navbar-brand">Address List</div>
		  	<li><a href="../index.php">Home</a></li>
			<?php

				$u = $_SESSION['username'];
				$admin_sql = "SELECT * FROM users WHERE userName = '$u'";
				$admin_result = mysqli_query($conn, $admin_sql);
				if (!$admin_result) {
    echo 'Could not run query: ' . mysqli_error($conn);

}
				$admin_row = mysqli_fetch_row($admin_result);
				




				$isAdmin = $admin_row[3];

					// echo $isAdmin;
					// echo $u;
					// echo "test change";


                if ($isAdmin > 0) {
                  	echo '<li>
                	<a href="./admin/address_list.php">Admin Panel</a>
            	    </li>';
                  } 
            ?>




		</ul>




			
		
		<div class="navbar-header navbar-right">
			<form class="form-inline"  method="post" action="index.php">
			  	<div class="form-group">
					<label for="username">User Name:</label>
					<input type="text" class="form-control" name="username" id="username" placeholder="User Name(lower case)">
					<label for="password">Password:</label>
					<input type="password" class="form-control" name="password" id="password" placeholder="Password">
					
					<button type="submit" class="btn btn-default">Log In</button>
					<a class="btn btn-default" href="logout.php">Log Out</a>

					
				</div>
			</form>
		

		</div>

	  </div>
	</nav>