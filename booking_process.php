<?php
session_start();
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all necessary data is received
    if (isset($_POST['property_id'], $_POST['booking_date'], $_POST['start_time'], $_POST['end_time'])) {

        // Sanitize and retrieve the form data
        $property_id = $_POST['property_id'];
        $booking_date = $_POST['booking_date'];
        $start_time = $_POST['start_time'];
        $end_time = $_POST['end_time'];
        $user_id = $_POST['uid']; // Assuming 'uid' is the session variable for the user ID

        // Check if the booking slot is available for the given property, date, and time
        $check_query = "SELECT * FROM booking WHERE pid = '$property_id' AND booking_date = '$booking_date' 
                        AND ((start_time <= '$start_time' AND end_time >= '$start_time') OR 
                        (start_time <= '$end_time' AND end_time >= '$end_time'))";

        $result = mysqli_query($con, $check_query);

        if (mysqli_num_rows($result) > 0) {
            // Booking slot is already taken
            $_SESSION['booking_fail'] = 'Booking Failed. Slot already booked for the specified time.';
            // Redirect with the pid parameter
            header("Location: booking.php?pid=" . $_POST['property_id']);
            exit();
        } else {
            // Proceed to make the booking
            $insert_query = "INSERT INTO booking (pid, uid, booking_date, start_time, end_time) 
                             VALUES ('$property_id', '$user_id', '$booking_date', '$start_time', '$end_time')";
            if (mysqli_query($con, $insert_query)) {
                // Booking successful
                $_SESSION['booking_success'] = 'Booking was Made Successfully';
                header("Location: feature.php");
                exit();
            } else {
                // Handle database errors or booking failures
                $_SESSION['booking_fail'] = 'Booking Failed, Please try again';
                // Redirect with the pid parameter
                header("Location: booking.php?pid=" . $_POST['property_id']);
                exit();
            }
        }
    } else {
        // Handle if required data is missing
        $_SESSION['booking_fail'] = 'Please fill in all the required fields.';
        // Redirect with the pid parameter
        header("Location: booking.php?pid=" . $_POST['property_id']);
        exit();
    }
} else {
    // Handle if the form was not submitted through POST method
    $_SESSION['booking_fail'] = 'Invalid request method.';
    // Redirect with the pid parameter
    header("Location: booking.php?pid=" . $_POST['property_id']);
    exit();
}

?>
