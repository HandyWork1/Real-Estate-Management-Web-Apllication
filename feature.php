<?php 
ini_set('session.cache_limiter','public');
session_cache_limiter(false);
session_start();
include("config.php");
// if(!isset($_SESSION['uid']))
// {
// 	header("location:login.php");
// }								
?>
<!DOCTYPE html>
<html lang="en">

<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Meta Tags -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="shortcut icon" href="images/favicon.ico">

<!--	Fonts
	========================================================-->
<link href="https://fonts.googleapis.com/css?family=Muli:400,400i,500,600,700&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Comfortaa:400,700" rel="stylesheet">

<!--	Css Link
	========================================================-->
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-slider.css">
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="css/layerslider.css">
<link rel="stylesheet" type="text/css" href="css/color.css">
<link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css">
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="fonts/flaticon/flaticon.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/login.css">

<!--	Title
	=========================================================-->
<title> Starlink Properties</title>
</head>
<body>

<!--	Page Loader
=============================================================
<div class="page-loader position-fixed z-index-9999 w-100 bg-white vh-100">
	<div class="d-flex justify-content-center y-middle position-relative">
	  <div class="spinner-border" role="status">
		<span class="sr-only">Loading...</span>
	  </div>
	</div>
</div>
--> 


<div id="page-wrapper">
    <div class="row"> 
        <!--	Header start  -->
		<?php include("include/header.php");?>
        <!--	Header end  -->
        
        <!--	Banner   --->
        <div class="banner-full-row page-banner" style="background-image:url('images/breadcromb.jpg');">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h2 class="page-name float-left text-white text-uppercase mt-1 mb-0"><b>User Listed Property</b></h2>
                    </div>
                    <div class="col-md-6">
                        <nav aria-label="breadcrumb" class="float-left float-md-right">
                            <ol class="breadcrumb bg-transparent m-0 p-0">
                                <li class="breadcrumb-item text-white"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">User Listed Property</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
         <!--	Banner   --->
		 
		 
		<!--	Submit property   -->
        <div class="full-row bg-gray">
            <div class="container"> 
                    <div class="row mb-5">
						<div class="col-lg-12">
							<h2 class="text-secondary double-down-line text-center">User Bookings</h2>
							<?php 
								if(isset($_GET['msg']))	
								echo $_GET['msg'];	
                                // Check for and display the success message
                                if (isset($_SESSION['booking_success'])) {
                                    $msg = "<p class='alert alert-success'>{$_SESSION['booking_success']}</p>";
                                    echo $msg;

                                    // Remove the session variable to clear the message after displaying it
                                    unset($_SESSION['booking_success']);
                                }
							?>
                        </div>
					</div> 
					<table class="items-list col-lg-12 table-hover" style="border-collapse:inherit;">
                    <thead>
                        <tr class="bg-dark">
                            <th class="text-white font-weight-bolder">Property</th>
                            <th class="text-white font-weight-bolder">Date</th>
                            <th class="text-white font-weight-bolder">Start Time</th>
                            <th class="text-white font-weight-bolder">End Time</th>
                            <th class="text-white font-weight-bolder">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if (isset($_SESSION['uid'])) {
                                $uid = $_SESSION['uid'];
                                $query = mysqli_query($con, "SELECT booking.*, property.title AS property_title 
                                                            FROM booking 
                                                            INNER JOIN property ON booking.pid = property.pid 
                                                            WHERE booking.uid='$uid'");

                                while($row = mysqli_fetch_array($query)) {
                        ?>
                            <tr>
                                <td class="text-capitalize"><?php echo $row['property_title'];?></td>
                                <td class="text-capitalize"><?php echo $row['booking_date'];?></td>
                                <td class="text-capitalize"><?php echo $row['start_time'];?></td>
                                <td class="text-capitalize"><?php echo $row['end_time'];?></td>
                                <td class="text-center"><a class="btn btn-danger px-5" href="#">Cancel Booking</a></td>
                            </tr>
                        <?php }
                        }else {
                            // Handle the case where $_SESSION['uid'] is not set
                            // You might display an error message or take an alternative action
                            echo "User ID not found in session.";
                        } ?>
                    </tbody>
                </table>
        
            </div>
        </div>
	<!--	Submit property   -->
        
        
        <!--	Footer   start-->
		<?php include("include/footer.php");?>
		<!--	Footer   start-->
        
        <!-- Scroll to top --> 
        <a href="#" class="bg-secondary text-white hover-text-secondary" id="scroll"><i class="fas fa-angle-up"></i></a> 
        <!-- End Scroll To top --> 
    </div>
</div> 
<!-- Wrapper End --> 

<!--	Js Link
============================================================--> 
<script src="js/jquery.min.js"></script> 
<!--jQuery Layer Slider --> 
<script src="js/greensock.js"></script> 
<script src="js/layerslider.transitions.js"></script> 
<script src="js/layerslider.kreaturamedia.jquery.js"></script> 
<!--jQuery Layer Slider --> 
<script src="js/popper.min.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/owl.carousel.min.js"></script> 
<script src="js/tmpl.js"></script> 
<script src="js/jquery.dependClass-0.1.js"></script> 
<script src="js/draggable-0.1.js"></script> 
<script src="js/jquery.slider.js"></script> 
<script src="js/wow.js"></script> 
<script src="js/custom.js"></script>
</body>
</html>