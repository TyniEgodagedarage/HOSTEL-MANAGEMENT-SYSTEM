<?php
  require 'includes/config.inc.php';
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title> Allocated Rooms</title>
	
	<!-- Meta tag Keywords -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<meta name="keywords" content="Intrend Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
	Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
	<script type="application/x-javascript">
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!--bootsrap -->

	<!--// Meta tag Keywords -->
		
	<!-- css files -->
	<link rel="stylesheet" href="web_home/css_home/bootstrap.css"> <!-- Bootstrap-Core-CSS -->
	<link rel="stylesheet" href="web_home/css_home/style.css" type="text/css" media="all" /> <!-- Style-CSS --> 
	<link rel="stylesheet" href="web_home/css_home/fontawesome-all.css"> <!-- Font-Awesome-Icons-CSS -->
	<!-- //css files -->
	
	<!-- web-fonts -->
	<link href="//fonts.googleapis.com/css?family=Poiret+One&amp;subset=cyrillic,latin-ext" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
	<!-- //web-fonts -->
	
</head>

<body>

<!-- banner -->
<div class="inner-page-banner" id="home"> 	   
	<!--Header-->
	<header>
		<div class="container agile-banner_nav">
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				
				<h1><a class="navbar-brand" href="home.php">NITC <span class="display"></span></a></h1>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item">
							<a class="nav-link" href="subwarden_home.php">Home <span class="sr-only">(current)</span></a>
						</li>
						
						<li class="nav-item">
						<a class="nav-link" href="subwarden_student_view.php">View Students</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="subwarden_hostel.php">Hostel</a>
					</li>
					
					<li class="nav-item">
						<a class="nav-link" href="contact_manager.php">Contact</a>
					</li>
					<li class="dropdown nav-item">
						<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"><?php echo $_SESSION['username']; ?>
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu agile_short_dropdown">
							<li>
								<a href="admin/manager_profile.php">My Profile</a>
							</li>
							<li>
								<a href="includes/logout.inc.php">Logout</a>
							</li>
						</ul>
					</li>
					</ul>
				</div>
			</nav>
		</div>
	</header>
	<!--Header-->
</div>
<!-- //banner --> 


<?php
$hostel_id = $_SESSION['hostel_id'];

$student_qury = "SELECT * FROM Student where Hostel_id = '$hostel_id'";

$student_result = mysqli_query($conn, $student_qury);

?>
<div class="container">
<section class="contact py-5">
<table class="table table-hover">
    <thead>
      <tr>
        <th>Student Name</th>
        <th>Student ID</th>
        <th>Contact Number</th> 
		<th>Department</th>
		<th>Year of Study</th>
      </tr>
    </thead>
    <tbody>
    <?php
      if(mysqli_num_rows($student_result)==0){
         echo '<tr><td colspan="4">No Rows Returned</td></tr>';
      }
      else{
      	while($row1 = mysqli_fetch_assoc($student_result)){
      		
            //student name
            $student_name = $row1['Fname']." ".$row1['Lname'];
            
      		echo "<tr><td>{$student_name}</td><td>{$row1['Student_id']}</td><td>{$row1['Mob_no']}</td><td>{$row1['Dept']}</td><td>{$row1['Year_of_study']}</td></tr>\n";
      	}
      }
    ?>
    </tbody>
  </table>
	</section>
    </div>
	</div>
<?php

if(isset($_POST["import"])){
		
	$filename=$_FILES["file"]["tmp_name"];		


	 if($_FILES["file"]["size"] > 0)
	 {
		  $file = fopen($filename, "r");
		while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
		 {
			$sql="INSERT INTO student (Student_id, Fname, Lname, Mob_no, Dept, Year_of_study, Pwd, Hostel_id, Room_id) 
			VALUES ('".$getData[0]."','".$getData[1]."','".$getData[2]."','".$getData[3]."','".$getData[4]."','".$getData[5]."', '', NULL, NULL)";

			 $result = mysqli_query($conn, $sql);
			if(!isset($result))
			{
				echo "<script type='text/javascript'>
						alert('Invalid File:Please Upload CSV File.');
						
					  </script>";		
			}
			else {
				  
			}
		 }

		 echo "<script type='text/javascript'>
					alert('CSV File has been successfully Imported.');
					
				</script>";
				echo "<meta http-equiv='refresh' content='0'>";
		 fclose($file);	
	 }
}	 

?>


<br>
<br>
<br>

<!-- footer -->
<footer class="py-5">
	<div class="container py-md-5">
		<div class="footer-logo mb-5 text-center">
			<a class="navbar-brand" href="http://www.nitc.ac.in/" target="_blank">NIT <span class="display"> CALICUT</span></a>
		</div>
		<div class="footer-grid">
			<div class="list-footer">
				<ul class="footer-nav text-center">
					<li>
						<a href="home_manager.php">Home</a>
					</li>
					<li>
						<a href="allocate_room.php">Allocate</a>
					</li>
					<li>
						<a href="contact_manager.php">Contact</a>
					</li>
					<li>
						<a href="admin/manager_profile.php">Profile</a>
					</li>
				</ul>
			</div>
			
		</div>
	</div>
</footer>
<!-- footer -->

<!-- js-scripts -->

	<!-- js -->
	<script type="text/javascript" src="web_home/js/jquery-2.2.3.min.js"></script>
	<script type="text/javascript" src="web_home/js/bootstrap.js"></script> <!-- Necessary-JavaScript-File-For-Bootstrap -->
	<!-- //js -->

	<!-- banner js -->
	<script src="web_home/js/snap.svg-min.js"></script>
	<script src="web_home/js/main.js"></script> <!-- Resource jQuery -->
	<!-- //banner js -->

	<!-- flexSlider --><!-- for testimonials -->
	<script defer src="web_home/js/jquery.flexslider.js"></script>
	<script type="text/javascript">
		$(window).load(function(){
		  $('.flexslider').flexslider({
			animation: "slide",
			start: function(slider){
			  $('body').removeClass('loading');
			}
		  });
		});
	</script>
	<!-- //flexSlider --><!-- for testimonials -->

	<!-- start-smoth-scrolling -->
	<script src="web_home/js/SmoothScroll.min.js"></script>
	<script type="text/javascript" src="web_home/js/move-top.js"></script>
	<script type="text/javascript" src="web_home/js/easing.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$(".scroll").click(function(event){
				event.preventDefault();
				$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
			});
		});
	</script>
	<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function() {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear'
				};
			*/

			$().UItoTop({ easingType: 'easeOutQuart' });

			});
	</script>
	<!-- //here ends scrolling icon -->
	<!-- start-smoth-scrolling -->

<!-- //js-scripts -->

</body>
</html>

