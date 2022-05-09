<!doctype html>
<html lang="en">
<head>

<?php


 session_start();


      if(!isset($_SESSION['username'])){
      echo "no username session"; 
      header("Location: index.php");  

}

include "./includes/db.php"; 

    $sql = "SELECT * FROM names WHERE country = '$_GET[country]'";
    $run = mysqli_query($conn, $sql);


?>


<meta charset="utf-8">
<title>World Map</title>
<meta name="description" content="SVG/VML Interactive World map">
<meta name="author" content="LGLab">



<script
  src="https://code.jquery.com/jquery-3.2.1.js"
  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
  crossorigin="anonymous"></script>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>





<link href="css/reset.css" rel="stylesheet" type="text/css" />
<link href="css/fonts.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/map.css" rel="stylesheet" type="text/css" />

<script src="js/RequestAnimationFrame.js"></script>
<script src="js/jquery.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.mousewheel.js"></script>
<script src="js/raphael.js" type="text/javascript"></script>
<script src="js/raphaelAnimateViewBox.js" type="text/javascript"></script>
<script src="js/scale.raphael.js" type="text/javascript"></script>
<script src="js/paths.js" type="text/javascript"></script>
<script src="js/init.js" type="text/javascript"></script>

</head>

<body>
	

    <!-- start map stuff -->

    <div id="container">

    <?php
      include "includes/header.php";
    ?>
    
        <div class="mapWrapper">
   
                <div id="map"></div>
                
                <div class="console">
                        
                        <ul class="left">					
                            <li>
                                <span id="zoomerIn"><img src="images/in.png"/></span>
                                <span id="zoomerOut"><img src="images/out.png"/></span>
                                <span id="zoomerUp"><img src="images/up.png"/></span>
                                <span id="zoomerDown"><img src="images/down.png"/></span>
                                <span id="zoomerLeft"><img src="images/left.png"/></span>
                                <span id="zoomerRight"><img src="images/right.png"/></span>
                            </li>
                        </ul>
                        
                        <ul class="right">
                            <li>
                                <span id="zoomerReset"><img src="images/reset.png"/></span>
                            </li>
                        </ul>
                    
                </div>
                
                <div id="text"></div>
                     
        </div>
        
    </div>


   <!--  end map stuff , start address stuff from db -->




<div class="container">
      
      
    
      <?php if (isset($_GET[country])) {
    echo "<div class='jumbotron'><h1>Address List For ";
    $countrypage = $_GET[country];
    echo ucfirst($countrypage);
    echo "</h1>
    </div>    
     <div id='list' class='row'>
        <div class='col-md-12'>
            <div class='table-responsive'>
                <table class='table-hover table-bordered'>
                  <thead>
                    <tr>
                        <th>Name</th>
                        <th>Organization</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>Children</th>
                        <th></th>
                    </tr>
                  </thead>
                  <tbody>";
} ?>

                 

                  


          <?php 



// if (!$conn) {
//     die("Connection failed: " . mysqli_connect_error());
// }
// echo "Connected successfully";

              



      while($rows = mysqli_fetch_assoc($run) ){
      $email = $rows['email'];
      $name_first = $rows['name_first'];
      $name_last = $rows['name_last'];
      $organization = $rows['organization'];
      $phone = $rows['phone'];
      $img = $rows['img'];
      $country = $rows['country'];
      $city = $rows['city'];
      $children_num = $rows['children_num'];
      $address = $rows['address'];
      $country = str_replace(' ', '-', $rows[country]);
      echo "     
     

                        <tr>
                            
                            <td><dl><dt>"; echo ucwords($rows['name_first']); echo "</dt><dt>"; echo ucwords($rows['name_last']); echo "</dt></dl></td>
                                                        
                            <td>"; echo ucwords($rows['organization']); echo "</td>
                            <td>$rows[email]</td>
                            <td>$rows[phone]</td>
                            <td>$rows[address]</td>
                            <td>"; echo ucwords($rows['city']); echo "</td>
                            <td>$rows[children_num]</td>
                            <td><div class='pull-right'><img src=$rows[img] class='img-thumbnail img-responsive center-block'></div></td>
                        </tr>";
      
      }

     


       ?>



                    </tbody>
                </table>
            </div>
        </div>          
   </div>
  
</div>
    

<?php
  include "includes/footer.php";
?>

</body>
</html>
