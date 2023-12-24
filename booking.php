<?php
session_start();
include("config.php");
if(!isset($_SESSION['uid']))
{
	header("location:index.php");
    exit();
}

if (isset($_GET['pid']) && !empty($_GET['pid'])) {
    $property_id = $_GET['pid'];

    // Retrieve property details based on $property_id
    $query = mysqli_query($con, "SELECT * FROM `property` WHERE pid='$property_id'");
    $property = mysqli_fetch_array($query);

    // Check if the property exists and display the booking form
    if ($property) {
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
            <meta name="description" content=" Starlink Properties">
            <meta name="keywords" content="">
            <meta name="author" content="Unicoder">
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
            <link rel="stylesheet" type="text/css" href="css/color.css" id="color-change">
            <link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css">
            <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
            <link rel="stylesheet" type="text/css" href="fonts/flaticon/flaticon.css">
            <link rel="stylesheet" type="text/css" href="css/style.css">

            <!--==================================
                Title
            ====================================-->
            <title> Starlink Properties</title>
        </head>
        <body>
            <!-- Your HTML form for booking -->
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="text-center">Book Property</h3>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <?php
                                    // Check for and display the fail message
                                    if (isset($_SESSION['booking_fail'])) {
                                        $msg = "<div class='alert alert-warning btn-block text-center'>{$_SESSION['booking_fail']}</div>";
                                        echo $msg;

                                        // Remove the session variable to clear the message after displaying it
                                        unset($_SESSION['booking_fail']);
                                    }
                                    ?>
                                    <div class="col-md-6">
                                        <img src="admin/property/<?php echo $property['18']; ?>" alt="Property Image" class="img-fluid">
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Property Name:</strong> <?php echo $property['title']; ?></p>
                                        <p><strong>City:</strong> <?php echo $property['state']; ?></p>
                                        <p><strong>Area:</strong> <?php echo $property['city']; ?></p>
                                        <p><strong>Location:</strong> <?php echo $property['location']; ?></p>
                                        <!-- You can display other property details here -->
                                    </div>
                                </div>

                                <!-- Your Bootstrap form for booking -->
                                <form action="booking_process.php" method="post">
                                    <input type="hidden" name="property_id" value="<?php echo $property_id; ?>">
                                    <input type="hidden" name="uid" value="<?php echo $_SESSION['uid']; ?>">

                                    <div class="form-group">
                                        <label for="booking_date">Select Date:</label>
                                        <input type="date" class="form-control" id="booking_date" name="booking_date" required>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="start_time">Start Time:</label>
                                            <input type="time" class="form-control" id="start_time" name="start_time" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="end_time">End Time:</label>
                                            <input type="time" class="form-control" id="end_time" name="end_time" required>
                                        </div>
                                    </div>

                                    <p><strong>User Name:</strong> <?php echo $_SESSION['uname']; ?></p>
                                    <!-- You can display other user details here -->

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Book Property</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--=========================	
                Scripts
            ===========================--> 
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

        <?php
    } else {
        // Property not found, handle accordingly (redirect or show error)
        $_SESSION['booking_fail'] = "Property not found!";
        header("location:property.php");
        exit();
    }
} else {
    // No property ID provided, handle accordingly (redirect or show error)
    $_SESSION['booking_fail'] = "No property ID specified!";
    header("location:property.php");
    exit(); // Make sure to exit after a header redirect
}
?>
